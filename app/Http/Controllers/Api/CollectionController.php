<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    // GET /api/colecciones
    public function index()
{
    // Usamos el modelo correcto y nos aseguramos de retornar JSON
    $colecciones = \App\Models\Collection::all();
    return response()->json($colecciones);
}
    // POST /api/colecciones
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $coleccion = Collection::create([
            'nombre' => $request->nombre
        ]);

        return response()->json($coleccion, 201);
    }
}
