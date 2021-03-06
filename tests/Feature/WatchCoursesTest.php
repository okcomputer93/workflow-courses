<?php

namespace Tests\Feature;

use Facades\Tests\Setup\CourseFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class WatchCoursesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function unauthenticated_users_cannot_request_for_view_courses()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        $this->post(route('courses.save', $course))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthenticated_users_cannot_watch_courses()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        $this->get($course->watchPath())
            ->assertRedirect(route('login'));
    }


    /** @test */
    public function an_authenticated_user_can_request_watch_a_course()
    {
        $user = $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->create();

        $this->post(route('courses.save', $course))
            ->assertRedirect($course->watchPath());

        $this->assertTrue($user->refresh()->views->contains($course));
    }

    /** @test */
    public function an_authenticated_user_cannot_watch_a_course_if_it_is_not_on_its_views()
    {
        $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->create();

        $this->get($course->watchPath())
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_watch_a_course_from_its_views()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->addViewers($user)
            ->create();

        $this->get($course->watchPath())
            ->assertSee($course->title);
    }

    /** @test */
    public function an_authenticated_user_has_the_option_of_taking_a_course()
    {
        $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->create();

        $this->get($course->path())
            ->assertSee('Tomar este curso');
    }

    /** @test */
    public function an_authenticated_user_has_the_option_of_continue_with_a_taken_course()
    {
        $user = $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->addViewers($user)
            ->create();

        $this->get($course->path())
            ->assertSee('Continuar curso');
    }

    /** @test */
    public function an_authenticated_user_can_add_a_course_as_view_only_once()
    {
        $user = $this->signIn();

        $course = CourseFactory::withStorage('public')
            ->create();

        $this->post(route('courses.save', $course));

        $this->post(route('courses.save', $course));

        $this->assertEquals(
            1,
            $user->refresh()
                ->views
                ->count()
        );
    }
}
