<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = 25;

        Address::factory($users)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@ittoday.id',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'addressID' => 1,
            'shopID' => 1,
        ]);

        User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('test123'),
            'email_verified_at' => now(),
            'addressID' => 2,
            'shopID' => 2,
        ]);

        for ($i = 1; $i <= $users; $i++) {
            Shop::factory()->create(['addressID' => $i,]);

            if ($i > 2) {
                User::factory()->create([
                    'addressID' => $i,
                    'shopID' => $i,
                ]);
            }
        }
    }
}
