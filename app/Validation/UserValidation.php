<?php


namespace App\Validation;

use App\Rules\RoleRules;
use App\Rules\UserRules;
use Illuminate\Support\Facades\Validator;

class UserValidation
{

    private UserRules $userRules;
    private RoleRules $roleRules;

    /**
     * UserValidation constructor.
     */
    public function __construct(?UserRules $userRules, ?RoleRules $roleRules)
    {

        if (isset($userRules)) {
            $this->userRules = $userRules;
        }

        if (isset($roleRules)) {
            $this->roleRules = $roleRules;
        }
    }

    public function validateAll(array $input)
    {
        $this->validateUser($input);

        $this->validateRole($input);
    }

    public function validateUser(array $input)
    {
        Validator::make(
            $input,
            $this->userRules->rules()
        )->validate();
    }

    public function validateRole(array $input)
    {
        Validator::make(
            $input,
            $this->roleRules->rules()
        )->validate();
    }

    public function userAttributes(array $input)
    {
        return array_intersect_key(
            $input,
            $this->userRules->rules()
        );
    }

    public function roleAttributes(array $input)
    {
        return array_intersect_key(
            $input,
            $this->roleRules->rules()
        );
    }
}
