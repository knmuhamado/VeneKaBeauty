<?php

return [
    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de contraseña',
        'address' => 'dirección',
        'phoneNumber' => 'teléfono',
    ],

    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser un correo válido.',
    'min' => 'El campo :attribute debe tener al menos :min caracteres.',
    'max' => 'El campo :attribute no puede exceder :max caracteres.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'unique' => 'El :attribute ya está registrado.',
    'regex' => 'El formato de :attribute es inválido.',
];
