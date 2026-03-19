<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'query' => 'nullable|string|max:255',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'nullable|integer|exists:categories,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        if (empty($this->query) && empty($this->category_ids)) {
            $this->merge(['query' => '']);
        }
    }
}
