<?php
// David Alejandro Gutiérrez Leal
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'required|image',
            'description' => 'required|string',
            'available' => 'required|boolean',
            'price' => 'required|numeric|gt:0',
            'brand' => 'nullable|string|max:255',
            'keyword' => 'nullable|array',
            'keyword.*' => 'string',
            'type' => 'required|in:article,service',
        ];
    }

    protected function prepareForValidation(): void
    {
        $keyword = $this->input('keyword');

        if (is_string($keyword)) {
            $keyword = array_values(array_filter(array_map('trim', explode(',', $keyword))));
        }

        $this->merge([
            'keyword' => is_array($keyword) ? $keyword : [],
            'available' => $this->boolean('available'),
        ]);
    }
}
