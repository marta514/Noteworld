<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MundoController;
use App\Http\Controllers\PersonajeController;
use App\Http\Controllers\EntradaController;

Route::get('/', function () {
    // Si el usuario ya inició sesión...
    if (auth()->check()) {
        // Evaluamos su rol y lo redirigimos
        return auth()->user()->role === 'admin' 
            ? redirect()->route('dashboard.admin') 
            : redirect()->route('dashboard.escritor');
    }
    
    // Si no ha iniciado sesión, le mostramos el registro
    return view('auth.register'); 
})->name('home');

Route::get('/generar-token', function () {
    // Toma al usuario administrador o al que tengas registrado
    $usuario = \App\Models\User::first(); 
    return $usuario->createToken('token-de-prueba')->plainTextToken;
});


// UN SOLO GRUPO PROTEGIDO PARA TODO
Route::middleware(['auth'])->group(function () {
    
    // --- 1. DASHBOARDS ---
    Route::get('/panel-escritor', function () {
        $misMundos = \App\Models\Mundo::where('user_id', auth()->id())->get();
        $comunidad = \App\Models\Mundo::where('user_id', '!=', auth()->id())
                                      ->latest()
                                      ->take(6)
                                      ->get();
        return view('dashboards.escritor', compact('misMundos', 'comunidad'));
    })->name('dashboard.escritor');

   Route::get('/panel-admin', function () {
        // Buscamos las imágenes que Postman dejó como "pending"
        $imagenesPendientes = \App\Models\Image::where('estado', 'pending')->get();
        
        return view('dashboards.admin', compact('imagenesPendientes'));
    })->name('dashboard.admin');

    // Ruta para aprobar imágenes desde el panel de admin
    Route::patch('/admin/imagenes/{id}/aprobar', function ($id) {
        $imagen = \App\Models\Image::findOrFail($id);
        $imagen->estado = 'approved';
        $imagen->save();
        
        // Recargamos la página con un mensaje de éxito
        return back()->with('success', '¡Imagen aprobada y enviada al moodboard!');
    })->name('admin.imagenes.aprobar');

    // --- 2. RUTAS PERSONALIZADAS (Moodboards) ---
    Route::get('/mundos/{mundo}/moodboard', [MundoController::class, 'moodboard'])->name('mundos.moodboard');
    Route::get('/personajes/{personaje}/moodboard', [PersonajeController::class, 'moodboard'])->name('personajes.moodboard');


    // --- 3. RECURSOS (CRUDS) ---
    Route::resource('mundos', MundoController::class)->except(['index']);
    Route::resource('personajes', PersonajeController::class)->except(['index']);
    Route::resource('entradas', EntradaController::class)->except(['index']);


    // --- 4. PERFIL DE USUARIO (Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';