<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

// Home page
$router->get('/', 'HomeController@index');

// Auth routes
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@doLogin');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@doRegister');

// Ads
$router->get('/ads/create', 'AdController@create');
$router->post('/ads', 'AdController@store');

$router->dispatch();
