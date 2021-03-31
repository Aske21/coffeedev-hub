<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/UserDao.class.php";

$user_dao = new UserDao();

$user1 = [
    "id" => "1",
    "username" => "asketo",
    "password" => "1234",
    "name" => "asim",
    "last_name" => "lelele",
    "email" => "asketo@gmail.com",
    
  ];

  $user = $user_dao->add_user($user1);



?>