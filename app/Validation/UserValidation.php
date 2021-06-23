<?php


namespace App\Validation;

use App\Rules\Role\RoleRules;
use App\Rules\User\UserRules;
use Illuminate\Support\Facades\Validator;

class UserValidation implements Validation
{

    private UserRules $userRules;
    private RoleRules $roleRules;

    /**
     * UserValidation constructor.
     * Assign the proper role and user rules if these are set.
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

    /**
     * Validate all fields on the given input.
     * @param array $input
     */
    public function validate(array $input)
    {
        $this->validateUser($input);

        $this->validateRole($input);
    }

    /**
     * Validate only user related fields on input.
     * @param array $input
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateUser(array $input)
    {
        Validator::make(
            $input,
            $this->userRules->rules()
        )->validate();
    }

    /**
     * Validate role related fields on input.
     * @param array $input
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateRole(array $input)
    {
        Validator::make(
            $input,
            $this->roleRules->rules()
        )->validate();
    }

    /**
     * Return only the valid attributes on an input given the user rules.
     * @param array $input
     * @return array
     */
    public function userAttributes(array $input): array
    {
        return array_intersect_key(
            $input,
            $this->userRules->rules()
        );
    }

    /**
     * Return only the valid attributes on an input given the role rules.
     * @param array $input
     * @return array
     */
    public function roleAttributes(array $input): array
    {
        return array_intersect_key(
            $input,
            $this->roleRules->rules()
        );
    }
}
