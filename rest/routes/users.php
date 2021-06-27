<?php

Flight::route('POST /register', function(){
    $data = Flight::request()->data->getData();
    Flight::userService()->register($data);
    Flight::json(["message" => "Confirmation email has been sent. Please confirm your account"]);
  });
  

  Flight::route('POST /login', function(){
    Flight::json(Flight::jwt(Flight::userService()->login(Flight::request()->data->getData())));
  });
  
  Flight::route('POST /forgot', function(){
    $data = Flight::request()->data->getData();
    Flight::userService()->forgot($data);
    Flight::json(["message" => "Recovery link has been sent to your email"]);
  });




?>