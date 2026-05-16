<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        // Redirección automática al dashboard correspondiente según el rol
        return auth()->user()->role === 'admin' 
            ? redirect()->route('') 
            : redirect()->route('');
    }
    return view('auth.register');
})->name('home');

Route::get('/catalogo', [ReservacionController::class, 'catalogo'])->name('catalogo');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS 
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // --- SECCIÓN ESCRITOR ---
    Route::middleware(['role:escritor'])->group(function () {
    });

    // --- SECCIÓN ADMINISTRADOR ---
    Route::middleware(['role:admin'])->group(function () {
        
    });
});