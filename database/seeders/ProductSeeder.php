<?php

namespace Database\Seeders;

use App\Models\FlowerSize;
use App\Models\FlowerType;
use App\Models\FlowerWrap;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i = 1; $i <= 100; $i++) {
            Product::factory()->create([
                'publicID' => 'KOM1' . ($i + 300),
            ]);
        }

        for ($i = 0; $i < rand(100, 300); $i++) {
            FlowerType::factory(rand(1,3))->create([
                'productID' => 'KOM1' . ($i + 300),
            ]);
            FlowerSize::factory(rand(1,3))->create([
                'productID' => 'KOM1' . ($i + 300),
            ]);
            FlowerWrap::factory(rand(1,3))->create([
                'productID' => 'KOM1' . ($i + 300),
            ]);
        }
    }
}
