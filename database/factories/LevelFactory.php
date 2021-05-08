<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Level::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'scale' => $scale = $this->faker->randomElement([1, 2, 3]),
            'name' => ['basic', 'intermediate', 'advanced'][$scale - 1]
        ];
    }
}
