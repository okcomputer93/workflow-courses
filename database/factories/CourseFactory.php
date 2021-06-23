<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'title' => $title = $this->faker->sentence,
            'slug' => Str::slug($title),
            'description' => $this->faker->text,
            'video_url' => $this->faker->url,
            'miniature' => 'path/to/file.jpg',
            'rate' => $this->faker->numberBetween(1, 5),
            'category_id' => function() {
                return Category::factory()->create()->id;
            },
            'level_id' => function() {
                return Level::factory()->create()->id;
            },
            'professor_id' => Professor::factory()->create()
                                ->user()
                                ->create(User::factory()->raw())
        ];
    }
}
