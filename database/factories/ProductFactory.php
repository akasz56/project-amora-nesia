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
            'shopID' => rand(1, 50),
            'name' => $this->faker->words(rand(1, 4), true),
            'description' => $this->faker->text(),
            'stock' => rand(1, 10),
            'price' => rand(5000, 200000),
            'rating' => rand(1, 5),
            'viewers' => rand(100, 5000),
        ];
    }
}
