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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personaje $personaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonajeRequest $request, Personaje $personaje)
    {
        //
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
    public function moodboard(\App\Models\Personaje $personaje)
    {
        $imagenesAprobadas = \App\Models\Image::where('ref_type', 'personaje')
                                              ->where('estado', 'approved')
                                              ->get();

        return view('personajes.moodboard', compact('personaje', 'imagenesAprobadas'));
    }
} 