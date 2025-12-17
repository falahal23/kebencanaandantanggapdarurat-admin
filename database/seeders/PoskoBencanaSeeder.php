<?php

namespace Database\Seeders;

use App\Models\PoskoBencana;
use App\Models\KejadianBencana;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PoskoBencanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil semua kejadian_id dari tabel kejadian_bencana
        $kejadianIds = KejadianBencana::pluck('kejadian_id')->toArray();

        if (empty($kejadianIds)) {
            $this->command->info("Tabel kejadian_bencana masih kosong! Isi terlebih dahulu.");
            return;
        }

        // Loop untuk membuat 100 data posko
        for ($i = 0; $i < 100; $i++) {
            PoskoBencana::create([
                'kejadian_id'      => $faker->randomElement($kejadianIds),
                'nama'             => $faker->company(),
                'alamat'           => $faker->address(),
                'kontak'           => $faker->phoneNumber(),
                'penanggung_jawab' => $faker->name(),
            ]);
        }

        $this->command->info("Seeder PoskoBencana: 100 data berhasil dibuat!");
    }
}
