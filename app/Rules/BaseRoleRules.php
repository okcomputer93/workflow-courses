<?php


namespace App\Rules;


class BaseRoleRules implements RoleRules
{
    protected array $rules;

    /**
     * BaseRoleRules constructor.
     */
    public function __construct()
    {
        $this->rules = [];

    }


    public function rules(): array
    {
        return $this->rules;
    }
}
