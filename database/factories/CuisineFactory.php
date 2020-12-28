<?php

namespace Database\Factories;

use App\Models\Cuisine;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuisineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cuisine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'is_active' => $this->faker->boolean,
            'created_by' => $this->faker->numberBetween(1, 20)
        ];
    }
}
