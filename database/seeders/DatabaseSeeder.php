<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PoskoBencanaSeeder;
use Database\Seeders\DonasiBencanaSeeder;
use Database\Seeders\CreateFirstUserSeeder;
use Database\Seeders\KejadianBencanaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CreateFirstUserSeeder::class,
            KejadianBencanaSeeder::class,
            PoskoBencanaSeeder::class,
            DonasiBencanaSeeder::class,
            DistribusiLogistikSeeder::class,
            LogistikBencanaSeeder::class,
            WargaSeeder::class,
        ]);
    }
}
