<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router) {
    // Recuperar senha
    $router->group(['prefix' => 'client/password'], function() use ($router) {
        $router->post('reset', 'ClientRecoveryController@sendToken');
        $router->put('reset/{token}', 'ClientRecoveryController@setPassword');
        $router->get('reset/{token}', 'ClientRecoveryController@checkToken');
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


