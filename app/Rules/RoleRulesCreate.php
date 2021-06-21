<?php


namespace App\Rules;


use Illuminate\Validation\Rule;

class RoleRulesCreate implements RoleRules
{
    protected array $rules;
    protected RoleRules $roleRules;

    /**
     * RoleRulesCreate constructor.
     */
    public function __construct(RoleRules $roleRules)
    {

        $this->roleRules = $roleRules;

        $this->rules = [
            'role' => [
                'required',
                'string',
                Rule::in(['student', 'professor'])
            ]
        ];
    }


    /**
     * Modify the role rules when creating a role.
     * @return array
     */
    public function rules(): array
    {
        return array_replace($this->roleRules->rules(), $this->rules);
    }
}
