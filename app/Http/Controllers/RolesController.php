<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Validation\UserValidateInput;
use App\Validation\UserValidation;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected UserValidateInput $userValidation;

    public function __construct()
    {
        $this->userValidation = new UserValidation('update-role');
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $user = $request->user();

        $this->userValidation
            ->validateRole($input, $user);

        $this->userValidation
            ->validateInput($input, $user);

        $role = $this->createRole($input, $user);

        $role->user()->save($request->user());
    }

    /**
     * Create a new model in DB for specific role.
     * @param array $input
     * @return mixed
     */
    protected function createRole(array $input, User $user)
    {
        $className = ucwords(
            $this->userValidation
                ->getRole($input)
        );
        $classPath = "App\\Models\\$className";

        $attributes = $this->userValidation
            ->getAttributesBasedOnRole($input);

        return $classPath::create($attributes);
    }
}
