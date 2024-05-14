<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            User::factory()->count(1)->create([
                "name" => fake()->name,
                "email" => 'user' . $i . '@gmail.com',
                "mobile_number" => fake()->phoneNumber(),
                "is_admin" => false,
                "address" => fake()->address,
                "password" => Hash::make('password'),
            ]);
        }

    }
}
