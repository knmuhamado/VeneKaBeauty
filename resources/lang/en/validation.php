<?php

return [
    'attributes' => [
        'name'                  => 'name',
        'email'                 => 'email',
        'password'              => 'password',
        'password_confirmation' => 'password confirmation',
        'address'               => 'address',
        'phoneNumber'           => 'phone',
    ],

    'required'   => 'The :attribute field is required.',
    'email'      => 'The :attribute must be a valid email.',
    'min'        => 'The :attribute must be at least :min characters.',
    'max'        => 'The :attribute may not be greater than :max characters.',
    'confirmed'  => 'The :attribute confirmation does not match.',
    'unique'     => 'The :attribute has already been registered.',
    'regex'      => 'The :attribute format is invalid.',
];