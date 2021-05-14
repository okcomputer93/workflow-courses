<?php

namespace Database\Factories;

use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfessorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Professor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'career' => $this->faker->randomElement(['Engineer', 'Teacher', 'Scientist']),
            'about' => $this->faker->text,
            'twitter_user' => $this->faker->word,
            'github_user' => $this->faker->word,
        ];
    }
}
