<?php

namespace Tests\Unit;

use App\Models\Comment;
use Facades\Tests\Setup\CourseFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_course()
    {
        $course = CourseFactory::withStorage('public')
            ->create();

        $comment = Comment::factory()->create([
            'course_id' => $course->id
        ]);

        $this->assertEquals($comment->course->id, $course->id);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = UserFactory::create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals($comment->author->id, $user->id);
    }
}

// TODO: Create a more fluently API for adding comments
