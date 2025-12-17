<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $faker->unique(true); // reset unique faker

        // 🔹 1. Super Admin (aman di-seed berkali-kali)
        User::updateOrCreate(
            ['email' => 'falahal@gmail.com'],
            [
                'name'     => 'Falahal Nabil',
                'password' => Hash::make('2401010'),
                'role'     => 'Super Admin',
            ]
        );

        // 🔹 2. User random (anti duplikat)
        for ($i = 1; $i <= 100; $i++) {
            User::firstOrCreate(
                [
                    // email dijamin unik
                    'email' => "user{$i}@example.com",
                ],
                [
                    'name'     => $faker->name(),
                    'password' => Hash::make('password'),
                    'role'     => 'User',
                ]
            );
        }
    }
}
