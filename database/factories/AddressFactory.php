<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provinceID' => rand(1,10),
            'city' => $this->faker->city(),
            'rt' => rand(1,10),
            'rw' => rand(1,10),
            'address' => $this->faker->address(),
            'postcode' => rand(10000,99999),
        ];
    }
}
