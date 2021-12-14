<?php

namespace Database\Seeders;

// use App\Models\ProductSize;
// use App\Models\ProductType;
// use App\Models\ProductWrap;
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
        $users = 25;

        for ($i = 1; $i <= $users; $i++) {
            Product::factory()->count(3)->create(['shopID' => $i]);

            // for ($j = 1; $j <= 3; $j++) {
            //     $product = Product::factory()->create([
            //         'shopID' => $i,
            //     ]);

            //     for ($k = 1; $k <= 3; $k++) {
            //         ProductType::factory()->create([
            //             'productID' => $product->id,
            //         ]);
            //         ProductWrap::factory()->create([
            //             'productID' => $product->id,
            //         ]);
            //     }

            //     ProductSize::factory()->create([
            //         'productID' => $product->id,
            //         'name' => 'S',
            //         'flower_amount' => rand(5, 7),
            //     ]);
            //     ProductSize::factory()->create([
            //         'productID' => $product->id,
            //         'name' => 'M',
            //         'flower_amount' => rand(8, 12),
            //     ]);
            //     ProductSize::factory()->create([
            //         'productID' => $product->id,
            //         'name' => 'L',
            //         'flower_amount' => rand(13, 15),
            //     ]);
            // }
        }
    }
}
