<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Level;
use App\Models\User;
use Facades\Tests\Setup\CourseFactory;
use Facades\Tests\Setup\UserFactory;
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
    public function it_has_a_dynamic_path()
    {
        $course = Course::factory()->create();
        $this->assertEquals($course->path('edit'), route('courses.edit', $course));
        $this->assertEquals($course->path(), route('courses.show', $course));
        $this->assertEquals($course->path('update'), route('courses.update', $course));
    }

    /** @test */
    public function it_has_a_watch_path()
    {
        $course = Course::factory()->create();
        $this->assertEquals($course->watchPath(), route('courses.watch', $course));
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

    /** @test */
    public function it_has_comments()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        $comment = Comment::factory()->create([
            'course_id' => $course->id
        ]);

        $this->assertEquals($course->comments->first()->id, $comment->id);
    }

    /** @test */
    public function it_has_viewers()
    {
        $user = UserFactory::create();

        $course = CourseFactory::withStorage('public')
            ->addViewers($user)
            ->create();

        $this->assertEquals(
            $course->viewers->first()->id,
            $user->id
        );
    }

    /** @test */
    public function it_has_a_percentage_of_rate()
    {
        $course = CourseFactory::withStorage('public')
            ->create();
        $rate = 3;
        $maxRate = 5;
        $course->rate = $rate;
        $course->save();

        $this->assertEquals($rate * 100 / $maxRate, $course->ratePercentage());
    }

}
