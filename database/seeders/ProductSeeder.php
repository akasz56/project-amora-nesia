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
        $users = 25;

        for ($i = 1; $i <= $users; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $prodID = Product::factory()->create([
                    'shopID' => $i,
                ]);

                for ($k = 1; $k <= 3; $k++) {
                    FlowerType::factory()->create([
                        'productID' => $prodID,
                    ]);
                    FlowerWrap::factory()->create([
                        'productID' => $prodID,
                    ]);
                }

                FlowerSize::factory()->create([
                    'productID' => $prodID,
                    'name' => 'S',
                    'flower_amount' => rand(5, 7),
                ]);
                FlowerSize::factory()->create([
                    'productID' => $prodID,
                    'name' => 'M',
                    'flower_amount' => rand(8, 12),
                ]);
                FlowerSize::factory()->create([
                    'productID' => $prodID,
                    'name' => 'L',
                    'flower_amount' => rand(13, 15),
                ]);
            }
        }
    }
}
