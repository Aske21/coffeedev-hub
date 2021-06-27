<?php

Flight::route('GET /users', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::userService()->get_users($search, $offset, $limit, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::userService()->get_users($search, $offset, $limit, $order));
});


Flight::route('GET /users/@id', function($id){
    Flight::json(Flight::userService()->get_user_by_id($id));
  });
  

Flight::route('PUT /users/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->update($id, $data));
  });

Flight::route('PUT /user/info', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->update(Flight::get("user")["id"],$data));
  });

Flight::route('POST /login', function(){
    Flight::json(Flight::jwt(Flight::userService()->login(Flight::request()->data->getData())));
  });

Flight::route('GET /user/info', function(){
    Flight::json(Flight::userService()->get_by_id_user(Flight::get("user")["id"]));
  });

Flight::route('POST /register', function(){
    $data = Flight::request()->data->getData();
    Flight::userService()->register($data);
    Flight::json(["message" => "Confirmation email has been sent. Please confirm your account."]);
   });

Flight::route('GET /confirm/@token', function($token){
    Flight::json(Flight::jwt(Flight::userService()->confirm($token)));
  });

Flight::route('POST /login', function(){
    Flight::json(Flight::jwt(Flight::userService()->login(Flight::request()->data->getData())));
  });
  
Flight::route('POST /reset', function(){
    Flight::json(Flight::jwt(Flight::userService()->reset(Flight::request()->data->getData())));
  });
  
?>