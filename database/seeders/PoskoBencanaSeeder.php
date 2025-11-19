<?php
namespace Database\Seeders;

use App\Models\PoskoBencana;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PoskoBencanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        PoskoBencana::create([
            'kejadian_id'      => 1, // relasi ke kejadian_bencana
            'nama'             => $faker->company(),
            'alamat'           => $faker->address(),
            'kontak'           => $faker->phoneNumber(),
            'penanggung_jawab' => $faker->name(),
        ]);

        PoskoBencana::create([
            'kejadian_id'      => 2,
            'nama'             => $faker->company(),
            'alamat'           => $faker->address(),
            'kontak'           => $faker->phoneNumber(),
            'penanggung_jawab' => $faker->name(),
        ]);

        PoskoBencana::create([
            'kejadian_id'      => 1,
            'nama'             => $faker->company(),
            'alamat'           => $faker->address(),
            'kontak'           => $faker->phoneNumber(),
            'penanggung_jawab' => $faker->name(),
        ]);
    }
}
