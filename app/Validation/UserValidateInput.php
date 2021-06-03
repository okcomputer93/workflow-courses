<?php


namespace App\Validation;


use App\Models\User;

interface UserValidateInput
{
    public function validateRoleExists(array $input);

    public function getRole(array $input, User $user);

    public function getAttributesBasedOnRole(array $input, User $user);

    public function validateInput(array $input, User $user);
}
