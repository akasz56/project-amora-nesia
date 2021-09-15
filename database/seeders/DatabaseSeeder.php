<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
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
            'addressID' => 1,
        ]);

        User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('test123'),
            'addressID' => 2,
        ]);

        for ($i = 0; $i < $users-2; $i++) {
            User::factory()->create([
                'addressID' => $i+3,
            ]);
        }
    }
}
