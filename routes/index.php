<?php

require dirname(__DIR__).'/config/app.php';
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application. 
|
*/

$app->router->get('/', [AppController::class, 'homePage']);
$app->router->get('/create', [AppController::class, 'create']);
$app->router->get('/my-posts', [AppController::class, 'myPosts']);
$app->router->get('/view/{id}', [AppController::class, 'view']);
$app->router->get('/edit/{id}', [AppController::class, 'edit']);
$app->router->get('/delete/{id}', [AppController::class, 'delete']);
$app->router->post('/create', [AppController::class, 'create']);
$app->router->post('/editPost', [AppController::class, 'editPost']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

$app->run();