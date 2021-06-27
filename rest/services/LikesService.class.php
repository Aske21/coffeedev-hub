<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/LikesDao.class.php';


class LikesService extends BaseService {

    public function __construct(){
        $this->dao = new LikesDao();
      }
    
      public function get_ratings($search, $offset, $limit, $order, $total = FALSE){
        return $this->dao->get_ratings($search, $offset, $limit, $order, $total);
      }
    
      public function get_avg_rating_for_post($id){
        return $this->dao->get_avg_rating_for_post($id);
      }


}


?>