<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IAController extends Controller
{
    public function inspirar(Request $request)
    {
        // 1. Validamos el título
        $request->validate(['titulo' => 'required|string|max:255']);
        $titulo = $request->input('titulo');

        // 2. Construimos el Prompt
        $prompt = "Actúa como un escritor experto en worldbuilding. Escribe un párrafo introductorio creativo, épico e inspirador (máximo 4 líneas) basándote en este título: " . $titulo;

        // 3. Limpiamos la llave
        $apiKey = trim(env('GEMINI_API_KEY'));

        // 4. ¡Hacemos la petición al modelo exacto de tu cuenta (gemini-2.5-flash)!
        $response = Http::withoutVerifying()->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        // 5. Procesamos la respuesta exitosa
        if ($response->successful()) {
            $textoExtraido = $response->json('candidates.0.content.parts.0.text');
            // Limpiamos los asteriscos de markdown
            $textoLimpio = str_replace('*', '', $textoExtraido); 
            
            return response()->json(['inspiracion' => $textoLimpio]);
        }

        // 6. Si algo falla, devolvemos el error amigable
        return response()->json(['error' => 'La IA está descansando, intenta en un momento.'], 500);
    }
}