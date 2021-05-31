<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\User;
use Facades\Tests\Setup\CourseFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
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
    public function it_has_a_slug()
    {
        $course = Course::factory()->create();
        $this->assertEquals(Str::slug($course->title), $course->slug);
    }

    /** @test */
    public function it_belongs_to_a_professor()
    {
        $course = Course::factory()->create();
        $this->assertInstanceOf(User::class, $course->owner);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $category = Category::factory()
            ->create();

        $course = CourseFactory::withStorage('public')
            ->category($category)
            ->create();

        $this->assertEquals($course->category->id, $category->id);
    }

    /** @test */
    public function it_belongs_to_a_level()
    {
        $level = Level::factory()
            ->create();

        $course = CourseFactory::withStorage('public')
            ->level($level)
            ->create();

        $this->assertEquals($course->level->id, $level->id);
    }

}
