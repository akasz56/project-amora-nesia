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
        $products = 100;
        
        for ($i = 1; $i <= $products; $i++) {
            Product::factory()->create();
        }

        for ($i = 0; $i < rand($products, $products*3); $i++) {
            FlowerType::factory(rand(1,3))->create([
                'productID' => $i,
            ]);
            FlowerSize::factory(rand(1,3))->create([
                'productID' => $i,
            ]);
            FlowerWrap::factory(rand(1,3))->create([
                'productID' => $i,
            ]);
        }
    }
}
