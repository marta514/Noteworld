<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonajeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        // Retornamos true porque la protección de rutas ya la hace el middleware 'auth'
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplicarán a la petición.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // El personaje DEBE pertenecer a un mundo que exista en la base de datos
            'mundo_id' => 'required|exists:mundos,id',
            
            // El nombre es obligatorio y tiene un límite de caracteres
            'nombre' => 'required|string|max:255',
            
            // Los demás campos de la ficha son opcionales (nullable), 
            // pero si se llenan, deben ser texto.
            'biografia' => 'nullable|string',
            'edad' => 'nullable|string|max:100', // String para permitir "Desconocida"
            'genero' => 'nullable|string|max:100',
            'especie' => 'nullable|string|max:100',
            'apariencia_fisica' => 'nullable|string',
            'personalidad' => 'nullable|string',
        ];
    }

    /**
     * Personaliza los mensajes de error para una mejor UI/UX.
     */
    public function messages(): array
    {
        return [
            'mundo_id.required' => 'Debes seleccionar a qué mundo pertenece este personaje.',
            'mundo_id.exists' => 'El mundo seleccionado no es válido.',
            'nombre.required' => 'Todo personaje necesita un nombre para existir.',
            'nombre.max' => 'El nombre es demasiado largo, no debe exceder los 255 caracteres.',
            'edad.max' => 'El texto de la edad es muy largo.',
        ];
    }
}