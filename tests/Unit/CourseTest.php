<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $course = Course::factory()->create();
        $this->assertEquals($course->path(), route('courses.show', $course));
    }

    /** @test */
    public function it_belongs_to_a_professor()
    {
        $course = Course::factory()->create();
        $this->assertInstanceOf(User::class, $course->owner);
    }
}
