<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'video_url' => $this->faker->url,
            'miniature' => 'path/to/file.jpg',
            'rate' => $this->faker->numberBetween(0, 5),
            'category_id' => Category::factory()->create(),
            'level_id' => Level::factory()->create(),
            'professor_id' => User::factory()->create([
                'role' => 'professor'
            ])
        ];
    }
}
