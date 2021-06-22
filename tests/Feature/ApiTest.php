<?php

namespace Tests\Feature;

use App\Models\Course;
use Facades\Tests\Setup\CourseFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_unauthenticated_user_cannot_do_requests()
    {
        $this->getAjax('/api/user/information')
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_do_requests()
    {
        $this->signIn();

        $this->getAjax('/api/user/information')
            ->assertStatus(200);
    }

    /** @test */
    public function an_authenticated_user_can_receive_its_information()
    {
        $user = $this->signIn();

        $this->getAjax('/api/user/information')
            ->assertExactJson([
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->name(),
                'avatar' => $user->avatar
            ]);
    }

    /** @test */
    public function anybody_can_request_last_uploaded_courses()
    {
        $this->getAjax('/api/courses/last')
            ->assertStatus(200);

        $this->signIn();

        $this->getAjax('/api/courses/last')
            ->assertStatus(200);
    }

    /** @test */
    public function request_for_last_courses_respond_with_information()
    {
        CourseFactory::withStorage('public')
            ->create();
        $courses = Course::latest()->take(3)
            ->with([
                'owner:id,name,email,avatar',
                'category:id,name',
                'level:id,name,scale'
            ])
            ->get();

        $this->getAjax('/api/courses/last')
            ->assertSimilarJson($courses->toArray());
    }
}
