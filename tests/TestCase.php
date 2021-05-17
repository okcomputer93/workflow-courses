<?php

namespace Tests;

use App\Models\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(String $role = 'student', User $user = null)
    {
        $user = UserFactory::role($role)
            ->baseOn($user)
            ->create();

//        $user = $user ?? User::factory()->create([
//                'role' => $role
//            ]);

        $this->actingAs(
            $user
        );
        return $user;
    }
}
