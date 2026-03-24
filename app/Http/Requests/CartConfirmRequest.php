<?php

// Kadiha Muhamad

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartConfirmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'method_of_payment' => ['required', 'in:card,cash,bank'],
        ];
    }
}
