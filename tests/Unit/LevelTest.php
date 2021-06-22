<?php

namespace Tests\Unit;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Facades\Tests\Setup\CourseFactory;


class LevelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_projects()
    {
        $level = Level::factory()->create();

        $course = CourseFactory::withStorage('public')
            ->level($level)
            ->create();

        $this->assertEquals($course->id, $level->courses->first()->id);
    }
}
