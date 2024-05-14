<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1)->create([
            "name" => fake()->name,
            "email" => fake()->safeEmail,
            "mobile_number" => fake()->phoneNumber(),
            "is_admin" => true,
            "address" => fake()->address,
            "password" => Hash::make('password'),
        ]);
    }
}
