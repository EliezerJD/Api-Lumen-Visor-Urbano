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

$router->post('/login', 'UserController@login');

$router->group(["prefix" => "/v1", 'middleware' => 'auth'], function () use ($router) {
    $router->group(["prefix" => "/user", 'middleware' => 'admin'], function () use ($router) {
        $router->get('/get', 'UserController@getAll');
        $router->get('/get/{id}', 'UserController@getUserById');
        $router->post('/register', 'UserController@store');
        $router->put('/update/{id}', 'UserController@update');
        $router->delete('/delete/{id}', 'UserController@delete');
        $router->get('/getDeleted', 'UserController@getAllUsersDeleted');
        $router->get('/restore/{id}', 'UserController@restore'); 
    });

     $router->group(["prefix" => "/product", 'middleware' => 'admin'], function () use ($router) {
        $router->post('/register', 'ProductController@store');
        $router->put('/update/{id}', 'ProductController@update');
        $router->delete('/delete/{id}', 'ProductController@delete');
        $router->get('/getDeleted', 'ProductController@getAllProductsDeleted');
        $router->get('/restore/{id}', 'ProductController@restore'); 
    });

    $router->group(["prefix" => "/product"], function () use ($router) {
        $router->get('/get', 'ProductController@getAll');
        $router->get('/get/{id}', 'ProductController@getProductById');
    });
});
