<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Rules\Role\BaseRoleRules;
use App\Rules\Role\ProfessorRules;
use App\Rules\Role\ProfessorUpgradeRules;
use App\Validation\HasRoleCreation;
use App\Validation\UserValidation;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    use HasRoleCreation;

    protected UserValidation $roleUpdateValidation;

    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $roleUpdateRules = (new ProfessorRules(new ProfessorUpgradeRules(new BaseRoleRules())));

        $this->roleUpdateValidation = new UserValidation(null, $roleUpdateRules);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
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

    /**
     * Return a view for the upgrade from student to professor.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Professor::class);
        return view('auth.register-professor');
    }
}
