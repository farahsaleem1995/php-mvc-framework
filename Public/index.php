<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Core\Application;


$app = new Application(dirname(__DIR__));

$app->router->get('/', [HomeController::class, 'show']);

$app->router->get('/contact', [ContactController::class, 'show']);

$app->router->post('/contact', [ContactController::class, 'store']);

$app->router->get('/login', [AuthController::class, 'showLogin']);

$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'showRegister']);

$app->router->post('/register', [AuthController::class, 'register']);

$app->run();
