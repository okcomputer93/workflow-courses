<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Facades\Tests\Setup\CourseFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManageCoursesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_course_can_be_created()
    {
        $professor = $this->signIn($role = 'professor');

        $category = Category::factory()->create();

        $level = Level::factory()->create();

        $this->get(route('courses.create'))
            ->assertStatus(200)
            ->assertSee(ucwords($category->name))
            ->assertSee(ucwords($level->name));

        $course = CourseFactory::withStorage('public')
            ->ownedBy($professor)
            ->raw();

        $this->post('/courses', $course)
            ->assertRedirect('/courses');
    }

    /** @test */
    public function a_course_can_be_updated()
    {
        $professor = $this->signIn($role = 'professor');

        $firstCategory = Category::factory()->create();
        $secondCategory = Category::factory()->create();

        $firstLevel = Level::factory()->create();
        $secondLevel = Level::factory()->create();

        $course = CourseFactory::withStorage('public')
            ->ownedBy($professor)
            ->category($firstCategory)
            ->level($firstLevel)
            ->create();

//        dd($course->path());

        $this->get($course->path('edit'))
            ->assertStatus(200)
            ->assertSee($course->title)
            ->assertSeeInOrder([
                ucwords($firstCategory->name),
                ucwords($secondCategory->name)
            ], false)
            ->assertSeeInOrder([
                ucwords($firstLevel->name),
                ucwords($secondLevel->name)
            ], false);
    }

    /** @test */
    public function only_the_owner_of_a_course_can_handle_it()
    {
        $this->signIn($role = 'professor');

        $course = CourseFactory::withStorage('public')
            ->create();

        $this->get($course->path('edit'))
            ->assertStatus(403);
    }

    /** @test */
    public function a_course_can_be_handled_by_its_owner()
    {
        $professor = $this->signIn($role = 'professor');

        $jhon = UserFactory::role('professor')
            ->create();

        $sally = UserFactory::role('professor')
            ->create();


        $course = CourseFactory::withStorage('public')
            ->ownedBy($professor)
            ->create();

        $this->get($course->path())
            ->assertSee($button = 'Actualizar Información');

        $this->actingAs($jhon)
            ->get($course->path())
            ->assertDontSee($button);

        $this->actingAs($sally)
            ->get($course->path())
            ->assertDontSee($button);

    }

    /** @test */
    public function an_owner_can_update_its_course()
    {
        $professor = $this->signIn($role = 'professor');

        Storage::fake('public');

        $course = CourseFactory::ownedBy($professor)
            ->create();

        $attributes = CourseFactory::ownedBy($professor)
            ->raw();

        $this->patch($course->path('update'), $attributes)
            ->assertRedirect($course->refresh()->path());

        Storage::disk('public')->assertExists(
            '/miniatures/' . $attributes['miniature']->hashName()
        );

        unset($attributes['miniature']);

        $this->assertDatabaseHas('courses', $attributes);
    }

    /** @test */
    public function an_image_is_not_required_when_updating_a_course()
    {
        $this->withoutExceptionHandling();

        $professor = $this->signIn($role = 'professor');

        $course = CourseFactory::withStorage('public')
            ->ownedBy($professor)
            ->create();

        $attributes = CourseFactory::ownedBy($professor)
            ->raw();

        unset($attributes['miniature']);

        $this->patch($course->path('update'), $attributes)
            ->assertRedirect($course->refresh()->path());

        $this->assertDatabaseHas('courses', $attributes);
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
    public function a_course_requires_a_level()
    {
        $this->signIn($role = 'professor');

        $attributes = CourseFactory::withStorage('public')
            ->raw();

        $this->post('/courses', $attributes)
            ->assertRedirect('/courses');

        $attributes['level_id'] = '';

        $this->post('/courses', $attributes)
            ->assertSessionHasErrors('level_id');
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

        $courses = Course::factory()->count(3)
            ->create();

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
