<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Rutas protegidas

Route::middleware('auth:api')->group(function () {
    Route::apiResource('proyectos', ProyectoController::class);
    
    
    
    
    
});



