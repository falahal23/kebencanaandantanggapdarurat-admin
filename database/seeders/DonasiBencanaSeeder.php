<?php
namespace Database\Seeders;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DonasiBencanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua kejadian_id dari tabel kejadian_bencana
        $kejadianIds = KejadianBencana::pluck('kejadian_id')->toArray();

        if (empty($kejadianIds)) {
            $this->command->info("Tabel kejadian_bencana masih kosong! Isi terlebih dahulu.");
            return;
        }

        // Loop untuk membuat 100 data donasi
        for ($i = 0; $i < 100; $i++) {
            DonasiBencana::create([
                'kejadian_id'  => $faker->randomElement($kejadianIds),
                'donatur_nama' => $faker->name(),
                'jenis'        => $faker->randomElement(['Uang', 'Sembako', 'Obat-obatan', 'Pakaian']),
                'nilai'        => $faker->numberBetween(10000, 5000000),
            ]);
        }

        $this->command->info("Seeder DonasiBencana: 100 data berhasil dibuat!");
    }
}
