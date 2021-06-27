<?php

require_once dirname(__FILE__)."../BaseDao.class.php";

class LikesDao extends BaseDao{

    public function __construct(){
        parent::construct("post_likes");
    }

   

}


?>