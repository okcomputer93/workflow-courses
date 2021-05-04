<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Facades\Tests\Setup\CourseFactory;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_projects()
    {
        $category = Category::factory()
            ->create();

        $course = CourseFactory::withStorage('public')
            ->category($category)
            ->create();

        $this->assertEquals($course->id, $category->courses->first()->id);
    }
}
