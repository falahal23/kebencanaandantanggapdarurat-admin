<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\PoskoBencana;

class DistribusiLogistikSeeder extends Seeder
{
    public function run(): void
    {
        $logistiks = LogistikBencana::pluck('logistik_id')->toArray();
        $poskos    = PoskoBencana::pluck('posko_id')->toArray();

        // Jangan jalankan seeder jika data master kosong
        if (empty($logistiks) || empty($poskos)) {
            return;
        }

        $daftarPenerima = [
            'Warga Terdampak Bencana',
            'Korban Banjir',
            'Korban Tanah Longsor',
            'Masyarakat Sekitar Posko',
            'Pengungsi Anak-anak',
            'Pengungsi Lanjut Usia',
            'Relawan Tanggap Bencana',
            'Tim Evakuasi Lapangan',
        ];

        for ($i = 1; $i <= 100; $i++) {
            DistribusiLogistik::create([
                'logistik_id' => $logistiks[array_rand($logistiks)],
                'posko_id'    => $poskos[array_rand($poskos)],
                'tanggal'     => now()->subDays(rand(0, 10)),
                'jumlah'      => rand(5, 100),
                'penerima'    => $daftarPenerima[array_rand($daftarPenerima)],
            ]);
        }
    }
}
