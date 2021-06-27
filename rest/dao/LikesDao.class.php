<?php

require_once dirname(__FILE__)."../BaseDao.class.php";

class LikesDao extends BaseDao{

    public function __construct(){
        parent::construct("post_likes");
    }

    public function get_likes($search, $offset, $limit, $order, $total=FALSE){
        list($order_column, $order_direction) = self::parse_order($order);
    
        $params = [];
    
        if ($total){
          $query = "SELECT COUNT(*) AS total ";
        }else{
          $query = "SELECT * ";
        }
        $query .= "FROM post_likes ";
    
        if (isset($search)){
          $query .= "WHERE (LOWER(rating_value) LIKE CONCAT('%', :search, '%'))";
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

}


?>