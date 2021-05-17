<?php

namespace Tests\Setup;

class RoleFactory
{
    /**
     * Creates a role.
     * @param String $role
     * @return mixed
     */
    public static function create(String $role)
    {
        $className = ucwords($role);
        $classPath = "App\\Models\\$className";
        return $classPath::factory()->create();
    }

    /**
     * Generates fake data based on a role.
     * @param String $role
     * @return mixed
     */
    public static function raw(String $role)
    {
        $className = ucwords($role);
        $classPath = "App\\Models\\$className";
        return $classPath::factory()->raw();
    }
}
