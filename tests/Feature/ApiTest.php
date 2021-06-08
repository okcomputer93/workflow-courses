<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_unauthenticated_user_cannot_do_requests()
    {
        $this->get('/api/user/information')
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_do_requests()
    {
        $this->signIn();

        $this->get('/api/user/information')
            ->assertStatus(200);
    }

    /** @test */
    public function an_authenticated_user_can_receive_its_information()
    {
        $user = $this->signIn();

        $this->get('/api/user/information')
            ->assertSimilarJson([
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->name(),
                'avatar' => $user->avatar
            ]);
    }

    /** @test */
    public function anybody_can_request_last_uploaded_courses()
    {
        $this->get('/api/courses/last')
            ->assertStatus(200);

        $this->signIn();

        $this->get('/api/courses/last')
            ->assertStatus(200);
    }

    /** @test */
    public function request_for_last_courses_respond_with_information()
    {
        Course::factory()->count(10)->create();

        $courses = Course::latest()->take(3)
            ->with([
                'owner:id,name,email,avatar',
                'category:id,name',
                'level:id,name,scale'
            ])
            ->get();

        $this->get('/api/courses/last')
            ->assertSimilarJson($courses->toArray());
    }

}