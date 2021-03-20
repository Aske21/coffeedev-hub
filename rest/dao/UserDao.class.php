<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class User extends BaseDao{

    public function __construct(){
        parent::__construct(); 
    
    }

    // fetching all emails
    public function getUserByEmail($email){
        return $this->query_uniqe("SELECT * FROM users WHERE email =: email", ["email" => $email]);
    
    }

    // updating user by their emails
    public function updateUserByEmail($email, $user){
        return $this->update("users", $email, $user, "email");
    }

    public function get_user_by_token($token){
        return $this->query_unique("SELECT * FROM users WHERE token = :token", ["token" => $token]);
      }


}

?>