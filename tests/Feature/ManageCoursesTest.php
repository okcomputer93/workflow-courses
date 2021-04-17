<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageCoursesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_course_can_be_created()
    {
        $this->withoutExceptionHandling();

        $professor = $this->signIn($role = 'professor');

        $course = Course::factory()->raw([
            'professor_id' => $professor->id
        ]);

        $this->post('/courses', $course)
            ->assertRedirect('/courses');

        $this->assertDatabaseHas('courses', $course);
    }

    /** @test */
    public function a_course_requires_a_title()
    {
        $this->signIn($role = 'professor');

        $attributes = Course::factory()->raw([
            'title' => ''
        ]);

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_course_requires_a_description()
    {
        $this->signIn($role = 'professor');

        $attributes = Course::factory()->raw([
            'description' => ''
        ]);

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function a_course_requires_a_valid_rate_or_default()
    {
        $this->signIn($role = 'professor');

        $course = Course::factory()->raw([
            'rate' => ''
        ]);

        $this->post('/courses', $course)
            ->assertSessionHasNoErrors();

        $course['rate'] = 6;
        $this->post('/courses', $course)
            ->assertSessionHasErrors(['rate']);

        $course['rate'] = 5;
        $this->post('/courses', $course)
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function anybody_can_view_a_course()
    {
        $this->withoutExceptionHandling();
        $course = Course::factory()->create();

        $this->get($course->path())
            ->assertSee($course->title)
            ->assertSee($course->description)
            ->assertSee($course->rate);
    }

    /** @test */
    public function users_or_visitors_cannot_create_courses()
    {
        $course = Course::factory()->raw();

        $this->post('/courses', $course)
            ->assertRedirect('login');

        $this->signIn($role = 'student');

        $this->post('/courses', $course)
            ->assertStatus(403);
    }

}
