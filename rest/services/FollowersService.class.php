<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/FollowersDao.class.php';

class FollowersService extends BaseService{


    public function __construct(){
        $this->dao = new FollowersDao();
      }


      public function add_follower(){
        return $this->dao->insert_follower;
      }
    
      public function get_followers($search, $offset, $limit, $order, $total = FALSE){
        return $this->dao->get_followers($search, $offset, $limit, $order, $total);
      }
    

    
   
}

?>