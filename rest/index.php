<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/UserDao.class.php";
require_once dirname(__FILE__)."/../vendor/autoload.php";


Flight::register('userDao', 'UserDao');

require_once dirname(__FILE__)."./routes/users.php";

Flight::set('flight.log_errors', TRUE);


// err handling
Flight::map('error', function(Exception $ex){
    Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
  });
  

  /* utility function for reading query parameters from URL */
Flight::map('query', function($name, $default_value = NULL){
    $request = Flight::request();
    $query_param = @$request->query->getData()[$name];
    $query_param = $query_param ? $query_param : $default_value;
    return urldecode($query_param);
  });

  Flight::map('header', function($name){
    $headers = getallheaders();
    return @$headers[$name];
  });

  Flight::route('GET /swagger', function(){
    $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
    header('Content-Type: application/json');
    echo $openapi->toJson();
  });

  Flight::route('GET /', function(){
    Flight::redirect('/docs');
  });


  // register
    Flight::register('commentService', 'CommentService');
    Flight::register('followersService', 'FollowersService');
    Flight::register('likesService', 'LikesService');
    Flight::register('postsService', 'PostsService');
    Flight::register('userService', 'UserService');


// includes

require_once dirname(__FILE__)."/routes/comments.php";
require_once dirname(__FILE__)."/routes/followers.php";
require_once dirname(__FILE__)."/routes/likes.php";
require_once dirname(__FILE__)."/routes/messages.php";
require_once dirname(__FILE__)."/routes/posts.php";
require_once dirname(__FILE__)."/routes/users.php";

?>