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

    /**
     * Fake XMLHttpRequest for post requests.
     * @param string $url
     * @param array $data
     * @return \Illuminate\Testing\TestResponse
     */
    public function postAjax(string $url, array $data): \Illuminate\Testing\TestResponse
    {
        return $this->post($url, $data, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
    }

    /**
     * Fake XMLHttpRequest for get requests.
     * @param string $url
     * @return \Illuminate\Testing\TestResponse
     */
    public function getAjax(string $url): \Illuminate\Testing\TestResponse
    {
        return $this->get($url, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
    }
}
