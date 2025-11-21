<?php
namespace Database\Seeders;

use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LogistikBencanaSeeder extends Seeder
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

        // Loop untuk membuat 100 data logistik bencana
        for ($i = 0; $i < 100; $i++) {
            LogistikBencana::create([
                'kejadian_id' => $faker->randomElement($kejadianIds),
                'nama_barang' => $faker->word(),
                'satuan'      => $faker->randomElement(['Dus', 'Pcs', 'Kg', 'Liter']),
                'stok'        => $faker->numberBetween(10, 500),
                'sumber'      => $faker->company(),
            ]);
        }

        $this->command->info("Seeder LogistikBencana: 100 data berhasil dibuat!");
    }
}
