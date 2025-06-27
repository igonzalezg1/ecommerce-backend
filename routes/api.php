<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de  autenticación
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
