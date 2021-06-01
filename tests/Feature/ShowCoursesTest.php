<?php

namespace Tests\Feature;

use App\Http\Livewire\ShowCourses;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowCoursesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_present_on_index_course_page()
    {
        Course::factory()->create();

        $this->get(route('courses.index'))
            ->assertSeeLivewire('show-courses');
    }

    /** @test */
    public function it_can_search_by_course_name()
    {
        $courses = Course::factory()->count(5)->create();

        $component = Livewire::test(ShowCourses::class);

        $courses->each(function ($course) use($component, $courses) {
            $component->set('search', $course->title)
                ->assertSee($course->title)
                ->assertSee($course->owner->name)
                ->assertSee(ucwords($course->category->name))
                ->assertSee(ucwords($course->level->name));

                $courses->where('title', '!=', $course->title)
                    ->each(function ($notSearchCourse) use ($component) {
                        $component->assertDontSee($notSearchCourse->title);
                    });
        });
    }

    /** @test */
    public function it_can_search_by_professor_name()
    {
        Course::factory()->count(5)->create();

        $courses = Course::with('owner');

        $component = Livewire::test(ShowCourses::class);

        $courses->each(function ($course) use($component, $courses) {
            $component->set('search', $course->owner->name)
                ->assertSee($course->title)
                ->assertSee($course->owner->name)
                ->assertSee(ucwords($course->category->name))
                ->assertSee(ucwords($course->level->name));

            $courses->where('professor_id', '!=', $course->professor_id)
                ->each(function ($notSearchCourse) use ($component) {
                    $component->assertDontSee($notSearchCourse->title);
                });
        });
    }

    /** @test */
    public function it_can_search_by_category()
    {
        Course::factory()->count(10)->create();
        $categories = Category::all();

        $component = Livewire::test(ShowCourses::class);

        $categories->each(function ($category) use($component, $categories) {
            $component->set('category', $category->name);

            $category->courses->each(function ($course) use($component) {
                $component->assertSee($course->title)
                    ->assertSee($course->owner->name)
                    ->assertSee(ucwords($course->category->name))
                    ->assertSee(ucwords($course->level->name));
            });

            $categories->where('name', '!=', $category->name)
                ->each(function ($notSearchCategory) use ($component) {
                    $notSearchCategory->courses->each(function ($notSearchCourse) use ($component) {
                        $component->assertDontSee($notSearchCourse->title);
                    });
                });
        });
    }

    /** @test */
    public function it_can_search_by_level()
    {
        Course::factory()->count(10)->create();
        $levels = Level::all();

        $component = Livewire::test(ShowCourses::class);

        $levels->each(function ($level) use($component, $levels) {
            $component->set('level', $level->name);

            $level->courses->each(function ($course) use($component) {
                $component->assertSee($course->title)
                    ->assertSee($course->owner->name)
                    ->assertSee(ucwords($course->category->name))
                    ->assertSee(ucwords($course->level->name));
            });

            $levels->where('name', '!=', $level->name)
                ->each(function ($notSearchLevel) use ($component) {
                    $notSearchLevel->courses->each(function ($notSearchCourse) use ($component) {
                        $component->assertDontSee($notSearchCourse->title);
                    });
                });
        });
    }

    /** @test */
    public function it_can_search_by_multiple_fields()
    {
        Course::factory()->count(10)->create();

        $course = Course::find(1);

        $notSearchCourse = Course::find(2);

        Livewire::withQueryParams([
            'search' => $course->title,
            'category' => $course->category->name,
            'level' => $course->level->name
        ])->test(ShowCourses::class)
            ->assertSee($course->title)
            ->assertSee($course->owner->name)
            ->assertSee(ucwords($course->category->name))
            ->assertSee(ucwords($course->level->name))
            ->assertDontSee($notSearchCourse->title);
    }
}
