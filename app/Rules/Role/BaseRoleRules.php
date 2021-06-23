<?php


namespace App\Rules\Role;


class BaseRoleRules implements RoleRules
{
    protected array $rules;

    /**
     * BaseRoleRules constructor.
     * First decorator for a list of role rules.
     */
    public function __construct()
    {
        $this->rules = [];
    }

    /**
     * Return the base rules for roles.
     * @return array
     */
    public function rules(): array
    {
        return $this->rules;
    }
}
