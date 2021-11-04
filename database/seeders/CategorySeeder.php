<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = 10;
        Category::factory($categories)->create();

        $products = DB::table('products')->count();
        for ($i = 1; $i <= $products; $i++) {
            for ($j = 0; $j < rand(1, 3); $j++) {
                DB::table('product_categories')->insert([
                    'productID' => $i,
                    'categoryID' => rand(1, $categories)
                ]);
            }
        }
    }
}
