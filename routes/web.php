<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api/client', 'middleware' => 'clientAuth'], function() use ($router) {
});

$router->group(['prefix' => '/api/user', 'middleware' => 'userAuth'], function() use ($router) {
});

$router->post('/api/client/login', 'Auth\ClientAuthController@index');
$router->post('/api/client/register', 'ClientController@store');

$router->post('/api/user/login', 'Auth\UserAuthController@index');
