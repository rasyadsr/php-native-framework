<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/config/config.php";

use App\Native\Core\Database;
use App\Native\Controller\HomeController;
use App\Native\Controller\ProductController;
use App\Native\Controller\UserController;
use App\Native\Core\Route;

Database::connect('prod');

Route::add('GET', '/', HomeController::class, 'index');
Route::add('GET', '/product/([0-9a-zA-Z]*)', ProductController::class, 'setProduct');

// Login
Route::add("GET", "/login", UserController::class, "login");
Route::add("POST", "/login", UserController::class, "postLogin");

Route::run();
