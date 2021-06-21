<?php


namespace App\Rules;


use Illuminate\Validation\Rule;

class UserRulesUpdate implements UserRules
{
    protected UserRules $userRules;
    protected array $rules;
    protected array $modifier;

    public function __construct(UserRules $userRules)
    {
        $this->userRules = $userRules;

        $this->rules = [];

        $this->modifier = [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'id')
            ],
        ];
    }

    public function rules(): array
    {
        return array_replace($this->userRules->rules(), $this->rules, $this->modifier);
    }
}
