<?php
namespace Database\Seeders;

use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\PoskoBencana;
use App\Models\Warga;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DistribusiLogistikSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua ID dari tabel terkait
        $logistikIds = LogistikBencana::pluck('logistik_id')->toArray();
        $poskoIds    = PoskoBencana::pluck('posko_id')->toArray();
        $wargaIds    = Warga::pluck('warga_id')->toArray();

        if (empty($logistikIds) || empty($poskoIds) || empty($wargaIds)) {
            $this->command->info("Tabel relasi masih kosong! Isi tabel logistik, posko, dan warga terlebih dahulu.");
            return;
        }

        // Loop buat 100 data
        for ($i = 0; $i < 100; $i++) {
            DistribusiLogistik::create([
                'logistik_id' => $faker->randomElement($logistikIds),
                'posko_id'    => $faker->randomElement($poskoIds),
                'tanggal'     => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'jumlah'      => $faker->numberBetween(1, 100),
                'penerima'    => $faker->randomElement($wargaIds),
            ]);
        }

        $this->command->info("Seeder DistribusiLogistik: 100 data berhasil dibuat!");
    }
}
