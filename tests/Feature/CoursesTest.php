<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CoursesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_course_can_be_created()
    {
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'rate' => $this->faker->numberBetween(0, 5)
        ];
        $this->post('/courses', $attributes)->assertRedirect('/courses');
        $this->assertDatabaseHas('courses', $attributes);
    }

    /** @test */
    public function a_course_requires_a_title()
    {
        $attributes = Course::factory()->raw([
            'title' => ''
        ]);

        $this->post('/courses', $attributes)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_course_requires_a_description()
    {
        $attributes = Course::factory()->raw([
            'description' => ''
        ]);

        $this->post('/courses', $attributes)->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function a_course_requires_a_valid_rate_or_default()
    {
        $attributes = Course::factory()->raw([
            'rate' => ''
        ]);
        $this->post('/courses', $attributes)->assertSessionHasNoErrors();

        $attributes['rate'] = 6;
        $this->post('/courses', $attributes)->assertSessionHasErrors(['rate']);

        $attributes['rate'] = 5;
        $this->post('/courses', $attributes)->assertSessionHasNoErrors();
    }
}
