<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Rules\BaseRoleRules;
use App\Rules\ProfessorRules;
use App\Rules\ProfessorUpgradeRules;
use App\Validation\HasRoleCreation;
use App\Validation\UserValidation;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    use HasRoleCreation;

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
        $this->authorize('update', Professor::class);

        $input = $request->all();

        $this->roleUpdateValidation
            ->validateRole($input);

        $role = $this->createRole($this->roleUpdateValidation, $input);

        $role->user()->save($request->user());

        return redirect(route('profile.show'));
    }

    public function create()
    {
        $this->authorize('create', Professor::class);
        return view('auth.register-professor');
    }
}
