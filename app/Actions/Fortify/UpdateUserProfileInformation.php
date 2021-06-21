<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\BaseRoleRules;
use App\Rules\BaseUserRules;
use App\Rules\ProfessorRules;
use App\Rules\RoleRulesUpdate;
use App\Rules\StudentRules;
use App\Rules\UserRulesUpdate;
use App\Validation\UserValidation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    private UserValidation $userUpdateValidation;

    public function __construct()
    {
        $userUpdateRules = new UserRulesUpdate(new BaseUserRules());
        $roleUpdateRules = new ProfessorRules(new StudentRules(new RoleRulesUpdate(new BaseRoleRules())));
        $this->userUpdateValidation = new UserValidation($userUpdateRules, $roleUpdateRules);
    }

    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($user, array $input)
    {
        $this->userUpdateValidation
            ->validateAll($input);

        $this->updateAvatarIfExists($input, $user);

        $this->updateRoleInformation($input, $user);

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($input, $user);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser(array $input, User $user)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    protected function updateRoleInformation(array $input, $user)
    {
        $attributes = $this->userUpdateValidation
            ->roleAttributes($input);

        $user->role()->update($attributes);
    }

    protected function updateAvatarIfExists(array $input, User $user)
    {
        if ($input['avatar']) {
            $path = $input['avatar']->store('avatars', 'public');

            $user->forceFill([
                'avatar' => $path
            ])->save();
        }
    }
}
