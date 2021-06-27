<?php

require_once dirname(__FILE__)."../BaseDao.class.php";

class FollowersDao extends BaseDao{

    public function __construct(){
        parent::construct("followers");
    }

    public function insert_follower(){
        $data= [
            "id" => $post[''],
            "user_id" => $post['user_id'],
            "follower_id" => $post['follower_id']
          ];
           return parent::add($data);
      
    }


}


?>