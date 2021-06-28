<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/UserDao.class.php';



class UserService extends BaseService{

   public function __construct(){
    $this->dao = new UserDao();
  }

  public function reset($user){
    $db_user = $this->dao->get_user_by_token($user['token']);

    if (!isset($db_user['id'])) throw new Exception("Invalid token", 400);

    if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_user['token_created_at']) > 300) throw new Exception("Token expired", 400);

    $this->dao->update($db_user['id'], ['password' => md5($user['password']), 'token' => NULL]);

    return $db_user;
  }

  public function forgot($user){
    $db_user = $this->dao->get_user_by_email($user['email']);
    if (!isset($db_user['id'])) throw new Exception("User doesn't exists!", 400);
    if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_user['token_created_at']) < 300) throw new Exception("Stay where you are, token is coming", 400);
    $db_user = $this->update($db_user['id'], ['token' => md5(random_bytes(16)), 'token_created_at' => date(Config::DATE_FORMAT)]);
  }

  public function login($user){
    $db_user = $this->dao->get_user_by_email($user['email']);
    if (!isset($db_user['id'])) throw new Exception("User doesn't exists", 400);
    if ($db_user['status'] != 'ACTIVE') throw new Exception("Account is not active!", 400);
    if ($db_user['password'] != md5($user['password'])) throw new Exception("Invalid password! Try again!", 400);

    return $db_user;
  }
  
  public function ban($id){
    execute_update('users', $id, 'BANNED', 'status');
  }

  public function register($user){
    try {
      $this->dao->beginTransaction();

      $user = parent::add([
        "user_name" => $user['user_name'],
        "surname" => $user['surname'],
        "password" => md5($user['password']),
        "email" => $user['email']
      ]);

      $this->dao->commit();

    } catch (\Exception $e) {
      echo "Invalid";
  

    }

    return $user;
    }
  


  public function confirm($token){
    $user = $this->dao->get_user_by_token($token);
    if (!isset($user['id'])) throw new Exception("Invalid token!", 400);
    $this->dao->update($user['id'], ["status" => "ACTIVE", "token" => NULL]);
    return $user;
  }

  public function get_users($search, $offset, $limit, $order, $total = FALSE){
    return $this->dao->get_users($search, $offset, $limit, $order, $total);
  }

  public function get_user_by_id($id){
    return $this->dao->get_by_id($id);

  }
}



?>