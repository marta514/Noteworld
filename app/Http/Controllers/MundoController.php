<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMundoRequest;
use App\Models\Mundo;
use Illuminate\Http\Request;

class MundoController extends Controller
{
    // Función para mostrar la lista de mundos (Esta ya la tienes)
    public function index()
    {
        $mundos = Mundo::all(); 
        return view('mundos.index', compact('mundos'));
    }

    // ✨ ¡ESTA ES LA FUNCIÓN NUEVA QUE FALTA! ✨
    // Su única misión es mostrar el formulario HTML
    public function create()
    {
        return view('mundos.create');
    }

    // Función para guardar en base de datos (Esta ya la tienes)
    public function store(StoreMundoRequest $request)
    {
        $datosValidados = $request->validated();
        $datosValidados['user_id'] = auth()->id();

        Mundo::create($datosValidados);

        return redirect()->route('mundos.index')
                         ->with('success', '¡Un nuevo mundo ha nacido en tu libreta!');
    }

    public function show(Mundo $mundo)
{
    // Cargamos el mundo junto con sus personajes y entradas usando 'Eager Loading'
    $mundo->load(['personajes', 'entradas']);
    
    return view('mundos.show', compact('mundo'));
}
}