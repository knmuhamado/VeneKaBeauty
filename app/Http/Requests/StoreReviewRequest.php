<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    // Determina si el usuario está autorizado para hacer el request
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string',
            'score' => 'required|integer|between:0,5',
        ];
    }

    public function messages(): array
    {
        return [
            'score.required' => 'Debe ingresar un puntaje.',
            'score.integer' => 'El puntaje debe ser un número entero.',
            'score.between' => 'El puntaje debe estar entre 0 y 5.',
            'comment.required' => 'Debe ingresar un comentario.',
        ];
    }
}
