<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/PostsDao.class.php';

class PostService extends BaseService{

  public function __construct(){
    $this->dao = new PostsDao();
  }

  public function add_post($post){

    $data= [
      "id" => $post[''],
      "user_id" => $post['user_id'],
      "body" => $post['body'],
      "posted_at" => date("Y-m-d H:i:s"),
      "postimg" => null,

    ];
     return parent::add($data);

  }

  public function get_posts($search, $offset, $limit, $order, $total = FALSE){
    return $this->dao->get_posts($search, $offset, $limit, $order, $total);
  }


}
?>