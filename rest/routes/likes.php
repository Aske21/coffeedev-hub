<?php

Flight::route('GET /likes', function(){
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 25);
    $search = Flight::query('search');
    $order = Flight::query('order', "-id");
  
    $total = Flight::likesService()->get_ratings($search, $offset, $limit, $order, TRUE);
    header('total-ratings: ' . $total['total']);
    Flight::json(Flight::likesService()->get_ratings($search, $offset, $limit, $order));
  });


  Flight::route('GET /likes/get-avg-rating-for-post/@id', function($id){
    Flight::json(Flight::likesService()->get_avg_rating_for_post($id));
  });
  

  Flight::route('POST /user/likes', function(){
    $data = Flight::request()->data->getData();
    Flight::likesService()->add_rating(Flight::get("user"),$data);
    Flight::json(["message"=>"Your rating has been posted"]);
  });

?>