<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\BaseRoleRules;
use App\Rules\BaseUserRules;
use App\Rules\ProfessorRules;
use App\Rules\RoleRulesCreate;
use App\Rules\StudentRules;
use App\Rules\UserRulesCreate;
use App\Validation\HasRoleCreation;
use App\Validation\UserValidation;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use HasRoleCreation;

    private UserValidation $userCreateValidation;
    private string $defaultAvatar = 'avatars/default-avatar.png';

    /**
     * CreateNewUser constructor.
     */
    public function __construct()
    {
        $userCreateRules = new UserRulesCreate(new BaseUserRules());
        $roleCreateRules = new RoleRulesCreate(new StudentRules(new ProfessorRules(new BaseRoleRules())));
        $this->userCreateValidation = new UserValidation($userCreateRules, $roleCreateRules);
    }

    /**
     * Validate and create a newly registered user.
     * @param array $input
     * @return User
     */
    public function create(array $input): User
    {
       $this->userCreateValidation->validateAll($input);

        $role = $this->createRole($this->userCreateValidation, $input);

        return $role->user()->create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'avatar' => $this->userAvatar($input)
        ]);
    }

    /**
     * Stores user avatar if exists of assign the default.
     * @param array $input
     * @return mixed|string
     */
    protected function userAvatar(array $input)
    {
        if (key_exists('avatar', $input)) {
            return $input['avatar']
                ->store('avatars', 'public');
        }
        return $this->defaultAvatar;
    }
}
