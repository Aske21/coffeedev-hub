<?php

Flight::route('GET /comments', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::commentService()->get_comments($search, $offset, $limit, $order, TRUE);
  header('total-comments: ' . $total['total']);
  Flight::json(Flight::commentService()->get_comments($search, $offset, $limit, $order));
});


?>