<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Professor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => function () {
                return Course::factory()->create()->id;
            },
            'user_id' => function () {
                return Student::factory()->create()
                    ->user()
                    ->create(User::factory()->raw());
            }
        ];
    }
}
