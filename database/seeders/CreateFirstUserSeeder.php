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
        // 👇 TAMBAHKAN 'id_ID' DI SINI
        $faker = Faker::create('id_ID');

        // 🔹 1. Buat admin default (Super Admin)
        User::firstOrCreate(
            ['email' => 'falahal@gmail.com'],
            [
                'name'     => 'Falahal Nabil',
                'password' => Hash::make('2401010'),
                'role'     => 'Super Admin',
            ]
        );

        // 🔹 2. Buat 100 user random
        for ($i = 0; $i < 100; $i++) {
            User::create([
                // Nama akan jadi 'Budi Santoso', 'Siti Aminah', dll.
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'role'     => 'User',
            ]);
        }
    }
}
