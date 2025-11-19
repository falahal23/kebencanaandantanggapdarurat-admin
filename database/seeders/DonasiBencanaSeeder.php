<?php
namespace Database\Seeders;

use App\Models\DonasiBencana;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DonasiBencanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DonasiBencana::create([
            'kejadian_id'  => 1,
            'donatur_nama' => $faker->name(),
            'jenis'        => $faker->randomElement(['Uang', 'Sembako', 'Obat-obatan', 'Pakaian']),
            'nilai'        => $faker->numberBetween(100000, 5000000),
        ]);

        DonasiBencana::create([
            'kejadian_id'  => 2,
            'donatur_nama' => $faker->name(),
            'jenis'        => $faker->randomElement(['Uang', 'Sembako', 'Obat-obatan', 'Pakaian']),
            'nilai'        => $faker->numberBetween(10000, 1500000),
        ]);
    }
}
