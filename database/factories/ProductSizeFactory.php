<?php

namespace Database\Factories;

use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductSize::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = rand(5, 15);

        if ($amount <= 7)
            $size = 'S';
        else if ($amount <= 12)
            $size = 'M';
        else
            $size = 'L';

        return [
            'name' => $size,
            'flower_amount' => $amount,
            'stock' => rand(0, 100),
            'price' => rand(10000, 500000),
        ];
    }
}
