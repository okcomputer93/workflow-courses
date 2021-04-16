<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CoursesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_course_can_be_created()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'rate' => $this->faker->numberBetween(0, 5)
        ];

        $this->actingAs(User::factory()->create([
            'role' => 'professor'
        ]))->post('/courses', $attributes)->assertRedirect('/courses');
        $this->assertDatabaseHas('courses', $attributes);
    }

    /** @test */
    public function a_course_requires_a_title()
    {
        $attributes = Course::factory()->raw([
            'title' => ''
        ]);

        $this->actingAs(User::factory()->create([
            'role' => 'professor'
        ]))->post('/courses', $attributes)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_course_requires_a_description()
    {
        $attributes = Course::factory()->raw([
            'description' => ''
        ]);

        $this->actingAs(User::factory()->create([
            'role' => 'professor'
        ]))->post('/courses', $attributes)->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function a_course_requires_a_valid_rate_or_default()
    {
        $attributes = Course::factory()->raw([
            'rate' => ''
        ]);

        $user =  User::factory()->create([
                    'role' => 'professor'
                ]);

        $this->actingAs($user)->post('/courses', $attributes)->assertSessionHasNoErrors();

        $attributes['rate'] = 6;
        $this->actingAs($user)->post('/courses', $attributes)->assertSessionHasErrors(['rate']);

        $attributes['rate'] = 5;
        $this->actingAs($user)->post('/courses', $attributes)->assertSessionHasNoErrors();
    }

    /** @test */
    public function a_user_can_view_a_course()
    {
        $this->withoutExceptionHandling();
        $course = Course::factory()->create();

        $this->get($course->path())->assertSee($course->title)
            ->assertSee($course->description)
            ->assertSee($course->rate);
    }

    /** @test */
    public function users_or_visitors_cannot_create_courses()
    {
        $attributes = Course::factory()->raw([
            'professor_id' => null
        ]);
        $this->post('/courses', $attributes)->assertRedirect('login');

        $this->actingAs(User::factory()->create())->post('/courses', $attributes)->assertStatus(403);
    }


}
