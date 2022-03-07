<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->group(["prefix" => "/v1"], function () use ($router) {
    $router->group(["prefix" => "/user"], function () use ($router) {
        $router->post('/register', 'UserController@store');
        $router->get('/get', 'UserController@getAll');
        $router->get('/get/{id}', 'UserController@getUserById');
        $router->put('/update/{id}', 'UserController@update');
        $router->delete('/delete/{id}', 'UserController@delete');
        $router->get('/getDeleted', 'UserController@getAllUsersDeleted');
        $router->get('/restore/{id}', 'UserController@restore');
    });
});
