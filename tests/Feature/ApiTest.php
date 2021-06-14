<?php

namespace Tests\Feature;

use App\Models\Comment;
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
        CourseFactory::withStorage('public')
            ->create();
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

    /** @test */
    public function anybody_can_access_the_comments_of_a_post()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        Comment::factory()->create([
            'course_id' => $course->id
        ]);

        $this->get("/api/courses/$course->id/comments")
            ->assertSimilarJson($course->comments->toArray());
    }

    /** @test */
    public function unauthenticated_users_cannot_post_a_comment_in_a_course()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        $this->post("/api/courses/$course->id/comments")
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_cannot_post_a_comment_in_not_taken_course()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        $this->signIn();

        $attributes = [
            'content' => 'I had not seen this but Im commenting!',
            'rate' => 1
        ];

        $this->post("/api/courses/$course->id/comments", $attributes)
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_post_a_comment_in_a_taken_course()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->addViewers($user)
            ->create();

        $attributes = [
            'content' => 'I have taken this course and I enjoy it!',
            'rate' => 5
        ];

        $this->post("/api/courses/$course->id/comments", $attributes)
            ->assertStatus(200);

        $this->assertDatabaseHas('comments', $attributes);
    }

}
