<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use Facades\Tests\Setup\CourseFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_courses()
    {
        $user = UserFactory::role('professor')
            ->create();

        $this->assertInstanceOf(Collection::class, $user->courses);
    }

    /** @test */
    public function it_has_comments()
    {
        $user = UserFactory::create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals($user->comments->first()->id, $comment->id);
    }

    /** @test */
    public function it_has_views_courses()
    {
        $user = UserFactory::create();

        $course = CourseFactory::withStorage('public')
            ->addViewers($user)
            ->create();

        $this->assertEquals(
            $user->views->first()->id,
            $course->id
        );
    }
}
