<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RakSeeder::class,
            DdcSeeder::class,
            FormatSeeder::class,
            PengarangSeeder::class,
            PenerbitSeeder::class,
            JenisAnggotaSeeder::class,
            AnggotaSeeder::class,
        ]);
    }
}
