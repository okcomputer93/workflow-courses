<?php

namespace Tests\Feature;

use App\Models\Course;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Facades\Tests\Setup\CourseFactory;

class ManageCoursesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_course_can_be_created()
    {
        $professor = $this->signIn($role = 'professor');

        $this->get(route('courses.create'))
            ->assertStatus(200);

        $course = CourseFactory::withStorage('public')->ownedBy($professor)->raw();

        $this->post('/courses', $course)
            ->assertRedirect('/courses');
    }

    /** @test */
    public function a_course_requires_a_title()
    {
        $this->signIn($role = 'professor');

        $attributes = Course::factory()->raw([
            'title' => ''
        ]);

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_course_requires_a_video_url()
    {
        $this->signIn($role = 'professor');

        $attributes = Course::factory()->raw([
            'video_url' => ''
        ]);

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors('video_url');
    }

    /** @test */
    public function a_course_requires_a_description()
    {
        $this->signIn($role = 'professor');

        $attributes = Course::factory()->raw([
            'description' => ''
        ]);

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_course_requires_a_miniature()
    {
        $this->signIn($role = 'professor');

        $attributes = CourseFactory::withStorage('public')->raw();

        $this->post('/courses', $attributes)
            ->assertSessionHasNoErrors();

        Storage::disk('public')->assertExists('/miniatures/' . $attributes['miniature']->hashName());

        $attributes['miniature'] = '';

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors('miniature');
    }

    /** @test */
    public function a_course_requires_a_category()
    {
        $this->signIn($role = 'professor');

        $attributes = CourseFactory::withStorage('public')->raw();

        $this->post('/courses', $attributes)
            ->assertRedirect('/courses');

        $attributes['category_id'] = '';

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors('category_id');
    }


    /** @test */
    public function a_course_requires_a_valid_rate_or_default()
    {
        $professor = $this->signIn($role = 'professor');

        $course = CourseFactory::withStorage('public')->ownedBy($professor)->raw();

        $this->post('/courses', $course)
            ->assertSessionHasNoErrors();

        $course['rate'] = 6;
        $this->post('/courses', $course)
            ->assertSessionHasErrors('rate');

        $course['rate'] = 5;
        $this->post('/courses', $course)
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function anybody_can_view_all_the_courses()
    {
        $this->withoutExceptionHandling();

        $courses = Course::factory()->count(3)->create();

        $titles = $courses->pluck('title');

        $this->get(route('courses.index'))
            ->assertSee($titles->toArray());
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
    public function students_or_visitors_cannot_manage_courses()
    {
        $course = Course::factory()->raw();

        $this->get(route('courses.create'))
            ->assertRedirect('login');

        $this->post('/courses', $course)
            ->assertRedirect('login');

        $this->signIn($role = 'student');

        $this->get(route('courses.create'))
            ->assertStatus(403);

        $this->post('/courses', $course)
            ->assertStatus(403);
    }

}
