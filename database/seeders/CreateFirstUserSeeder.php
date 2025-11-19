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
        $faker = Faker::create();

        // 🔹 1. Buat admin default (pakai Gmail)
        User::create([
            'name'     => 'Falahal',
            'email'    => 'falahal12@gmail.com',
            'password' => Hash::make('flhl1224'),
        ]);

        // 🔹 2. Buat 10 user random
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
