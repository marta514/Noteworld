<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use App\Http\Requests\StorePersonajeRequest;
use App\Http\Requests\UpdatePersonajeRequest;
use Illuminate\Http\Request;

class PersonajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personajes = \App\Models\Personaje::all();
        return view('personajes.index', compact('personajes'));
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create(Request $request)
    {
        // 1. Obtenemos todos los mundos por si el usuario quiere cambiarlo (exigencia de consistencia)
        $mundos = \App\Models\Mundo::all();
        
        // 2. Atrapamos el mundo_id que viene viajando en la URL (si es que viene)
        $mundoSeleccionadoId = $request->query('mundo_id');

        // 3. Mandamos ambas cosas a la vista
        return view('personajes.create', compact('mundos', 'mundoSeleccionadoId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonajeRequest $request)
    {
        $mundo = \App\Models\Mundo::findOrFail($request->mundo_id);
    if ($mundo->user_id !== auth()->id()) {
        abort(403, 'No puedes crear personajes en mundos ajenos.');
    }
        // Validamos los datos con tu Form Request
        $datosValidados = $request->validated();

        // Creamos el personaje
        Personaje::create($datosValidados);

        // Redirigimos de vuelta a los detalles del mundo al que pertenece
        return redirect()->route('mundos.show', $datosValidados['mundo_id'])
                         ->with('success', '¡Un nuevo personaje ha entrado a tu mundo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Personaje $personaje)
    {
        return view('personajes.show', compact('personaje'));
    }

    public function edit(Personaje $personaje)
{
    if ($personaje->mundo->user_id !== auth()->id()) {
        abort(403, 'Acceso denegado: No puedes editar personajes de otros mundos.');
    }
    // Carga la vista que acabamos de crear y le pasa el personaje
    return view('personajes.edit', compact('personaje'));
}

public function update(Request $request, Personaje $personaje)
{
    if ($personaje->mundo->user_id !== auth()->id()) {
        abort(403, 'Acceso denegado.');
    }
    // Validamos los datos (puedes ajustar las reglas si lo necesitas)
    $request->validate([
        'nombre' => 'required|string|max:255',
        'edad' => 'nullable|string|max:100',
        'genero' => 'nullable|string|max:100',
        'especie' => 'nullable|string|max:100',
        'biografia' => 'nullable|string',
        'apariencia_fisica' => 'nullable|string',
        'personalidad' => 'nullable|string',
    ]);

    // Actualizamos el personaje con los datos del formulario
    $personaje->update($request->all());

    // Lo enviamos de regreso a su ficha con un mensaje de éxito
    return redirect()->route('personajes.show', $personaje->id)
                     ->with('success', '¡La ficha del personaje ha sido actualizada!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personaje $personaje)
    {
        //
    }

    /**
     * Moodboard del personaje (¡Esta es la única que debe existir!)
     */
    public function moodboard(Personaje $personaje) 
{
    // 1. Buscamos las imágenes en la API
    $imagenesApi = \App\Models\Image::where('estado', 'approved')
                                    ->where('ref_type', 'personaje')
                                    ->get();
    
    // 2. Traemos las imágenes guardadas por este personaje
    $imagenesGuardadas = $personaje->imagenesMoodboard;

    // 3. ¡EL DETALLE ESTABA AQUÍ! 
    // Debemos enviar las tres variables ('personaje', 'imagenesApi', 'imagenesGuardadas')
    return view('personajes.moodboard', compact('personaje', 'imagenesApi', 'imagenesGuardadas'));
}

public function agregarAlMoodboard(Request $request, Personaje $personaje) 
{
    $personaje->imagenesMoodboard()->attach($request->image_id);
    return back()->with('success', '¡Imagen añadida a la ficha del personaje!');
}
} 