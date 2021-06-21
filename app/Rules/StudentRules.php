<?php


namespace App\Rules;


class StudentRules implements RoleRules
{
    protected array $rules;
    protected RoleRules $roleRules;

    /**
     * ProfessorRules constructor.
     * @param RoleRules $roleRules
     */
    public function __construct(RoleRules $roleRules)
    {
        $this->roleRules = $roleRules;
        $this->rules = [
            'schooling' => ['sometimes', 'required', 'string', 'max:255']
        ];
    }


    /**
     * Add the student rules to the role rules stack.
     * @return array
     */
    public function rules(): array
    {
        return array_replace($this->roleRules->rules(), $this->rules);

    }
}

