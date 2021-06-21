<?php


namespace App\Validation;


trait HasRoleCreation
{
    /**
     * Create a new model for a specific role.
     * @param UserValidation $userValidation
     * @param array $input
     * @return mixed
     */
    protected function createRole(UserValidation $userValidation, array $input)
    {
        $attributes = $userValidation->roleAttributes($input);
        $className = ucwords($attributes['role']);
        $classPath = "App\\Models\\$className";

        return $classPath::create($attributes);
    }
}
