<?php


namespace App\Rules;


class ProfessorRules implements RoleRules
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

        $this->rules  = [
            'career' => ['sometimes', 'required', 'string', 'max:255'],
            'about' => ['sometimes', 'required', 'string'],
            'github_user' => ['sometimes', 'required', 'string', 'max:255'],
            'twitter_user' => ['sometimes', 'required', 'string', 'max:255'],
        ];
    }


    /**
     * Add the professor rules to the role rules stack.
     * @return array
     */
    public function rules(): array
    {
        return array_replace($this->roleRules->rules(), $this->rules);
    }
}
