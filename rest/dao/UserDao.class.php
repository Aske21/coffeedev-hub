<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao{

    public function add_user($user){
        $sql = "INSERT INTO users (id, password, email, name, surname ) VALUES (:id, :password, :email, :name, :surname)";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($user);
        $user['id'] = $this->connection->lastInsertId();
        return $user;
      }
    

      public function get_all_users(){
        return $this->query("SELECT * FROM users");
      }

      public function get_user_by_email($email){
        return $this->query_unique("SELECT * FROM users WHERE email = :email", ["email" => $email]);
      }
    
      public function update_user_by_email($email, $user){
        $this->update("users", $email, $user, "email");
      }
    
      public function get_user_by_token($token){
        return $this->query_unique("SELECT * FROM users WHERE token = :token", ["token" => $token]);
      }
}
?>