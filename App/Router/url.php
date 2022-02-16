<?php

use Albet\Asmvc\Controllers\AdminController;
use Albet\Asmvc\Controllers\AuthController;
use Albet\Asmvc\Core\Route;
use Albet\Asmvc\Middleware\Admin;
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
Route::add('/admin/dashboard', [AdminController::class, 'index'], Admin::class);
Route::add('/admin/akun', [AdminController::class, 'akun'], Admin::class);
Route::add('/admin/akun/buat', [AdminController::class, 'vBuatAkun'], Admin::class);
Route::add('/admin/akun/aksi_buat', [AdminController::class, 'buatAkun'], 'POST', Admin::class);
Route::add('/logout', [AuthController::class, 'logout'], 'POST');
