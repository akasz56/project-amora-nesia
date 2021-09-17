<?php

namespace Database\Factories;

use App\Models\FlowerType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlowerTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlowerType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(rand(1,4), true),
            'color' => $this->faker->colorName(),
            'stock' => rand(0, 100),
            'price' => rand(10000, 500000),
        ];
    }
}
