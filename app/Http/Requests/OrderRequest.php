<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    // Function to authorize the request, in this case it returns true to allow all requests
    public function authorize(): bool
    {
        return true;
    }

    // Function to return the validation rules for the request, in this case it returns an array with the rules for each field of the order
    public function rules(): array
    {
        return [
            'total' => ['required', 'integer', 'min:1'],
            'date' => ['required', 'date'],
            'paid' => ['required', 'boolean'],
            'shipped' => ['required', 'string', 'max:255'],
            'methodOfPayment' => ['required', 'in:card,cash,bank'],
        ];
    }
}
