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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntradaRequest $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada)
    {
        //
    }
}
