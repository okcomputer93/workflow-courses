<?php

namespace Tests\Feature;

use App\Models\Comment;
use Facades\Tests\Setup\CourseFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageCommentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anybody_can_access_the_comments_of_a_course()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        Comment::factory()->create([
            'course_id' => $course->id
        ]);

        $this->get("/api/courses/$course->id/comments")
            ->assertSimilarJson($course->comments->load(
                ['author:id,name,email,avatar']
            )->toArray());
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

    /** @test */
    public function when_posting_a_comment_the_api_returns_this_comment()
    {
        $user = $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->addViewers($user)
            ->create();

        Comment::factory()->count(4)->create([
            'course_id' => $course->id
        ]);

        $attributes = [
            'content' => 'I have taken this course and I enjoy it!',
            'rate' => 5
        ];

        $this->travel(5)->hours();

        $this->post("/api/courses/$course->id/comments", $attributes)
            ->assertExactJson(
                Comment::with(['author:id,name,email,avatar'])
                    ->orderBy('updated_at', 'desc')
                    ->first()
                    ->toArray()
            );
    }


    /** @test */
    public function an_authenticated_user_can_not_post_a_comment_in_a_taken_course_already_commented()
    {
        $user = $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->addViewers($user)
            ->create();

        $attributes = [
            'content' => 'I have taken this course and I enjoy it!',
            'rate' => 5
        ];

        $this->post("/api/courses/$course->id/comments", $attributes);

        $secondAttributes = [
            'content' => 'This is my second comment on this course!',
            'rate' => 1
        ];

        $this->post("/api/courses/$course->id/comments", $secondAttributes)
            ->assertStatus(403);
    }

    /** @test */
    public function everytime_a_comment_is_posted_the_course_rate_is_updated()
    {
        $jhon = UserFactory::role('student')
            ->create();

        $sally = UserFactory::role('student')
            ->create();

        $viewers = collect([$jhon, $sally]);

        $course = CourseFactory::withStorage('public')
            ->addViewers($viewers)
            ->create();

        $jhonComment = [
            'content' => 'I have taken this course and I enjoy it!',
            'rate' => 5
        ];

        $sallyComment = [
            'content' => 'Didnt like at all.',
            'rate' => 1
        ];

        $this->actingAs($jhon)->post("/api/courses/$course->id/comments", $jhonComment);
        $this->actingAs($sally)->post("/api/courses/$course->id/comments", $sallyComment);

        $average =  $course->refresh()->comments()->pluck('rate')->avg();

        $this->assertEquals(
            $average,
            $course->rate
        );
    }
}
