<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Http\Requests\StoreEntradaRequest;
use App\Http\Requests\UpdateEntradaRequest;
    use Illuminate\Http\Request;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = \App\Models\Entrada::all();
        return view('entradas.index', compact('entradas'));
    }

    /**
     * Show the form for creating a new resource.
     */

public function create(Request $request)
{
    $mundos = \App\Models\Mundo::all();
    $mundoSeleccionadoId = $request->query('mundo_id');

    return view('entradas.create', compact('mundos', 'mundoSeleccionadoId'));
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreEntradaRequest $request)
{
    $datosValidados = $request->validated();

    Entrada::create($datosValidados);

    return redirect()->route('mundos.show', $datosValidados['mundo_id'])
                     ->with('success', '¡Nueva entrada de historia añadida al registro!');
}

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        return view('entradas.show', compact('entrada'));
    }

   public function edit(Entrada $entrada)
{
    if ($entrada->mundo->user_id !== auth()->id()) {
        abort(403, 'Acceso denegado: No puedes editar el lore de otros mundos.');
    }

    return view('entradas.edit', compact('entrada'));
}

public function update(Request $request, Entrada $entrada)
{
    // 1. Validamos los datos entrantes
    $request->validate([
        'titulo' => 'required|string|max:255',
        'categoria' => 'required|string',
        'contenido' => 'required|string',
    ]);

    // 2. Actualizamos la entrada en la base de datos
    $entrada->update([
        'titulo' => $request->titulo,
        'categoria' => $request->categoria,
        'contenido' => $request->contenido,
    ]);

    // 3. Redirigimos de vuelta a la vista de lectura con un mensaje de éxito
    return redirect()->route('entradas.show', $entrada->id)
                     ->with('success', '¡El pergamino ha sido reescrito con éxito!');
}

    public function destroy(Entrada $entrada)
{
    // Guardamos el ID del mundo para regresar después
    $mundoId = $entrada->mundo_id;

    // Eliminamos la entrada
    $entrada->delete();

    // Redirigimos al mundo con un aviso
    return redirect()->route('mundos.show', $mundoId)
                     ->with('success', 'La entrada ha sido eliminada con éxito.');
}
}
