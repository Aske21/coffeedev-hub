<?php

require_once dirname(__FILE__)."/../config.php";

class BaseDao{

    protected $connection;

    private $table;

    public function __construct(){
        try {
            $this->connection = new PDO("mysql:hostname=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "connected";
        }catch(PDOException $e){
            throw $e;
        }
    }


    


}


?>