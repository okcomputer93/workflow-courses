<?php


namespace App\Validation;


trait HasRoleCreation
{
    private string $defaultRole = 'student';

    /**
     * Create a new model for a specific role.
     * @param UserValidation $userValidation
     * @param array $input
     * @return mixed
     */
    protected function createRole(UserValidation $userValidation, array $input)
    {
        $attributes = $userValidation->roleAttributes($input);
        $role = $attributes['role'] ?? $this->defaultRole;
        $className = ucwords($role);
        $classPath = "App\\Models\\$className";

        return $classPath::create($attributes);
    }
}
