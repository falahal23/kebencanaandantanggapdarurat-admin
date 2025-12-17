<?php

namespace Database\Seeders;

use App\Models\KejadianBencana;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class KejadianBencanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            KejadianBencana::create([
                'jenis_bencana'   => $faker->randomElement(['Banjir', 'Kebakaran', 'Tanah Longsor', 'Puting Beliung', 'Gempa Bumi']),
                'tanggal'         => $faker->date('Y-m-d'),
                'lokasi_text'     => $faker->streetAddress(),
                'rt'              => $faker->numberBetween(1, 10),
                'rw'              => $faker->numberBetween(1, 10),
                'dampak'          => $faker->sentence(8),
                'status_kejadian' => $faker->randomElement(['Aktif', 'Sedang di tangani', 'selesai']),
                'keterangan'      => $faker->sentence(12),
            ]);
        }
    }
}
