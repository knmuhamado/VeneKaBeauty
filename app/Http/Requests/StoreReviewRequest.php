<?php

// Mariamny Del Valle Ramírez Telles

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string',
            'score' => 'required|integer|between:0,5',
            'product_id' => 'nullable|integer|exists:products,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'product_id' => $this->filled('product_id') ? (int) $this->input('product_id') : null,
        ]);
    }

    public function reviewData(): array
    {
        $data = $this->validated();

        return [
            'comment' => $data['comment'],
            'score' => $data['score'],
            'product_id' => $data['product_id'] ?? null,
        ];
    }

    public function messages(): array
    {
        return [
            'score.required' => 'Debe ingresar un puntaje.',
            'score.integer' => 'El puntaje debe ser un número entero.',
            'score.between' => 'El puntaje debe estar entre 0 y 5.',
            'comment.required' => 'Debe ingresar un comentario.',
            'product_id.integer' => 'El producto seleccionado no es válido.',
            'product_id.exists' => 'El producto seleccionado no existe.',
        ];
    }
}
