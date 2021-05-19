<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    protected $userRules = [];
    protected $professorRules = [];
    protected $studentRules = [];
    protected $roleRules = [];
    protected $defaultAvatar = 'avatars/default-avatar.png';
    protected $defaultRole = 'student';
    protected $role;

    /**
     * CreateNewUser constructor.
     */
    public function __construct()
    {
        $this->userRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'avatar' => ['sometimes', 'required', 'image'],
        ];

        $this->professorRules = [
            'career' => ['required', 'string', 'max:255'],
            'about' => ['sometimes', 'required', 'string'],
            'github_user' => ['required', 'string', 'max:255'],
            'twitter_user' => ['required', 'string', 'max:255'],
        ];

        $this->studentRules = [
            'schooling' => ['sometimes', 'required', 'string', 'max:255']
        ];

        $this->roleRules = [
            'role' => [
                'sometimes',
                'required',
                'string',
                Rule::in(['student', 'professor']),
            ]
        ];
    }

    /**
     * Validate and create a newly registered user.
     * @param array $input
     * @return User
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        $this->validateRole($input);

        $this->validateInput($input);

        $role = $this->createRole($input);

        return $role->user()->create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'avatar' => $this->userAvatar($input)
        ]);
    }

    /**
     * Validate the input type for role field or assign a default.
     * @param array $input
     * @throws ValidationException
     */
    protected function validateRole(array $input)
    {
        Validator::make(
            $input,
            $this->roleRules
        )->validate();
        $this->role = $input['role'] ?? $this->defaultRole;
    }

    /**
     * Validate whole body on input.
     * @param array $input
     * @throws ValidationException
     */
    protected function validateInput(array $input)
    {
        $rules = array_merge(
            $this->userRules,
            $this->specificRules()
        );
        Validator::make($input, $rules)->validate();
    }

    /**
     * Return the specific rules for the role for the input.
     * @return array
     */
    protected function specificRules(): array
    {
        return $this->role === 'professor'
            ? $this->professorRules
            : $this->studentRules;
    }

    /**
     * Create a new model in DB for specific role.
     * @param array $input
     * @return mixed
     */
    protected function createRole(array $input)
    {
        $className = ucwords($this->role);
        $classPath = "App\\Models\\$className";
        $attributes = array_intersect_key(
            $input,
            $this->specificRules()
        );
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
