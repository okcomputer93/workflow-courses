<?php


namespace App\Rules\Role;


use Illuminate\Validation\Rule;

class RoleRulesUpdate implements RoleRules
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
                'sometimes',
                'required',
                'string',
                Rule::in(['professor', 'student'])
            ]
        ];
    }


    /**
     * Modify the role rules when updating a role.
     * @return array
     */
    public function rules(): array
    {
        return array_replace($this->roleRules->rules(), $this->rules);
    }
}
