<?php

use Albet\Asmvc\Controllers\AuthController;
use Albet\Asmvc\Core\Route;
use Albet\Asmvc\Middleware\Guest;

/**
 * You can use following method for routing:
 * Route::add($urlPath, [Controller::class, 'methodName'], $HttpMethod, $Middleware).
 * Route::inline($urlPath, $CallableFunction, $httpMethod, $Middleware).
 * Route::view($path, [$view, $data], $httpMethod, $Middleware). Note: Array is not necessary if you not using $data.
 * $httpMethod and $middleWare can be optional.
 * It can either be
 * Route::add($urlPath, [Controller::class, 'methodName'], $HttpMethod) for Http method only
 * or
 * Route::add($urlPath, [Controller::class, 'methodName'], $Middleware) for Middleware only.
 * or both of them.
 * The same rules applies for inline and view. 
 */


//Your route
Route::add('/', [AuthController::class, 'login'], Guest::class);
Route::add('/login', [AuthController::class, 'auth'], 'POST', Guest::class);
Route::add('/register', [AuthController::class, 'vDaftar'], Guest::class);
Route::add('/daftar', [AuthController::class, 'daftar'], 'POST', Guest::class);
Route::add('/logout', [AuthController::class, 'logout'], 'POST');
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/pelanggan.php';
require_once __DIR__ . '/bank.php';
