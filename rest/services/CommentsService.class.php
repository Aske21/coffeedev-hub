<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/CommentDao.class.php';

class CommentService extends BaseService{

  public function __construct(){
    $this->dao = new CommentDao();
  }

  public function add_comment($user, $comment){
    $data = [
      "id" => $user["id"],
      "comment" => $comment["comment_text"],
      "user_id" => $comment["user_id"],
      "posted_at" => date("Y-m-d H:i:s"),
      "post_id" => $comment["post_id"]
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