<?php

return [
    'required' => ':attribute is required.',
    'email' => ':attribute must be a valid email address.',
    'unique' => ':attribute already exists.',
    'date' => ':attribute must be a valid date.',
    'numeric' => ':attribute must be a number.',
    'integer' => ':attribute must be an integer.',
    'min' => [
        'numeric' => ':attribute must be at least :min.',
        'string' => ':attribute must have at least :min characters.',
    ],
    'max' => [
        'numeric' => ':attribute may not be greater than :max.',
        'string' => ':attribute may not have more than :max characters.',
    ],
    'mimes' => ':attribute must be a file of type: :values.',
    'end_date' => ':attribute must be a date after the start date.',
];
