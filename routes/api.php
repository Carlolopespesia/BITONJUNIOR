<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterUserController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\LogoutController;

use App\Http\Controllers\BookController;
//Aqui van los endpoints - es la ruta en la API donde el frontend
//Envia solicitudes HTTP para acceder, actualizar y eliminar datos.
// Rutas Públicas 
Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterUserController::class, 'store']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);


// Rutas Protegidas (Requieren Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::delete('/logout', [LogoutController::class, 'destroy']);
});
});