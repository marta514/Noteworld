<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use App\Http\Requests\StorePersonajeRequest;
use App\Http\Requests\UpdatePersonajeRequest;

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
    public function create()
{
    $mundos = \App\Models\Mundo::all();
    return view('personajes.create', compact('mundos'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonajeRequest $request)
    {
        //
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
}
