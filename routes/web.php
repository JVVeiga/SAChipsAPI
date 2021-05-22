<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router) {
    // Clientes - Recuperar senha
    $router->group(['prefix' => 'client/password/reset'], function() use ($router) {
        $router->post('', 'ClientRecoveryController@sendToken');
        $router->put('{token}', 'ClientRecoveryController@setPassword');
        $router->get('{token}', 'ClientRecoveryController@checkToken');
    });

    // Usuários - Recuperar senha
    $router->group(['prefix' => 'user/password/reset'], function() use ($router) {
        $router->post('', 'UserRecoveryController@sendToken');
        $router->put('{token}', 'UserRecoveryController@setPassword');
        $router->get('{token}', 'UserRecoveryController@checkToken');
    });

    // Clientes
    $router->post('client/login', 'Auth\ClientAuthController@index');
    $router->post('client/register', 'ClientController@store');

    $router->group(['prefix' => 'client', 'middleware' => 'clientAuth'], function() use ($router) {
        $router->get('adresses', 'ClientAddressController@index');
        $router->post('address', 'ClientAddressController@store');
        $router->put('address/{id}', 'ClientAddressController@update');
        $router->delete('address/{id}', 'ClientAddressController@destroy');

        $router->get('phones', 'ClientPhoneController@index');
        $router->post('phone', 'ClientPhoneController@store');
        $router->put('phone/{id}', 'ClientPhoneController@update');
        $router->delete('phone/{id}', 'ClientPhoneController@destroy');
    });

    // Usuários
    $router->post('user/login', 'Auth\UserAuthController@index');

    $router->group(['prefix' => 'user', 'middleware' => 'userAuth'], function() use ($router) {
        $router->post('register', 'UserController@store');
    });

    // Geral
    $router->get('states', 'StateController@index');
    $router->get('state/{id}/cities', 'CityController@findByState');
    $router->get('city/{id}/neighborhoods', 'NeighborhoodController@findByCity');
});


