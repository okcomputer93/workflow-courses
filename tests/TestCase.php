<?php

namespace Tests;

use App\Models\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(?String $role = 'student', User $baseUser = null)
    {
        $user = $baseUser ??  UserFactory::role($role)
            ->create();

        $this->actingAs(
            $user
        );
        return $user;
    }
}
