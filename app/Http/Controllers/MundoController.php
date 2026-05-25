<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMundoRequest;
use App\Models\Mundo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Collection; // <--- AGREGA ESTA LÍNEA
use App\Models\Image;  

class MundoController extends Controller
{


    // Su única misión es mostrar el formulario HTML
    public function create()
    {
        return view('mundos.create');
    }
// Función para eliminar un mundo
    public function destroy(Mundo $mundo)
{
    // 1. SEGURIDAD: Validar propiedad
    if ($mundo->user_id !== auth()->id()) {
        abort(403, 'Acceso denegado.');
    }

    // 2. ELIMINACIÓN
    $mundo->delete();

    // 3. REDIRECCIÓN AL DASHBOARD DEL ESCRITOR
    return redirect()->route('dashboard.escritor')
                     ->with('success', 'El mundo ha sido eliminado correctamente.');
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
    if ($mundo->user_id !== auth()->id()) {
        abort(403, 'Acceso denegado: Este mundo no te pertenece.');
    }

    return view('mundos.edit', compact('mundo'));
}

public function update(Request $request, Mundo $mundo)
{
    // 1. Validamos los campos
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
    ]);

    // 2. Actualizamos el registro en la base de datos
    $mundo->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
    ]);

    // 3. Redirigimos de vuelta a la vista del mundo con un mensaje de éxito
    return redirect()->route('mundos.show', $mundo->id)
                     ->with('success', '¡El mundo ha sido actualizado con éxito!');
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
  // Actualiza tu función moodboard existente
public function moodboard(Mundo $mundo) 
{
    // 1. Traemos todas las imágenes globales aprobadas en la API
    $imagenesApi = \App\Models\Image::where('estado', 'approved')->get();
    
    // 2. Traemos las imágenes que el usuario ya guardó en la cuadrícula de este mundo
    $imagenesGuardadas = $mundo->imagenesMoodboard;

    return view('mundos.moodboard', compact('mundo', 'imagenesApi', 'imagenesGuardadas'));
}

// Agrega esta NUEVA función justo debajo
public function agregarAlMoodboard(Request $request, Mundo $mundo) 
{
    // ¡SEGURIDAD AÑADIDA! Solo el creador puede agregar imágenes
    if ($mundo->user_id !== auth()->id()) {
        abort(403, 'No tienes permiso para editar el moodboard de este mundo.');
    }

    $mundo->imagenesMoodboard()->attach($request->image_id);
    return back()->with('success', '¡Imagen añadida a tu cuadrícula!');
}
}