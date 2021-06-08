<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Validation\UserValidateInput;
use App\Validation\UserValidation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    protected UserValidateInput $userValidation;

    public function __construct()
    {
        $this->userValidation = new UserValidation('update');
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
        $this->userValidation
            ->validateInput($input, $user);

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
        $attributes = $this->userValidation
            ->getAttributesBasedOnRole($input, $user);

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
