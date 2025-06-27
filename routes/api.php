<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de  autenticación
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Rutas de Administrador
Route::prefix('/admin')->middleware(['auth:api'])->group(function () {
    // Rutas de Administrador
    Route::apiResource('/users', UserController::class)->except(['show']);
    Route::apiResource('/products', ProductController::class)->except(['show']);

    // Rutas para ver las Ventas
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
});

// Rutas de Usuario
Route::prefix('/user')->middleware(['auth:api'])->group(function () {
    // Rutas de Usuario
    Route::post('/add-car', [VentasController::class, 'addCar'])->name('ventas.addCar');
});
