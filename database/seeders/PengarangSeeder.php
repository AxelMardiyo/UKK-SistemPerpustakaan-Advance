<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'kode_pengarang' => 'PGR' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'gelar_depan' => $faker->optional()->title,
                'nama_pengarang' => $faker->name,
                'gelar_belakang' => $faker->optional()->suffix,
                'no_telp' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'website' => $faker->url,
                'biografi' => $faker->text,
                'keterangan' => 'Pengarang ke ' . $i,
            ];
        }
        DB::table('tbl_pengarang')->insert($data);
    }
}
