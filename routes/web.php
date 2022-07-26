<?php

/** @var Router $router */

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
use App\Http\Controllers\Todo\TodoController;
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/todos', 'TodoController@index');
$router->get('/todo/{id}', 'TodoController@show');
$router->get('/todo/{id}/done', 'TodoController@doneTodo');
$router->post('/todo', 'TodoController@store');
$router->put('/todo/{id}', 'TodoController@update');
$router->delete('/todo/{id}', 'TodoController@destroy');
