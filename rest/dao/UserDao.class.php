<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao{


  public function __construct(){
    parent::__construct("users");
  }

    public function add_user($user){
        $sql = "INSERT INTO users (id, password, email, user_name, surname ) VALUES (:id, :password, :email, :user_name, :surname)";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($user);
        $user['id'] = $this->connection->lastInsertId();
        return $user;
      }
    
      public function get_users($search, $offset, $limit, $order, $total=FALSE){
        list($order_column, $order_direction) = self::parse_order($order);
    
        $params = [];
    
        if ($total){
          $query = "SELECT COUNT(*) AS total ";
        }else{
          $query = "SELECT * ";
        }
        $query .= "FROM users ";
    
        if (isset($search)){
            $query .= "WHERE (LOWER(user_name) LIKE CONCAT('%', :search, '%'))";
            $params['search'] = strtolower($search);
        }
    
        if ($total){
          return $this->query_unique($query, $params);
        }else{
          $query .="ORDER BY ${order_column} ${order_direction} ";
          $query .="LIMIT ${limit} OFFSET ${offset}";
    
          return $this->query($query, $params);
        }
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

      public function get_by_id_user(){
        return $this->query("SELECT * FROM users WHERE id = :id");
      }
}
?>