<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de  autenticación
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Rutas de Administrador
Route::prefix('/admin')->middleware(['auth:api'])->group(function () {
    Route::apiResource('/users', UserController::class)->except(['show']);
    Route::apiResource('/products', ProductController::class)->except(['show']);
});
