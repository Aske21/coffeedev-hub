<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao{

    public function add_user($user){
        $sql = "INSERT INTO users (id, username, password, name, last_name, email) VALUES (:id, :username, :password, :name, :last_name, :email)";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($user);
        $user['id'] = $this->connection->lastInsertId();
        return $user;
      }
    
      public function update_user($id, $user){
    
      }

}
?>