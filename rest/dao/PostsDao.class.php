<?php

require_once dirname(__FILE__)."../BaseDao.class.php";

class PostsDao extends BaseDao{

    public function __construct(){
        parent::__construct("posts");
    }


    public function get_all_posts(){
        return $this->query("SELECT * FROM posts");
    }

    public function get_post_by_id(){
        
    }
}

?>