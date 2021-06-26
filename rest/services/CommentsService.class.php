<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/CommentDao.class.php';

class CommentService extends BaseService{

  public function __construct(){
    $this->dao = new CommentDao();
  }

  public function add_comment($user, $comment){
    $data = [
      "user_id" => $user["id"],
      "post_id" => $comment["post_id"],
      "comment" => $comment["comment_text"],
      "posted_at" => date()
    ];
    return parent::add($data);
  }

  public function get_comments($search, $offset, $limit, $order, $total = FALSE){
    return $this->dao->get_comments($search, $offset, $limit, $order, $total);
  }

  public function get_comments_by_post_id($id){
    return $this->dao->get_comments_by_post_id($id);
  }



  public function get_comment_by_comment_id($user_id, $id){
    return  $this->dao->get_comment_by_comment_id($user_id, $id);
  }


}
?>