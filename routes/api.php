<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComputerPartController;

// Públicos: Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Públicos: Consultar Piezas
Route::get('/parts', [ComputerPartController::class, 'index']);
Route::get('/parts/{id}', [ComputerPartController::class, 'show']);

// Privados: Gestión (Solo con Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/parts', [ComputerPartController::class, 'store']);
    Route::delete('/parts/{id}', [ComputerPartController::class, 'destroy']);
});