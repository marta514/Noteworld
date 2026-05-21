<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * ENDPOINT 1 (index): Devuelve solo las imágenes aprobadas.
     */
    public function index()
    {
        // Solo mostramos las imágenes que el admin ya aprobó
        $images = Image::where('estado', 'approved')->with('collection')->get();
        
        // Código 200: OK
        return response()->json([
            'success' => true,
            'data' => $images
        ], 200);
    }

    /**
     * ENDPOINT 2 (store): Permite subir una imagen nueva.
     */
    public function store(Request $request)
{
    // 1. Validamos que el archivo sea realmente una imagen
    $validated = $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'collection_id' => 'required|exists:collections,id',
        'ref_type' => 'required|string',
        'ref_id' => 'required|integer',
    ]);

    // 2. Guardamos físicamente la imagen en la carpeta public/moodboards
    $path = $request->file('image')->store('moodboards', 'public');

    // 3. Guardamos el registro en la base de datos (Estado pendiente)
    $image = \App\Models\Image::create([
        'user_id' => auth()->id(),
        'url' => asset('storage/' . $path), // Genera la URL pública
        'ref_type' => $validated['ref_type'],
        'ref_id' => $validated['ref_id'],
        'collection_id' => $validated['collection_id'],
        'estado' => 'pending', 
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Imagen subida correctamente y en espera de aprobación por el Admin.',
        'data' => $image
    ], 201);
}

    /**
     * ENDPOINT 3 (show): Muestra los detalles de una sola imagen.
     */
    public function show($id)
    {
        $image = Image::find($id);

        if (!$image) {
            // Código 404: No encontrado
            return response()->json([
                'success' => false,
                'message' => 'Imagen no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $image
        ], 200);
    }
}