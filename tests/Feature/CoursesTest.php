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

}
