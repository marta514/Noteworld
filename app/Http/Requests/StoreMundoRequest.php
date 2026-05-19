<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMundoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        // Retornamos 'true' porque la protección general 
        // ya la está haciendo tu middleware de 'auth'
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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ];
    }

    /**
     * (Opcional) Personaliza los mensajes de error para que sean amigables.
     */
    public function messages(): array
    {
        return [
            'titulo.required' => 'Todo mundo necesita un nombre. Por favor, escribe un título.',
            'titulo.max' => 'El título es demasiado largo, el máximo son 255 caracteres.',
            'descripcion.required' => 'Agrega una breve descripción para darle vida a este mundo.',
        ];
    }
}