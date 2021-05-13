<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api/client', 'middleware' => 'clientAuth'], function() use ($router) {
});

$router->post('/api/client/login', 'JWTController@index');
$router->post('/api/client/register', 'ClientController@create');
