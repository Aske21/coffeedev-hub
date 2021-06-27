<?php

Flight::route('GET /ratings', function(){
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 25);
    $search = Flight::query('search');
    $order = Flight::query('order', "-id");
  
    $total = Flight::ratingService()->get_ratings($search, $offset, $limit, $order, TRUE);
    header('total-ratings: ' . $total['total']);
    Flight::json(Flight::ratingService()->get_ratings($search, $offset, $limit, $order));
  });


  Flight::route('GET /ratings/get-avg-rating-for-post/@id', function($id){
    Flight::json(Flight::ratingService()->get_avg_rating_for_post($id));
  });
  

  Flight::route('POST /user/ratings', function(){
    $data = Flight::request()->data->getData();
    Flight::ratingService()->add_rating(Flight::get("user"),$data);
    Flight::json(["message"=>"Your rating has been posted"]);
  });

?>