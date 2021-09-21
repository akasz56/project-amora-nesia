<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shopID' => rand(1,50),
            'name' => $this->faker->words(rand(1,4), true),
            'description' => $this->faker->text(),
            'rating' => rand(0,5),
            'viewers' => rand(0,5000),
        ];
    }
}
