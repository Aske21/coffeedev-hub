<?php

require_once dirname(__FILE__)."/../config.php";

class BaseDao{
    protected $connection;


    private $table;

    public function beginTransaction(){
        $response = $this->connection->beginTransaction();
    }

    public function commit(){
        $this->connection->commit();
    }

    public function __construct(){
      try {
        $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "connected";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }
  
    public function insert(){
        
    }
  
    public function update(){
  
    }
  
    public function query(){
        
    }
  
    public function query_unique(){
  
    }


}


?>