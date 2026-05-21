<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMundoRequest;
use App\Models\Mundo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MundoController extends Controller
{


    // Su única misión es mostrar el formulario HTML
    public function create()
    {
        return view('mundos.create');
    }

    // Función para guardar en base de datos (Esta ya la tienes)
    public function store(StoreMundoRequest $request)
    {
        // 1. Validamos los datos
        $datosValidados = $request->validated();
        
        // 2. Le asignamos el ID del usuario logueado
        $datosValidados['user_id'] = auth()->id();
        
        // 3. Guardamos el mundo en una variable para saber su ID recién creado
        $nuevoMundo = Mundo::create($datosValidados); 
        
        // 4. ¡LA CORRECCIÓN! Redirigimos a la vista 'show' del nuevo mundo
        return redirect()->route('mundos.show', $nuevoMundo->id)
                         ->with('success', '¡Un nuevo mundo ha nacido en tu libreta!');
    }

    public function edit(Mundo $mundo)
    {
        // Si no es el dueño, Laravel arrojará un error 403 (No autorizado) automáticamente
        Gate::authorize('update', $mundo);

        return view('mundos.edit', compact('mundo'));
    }
    
  // Función para mostrar los detalles de un mundo específico
    public function show(Mundo $mundo)
    {
        // Cargamos el mundo junto con sus personajes y entradas usando 'Eager Loading'
        $mundo->load(['personajes', 'entradas']);
        
        // Retornamos la vista que creamos y le pasamos los datos del mundo
        return view('mundos.show', compact('mundo'));
    }

    // Función para mostrar el moodboard de un mundo
   public function moodboard(\App\Models\Mundo $mundo)
    {
        $imagenesAprobadas = \App\Models\Image::where('ref_type', 'mundo')
                                              ->where('estado', 'approved')
                                              ->get();

        return view('mundos.moodboard', compact('mundo', 'imagenesAprobadas'));
    }
}