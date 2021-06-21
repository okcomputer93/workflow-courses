<?php

namespace App\Rules;


class BaseUserRules implements UserRules
{
    protected array $rules;

    public function __construct()
    {
        $this->rules = [
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ]
        ];
    }

    public function rules(): array
    {
        return $this->rules;
    }
}
