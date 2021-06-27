<?php

require dirname(__FILE__)."../BaseDao.class.php";

class CommentsDao extends BaseDao{

    public function construct__(){
        parent::extends("comments");
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

}


?>