<?php

namespace App\Http\Controllers;

use App\Rules\BaseRoleRules;
use App\Rules\ProfessorRules;
use App\Rules\ProfessorUpgradeRules;
use App\Validation\UserValidation;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected UserValidation $roleUpdateValidation;

    public function __construct()
    {
        $roleUpdateRules = (new ProfessorRules(new ProfessorUpgradeRules(new BaseRoleRules())));

        $this->roleUpdateValidation = new UserValidation(null, $roleUpdateRules);
    }

    /**
     * Upgrade user role.
     * @param Request $request
     */
    public function update(Request $request)
    {
        $input = $request->all();

        $this->roleUpdateValidation
            ->validateRole($input);

        $role = $this->createRole($input);

        $role->user()->save($request->user());
    }

    /**
     * Create a new model for a specific role.
     * @param array $input
     * @return mixed
     */
    protected function createRole(array $input)
    {
        $attributes = $this->roleUpdateValidation
            ->roleAttributes($input);

        $className = ucwords($attributes['role']);
        $classPath = "App\\Models\\$className";

        return $classPath::create($attributes);
    }
}
