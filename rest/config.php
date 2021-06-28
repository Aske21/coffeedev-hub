<?php
class Config{

        const DATE_FORMAT = "Y-m-d H:i:s";
        
        public static function DB_HOST(){
                return Config::get_env("DB_HOST", "localhost");
              }
              public static function DB_USERNAME(){
                return Config::get_env("DB_USERNAME", "root");
              }
              public static function DB_PASSWORD(){
                return Config::get_env("DB_PASSWORD", "root123");
              }
              public static function DB_SCHEME(){
                return Config::get_env("DB_SCHEME", "socialnetwork");
              }


              public static function get_env($name, $default){
                return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
              }

}


const JWT_SECRET = "y4KvQcZVqn3F7uxQvcFk";
const JWT_TOKEN_TIME = 604800;


?>