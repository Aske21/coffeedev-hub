<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";
require_once dirname(__FILE__)."/../vendor/autoload.php";

// services
require_once dirname(__FILE__)."/services/UserService.class.php";
require_once dirname(__FILE__)."/services/CommentsService.class.php";
require_once dirname(__FILE__)."/services/PostService.class.php";
require_once dirname(__FILE__)."/services/LikesService.class.php";
require_once dirname(__FILE__)."/services/FollowersService.class.php";
require_once dirname(__FILE__)."./routes/users.php";

Flight::set('flight.log_errors', TRUE);


// err handling
Flight::map('error', function(Throwable $ex){
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

  /* utility function for generating JWT token */
Flight::map('jwt', function($user){
  $jwt = \Firebase\JWT\JWT::encode(["exp" => (time() + Config::JWT_TOKEN_TIME), "id" => $user["id"], "aid" => $user["account_id"], "r" => $user["role"]], Config::JWT_SECRET);
  return ["token" => $jwt];
});


  // register
    Flight::register('commentService', 'CommentService');
    Flight::register('followersService', 'FollowersService');
    Flight::register('likesService', 'LikesService');
    Flight::register('postService', 'PostService');
    Flight::register('userService', 'UserService');


// includes

require_once dirname(__FILE__)."/routes/comments.php";
require_once dirname(__FILE__)."/routes/followers.php";
require_once dirname(__FILE__)."/routes/likes.php";
require_once dirname(__FILE__)."/routes/messages.php";
require_once dirname(__FILE__)."/routes/posts.php";
require_once dirname(__FILE__)."/routes/users.php";

Flight::start();

?>