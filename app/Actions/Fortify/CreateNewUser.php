<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Validation\UserValidateInput;
use App\Validation\UserValidation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    private UserValidateInput $userValidation;
    private string $defaultAvatar = 'avatars/default-avatar.png';

    /**
     * CreateNewUser constructor.
     */
    public function __construct()
    {
        $this->userValidation = new UserValidation('create');
    }

    /**
     * Validate and create a newly registered user.
     * @param array $input
     * @return User
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        $this->userValidation
            ->validateRole($input);

        $this->userValidation
            ->validateInput($input);

        $role = $this->createRole($input);

        return $role->user()->create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'avatar' => $this->userAvatar($input)
        ]);
    }

    /**
     * Create a new model in DB for specific role.
     * @param array $input
     * @return mixed
     */
    protected function createRole(array $input)
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

    /**
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
