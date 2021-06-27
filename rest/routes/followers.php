<?php

Flight::route('GET /followers', function(){
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 25);
    $search = Flight::query('search');
    $order = Flight::query('order', "-id");

    Flight::json(Flight::followersService()->get_followers($search, $offset, $limit, $order));


});






?>