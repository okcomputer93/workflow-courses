<?php

namespace App\Rules\User;


class BaseUserRules implements UserRules
{
    protected array $rules;

    /**
     * BaseUserRules constructor.
     * Base decorator for user rules.
     */
    public function __construct()
    {
        $this->rules = [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'avatar' => [
                'nullable',
                'image'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ]
        ];
    }

    /**
     * Return the base rules for a user.
     * @return array|string[][]
     */
    public function rules(): array
    {
        return $this->rules;
    }
}
