<?php

require_once dirname(__FILE__)."/../vendor/autoload.php";
require_once dirname(__FILE__)."/dao/CommentsDao.class.php";
require_once dirname(__FILE__)."/dao/UserDao.class.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "works";

$dao = new CommentsDao("comments");

$comments = [
    "id" => 2,
    "comment" => "this is a test comment",
    "user_id" => 1,
    "posted_at" => date("Y-m-d H:i:s"),
    "post_id" => 1,
    
  ];

$comments = $dao->add($comments);  

print_r($comments);
// $user_dao = new UserDao("users");

// $user = $user_dao->get_user_by_email("aske@gmail.com");
// //$user = $user_dao->get_user_by_id(3);

// $user1 = [
//     "id" => "2",
//     "password" => "12345",
//     "email" => "aske@gmail.com",
//     "name" => "Asim",
//     "surname" => "Veledarevic",
    
//   ];


// $user = $user_dao->add_user($user1);

?>
