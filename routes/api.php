<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\AuthController;

// 🟢 RUTA PÚBLICA (No requiere token)
Route::post('/login', [AuthController::class, 'login']);

// 🔴 RUTAS PROTEGIDAS (Requieren token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/images', [ImageController::class, 'index']);      
    Route::post('/images', [ImageController::class, 'store']);     
    Route::get('/images/{id}', [ImageController::class, 'show']);  
});