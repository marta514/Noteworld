<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Http\Requests\StoreEntradaRequest;
use App\Http\Requests\UpdateEntradaRequest;

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
    public function create()
{
    $mundos = \App\Models\Mundo::all();
    return view('personajes.create', compact('mundos'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntradaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        //
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
