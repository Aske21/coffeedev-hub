<?php

require_once dirname(__FILE__)."../BaseDao.class.php";

class CommentsDao extends BaseDao{

    public function __construct(){
        parent::__construct("comments");
      }

    public function add_comment($comment){
        return $this->insert("comments", $comment);
    }


    public function update_comment($id, $comment){
        return $this->update("comments", $id, $comment);
    }

    public function get_comments_by_id($id){
        return $this->query_unique("SELECT * FROM comments WHERE id = :id", ["id" => id]);
    }


    public function get_all_comments(){
        return $this->query("SELECT * FROM comments");
    }

    public function get_comments($search, $offset, $limit, $order, $total=FALSE){
        list($order_column, $order_direction) = self::parse_order($order);
    
        $params = [];
    
        if ($total){
          $query = "SELECT COUNT(*) AS total ";
        }else{
          $query = "SELECT * ";
        }
        $query .= "FROM comments ";
    
        if (isset($search)){
            $query .= "WHERE (LOWER(comment) LIKE CONCAT('%', :search, '%'))";
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