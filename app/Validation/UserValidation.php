<?php


namespace App\Validation;


use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use ReflectionClass;

class UserValidation implements UserValidateInput
{
    use PasswordValidationRules;

    private string $action;
    private array $input;
    private User $user;
    private array $userRules;

    private array $professorRules;
    private array $studentRules;
    private array $roleRules;
    private string $defaultRole = 'student';

    /**
     * UserValidation constructor.
     */
    public function __construct(string $action)
    {
        $this->action = $action;

        $this->roleRules = [
            'role' => [
                'required',
                'string',
                Rule::in(['student', 'professor']),
            ]
        ];

        $this->userRules = $this->createUserRulesWithAction();

        $this->professorRules = [
            'career' => ['required', 'string', 'max:255'],
            'about' => ['sometimes', 'required', 'string'],
            'github_user' => ['required', 'string', 'max:255'],
            'twitter_user' => ['required', 'string', 'max:255'],
        ];

        $this->studentRules = [
            'schooling' => ['sometimes', 'required', 'string', 'max:255']
        ];
    }

    /**
     * Validate that the role
     * @param array $input
     * @throws ValidationException
     */
    public function validateRoleExists(array $input)
    {
        Validator::make(
            $input,
            $this->roleRules
        )->validate();
    }

    public function getRole(array $input, ?User $user = null)
    {
        if ($user) {
            return Str::lower((new ReflectionClass($user->role))->getShortName());
        }
        return $input['role'] ?? $this->defaultRole;
    }

    public function getAttributesBasedOnRole(array $input, ?User $user = null): array
    {
        return array_intersect_key(
            $input,
            $this->specificRules($input, $user)
        );
    }

    /**
     * @throws ValidationException
     */
    public function validateInput(array $input, ?User $user = null)
    {
        $rules = array_merge(
            $this->userRules,
            $this->specificRules($input, $user)
        );
        Validator::make($input, $rules)->validate();
    }

    /**
     */
    private function specificRules(array $input, ?User $user = null): array
    {
        $role = $this->getRole($input, $user);

        $rules = $role . 'Rules';

        return $this->$rules;
    }

    private function createUserRulesWithAction(): array
    {
        $baseRules = [
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['sometimes', 'required', 'image'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')
            ]
        ];

        if ($this->action === 'create') {
            $baseRules +=
                [
                    'password' => $this->passwordRules(),
                    'avatar' => ['sometimes', 'required', 'image'],
                ];
        }

        return $baseRules;
    }
}
