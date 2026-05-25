<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MundoController;
use App\Http\Controllers\PersonajeController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitacionColaborador;
use App\Http\Controllers\IAController;
use App\Http\Controllers\DashboardController;

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
    // --- 1. DASHBOARDS ---
    Route::get('/panel-escritor', [DashboardController::class, 'escritor'])->name('dashboard.escritor');
    Route::get('/panel-admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    

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
    Route::post('/mundos/{mundo}/moodboard/agregar', [MundoController::class, 'agregarAlMoodboard'])->name('mundos.moodboard.agregar');
    Route::post('/personajes/{personaje}/moodboard/agregar', [App\Http\Controllers\PersonajeController::class, 'agregarAlMoodboard'])
    ->name('personajes.moodboard.agregar')
    ->middleware('auth');

    // --- 3. RECURSOS (CRUDS) ---
    Route::resource('mundos', MundoController::class)->except(['index']);
    Route::resource('personajes', PersonajeController::class)->except(['index']);
    Route::resource('entradas', EntradaController::class)->except(['index']);
    Route::get('/mundos/{mundo}/biblia', [PdfController::class, 'generarBiblia'])->name('pdf.biblia');


    // --- 4. PERFIL DE USUARIO (Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ruta para que el admin envíe invitaciones
    Route::post('/admin/invitar', function (\Illuminate\Http\Request $request) {
        $request->validate(['email' => 'required|email']);
        
        // Enviamos el correo usando el sistema Mail de Laravel
        Mail::to($request->email)->send(new InvitacionColaborador($request->email));
        
        return back()->with('success', '¡Invitación enviada correctamente!');
    })->name('admin.invitar');

    Route::post('/ia/inspirar', [IAController::class, 'inspirar'])->name('ia.inspirar');

    // Rutas Públicas de la API (Para invitados)
Route::get('/colaborar', function () {
    return view('api.colaborar');
})->name('colaborar')->middleware('signed'); // <-- ¡El candado mágico!

Route::post('/colaborar/subir', [\App\Http\Controllers\Api\ImageController::class, 'store'])->name('colaborar.subir');
});


require __DIR__.'/auth.php';