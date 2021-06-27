<?php

require_once dirname(__FILE__)."../BaseDao.class.php";

class FollowersDao extends BaseDao{

    public function __construct(){
        parent::__construct("followers");
    }

    public function insert_follower(){
        $data= [
            "id" => $post[''],
            "user_id" => $post['user_id'],
            "follower_id" => $post['follower_id']
          ];
           return parent::add($data);
      
    }

    
    public function get_followers($search, $offset, $limit, $order, $total=FALSE){
        list($order_column, $order_direction) = self::parse_order($order);
    
        $params = [];
    
        if ($total){
          $query = "SELECT COUNT(*) AS total ";
        }else{
          $query = "SELECT * ";
        }
        $query .= "FROM followers ";
    
        if (isset($search)){
            $query .= "WHERE (LOWER(follower_id) LIKE CONCAT('%', :search, '%'))";
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

      public function deleteFollower($userid, $followerid){
          return $this->query("DELETE FROM followers WHERE user_id =: $userid AND follower_id =: $followerid");
      }



}


?>