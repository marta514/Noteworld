<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEntradaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }
/**
     * Obtiene las reglas de validación que se aplicarán a la petición.
     */
    public function rules(): array
    {
        return [
            // Debe pertenecer a un mundo que exista en tu base de datos
            'mundo_id' => 'required|exists:mundos,id',
            
            // Título de la historia o documento
            'titulo' => 'required|string|max:255',
            
            // Categoría (ej. Religión, Geografía, Magia)
            'categoria' => 'required|string|max:100',
            
            // El lore completo
            'contenido' => 'required|string',
        ];
    }

    /**
     * Personaliza los mensajes de error para una mejor UI/UX.
     */
    public function messages(): array
    {
        return [
            'mundo_id.required' => 'Debes especificar a qué mundo pertenece esta entrada.',
            'mundo_id.exists' => 'El mundo seleccionado no es válido.',
            'titulo.required' => 'La entrada necesita un título (ej. "La Guerra de los Cien Años").',
            'titulo.max' => 'El título es demasiado largo, máximo 255 caracteres.',
            'categoria.required' => 'Por favor, clasifica tu entrada con una categoría (ej. Geografía, Historia).',
            'categoria.max' => 'El nombre de la categoría es demasiado largo.',
            'contenido.required' => 'No puedes crear una entrada vacía. ¡Escribe un poco de historia!',
        ];
    }
}
