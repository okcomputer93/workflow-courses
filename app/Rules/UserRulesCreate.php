<?php


namespace App\Rules;


use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class UserRulesCreate implements UserRules
{
    protected UserRules $userRules;
    protected array $rules;
    protected array $modifier;

    public function __construct(UserRules $userRules)
    {
        $this->userRules = $userRules;

        $this->rules = [
            'password' =>  ['required', 'string', new Password, 'confirmed']
        ];

        $this->modifier = [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'avatar' => [
                'sometimes', 'required', 'image',
            ]
        ];
    }

    /**
     * Modify the user rules when creating a user.
     * @return array
     */
    public function rules(): array
    {
        return array_replace($this->userRules->rules(), $this->rules, $this->modifier);
    }
}
