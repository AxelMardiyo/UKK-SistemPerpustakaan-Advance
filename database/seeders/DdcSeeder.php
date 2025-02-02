<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DdcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ddcs = [
            ['kode_ddc' => '001', 'ddc' => 'Pengetahuan Umum', 'keterangan' => 'Buku tentang pengetahuan umum seperti ensiklopedia, kamus, dan ilmu interdisipliner.'],
            ['kode_ddc' => '002', 'ddc' => 'Buku, Penulisan, dan Perpustakaan', 'keterangan' => 'Subjek terkait buku, penulisan, penerbitan, dan perpustakaan.'],
            ['kode_ddc' => '003', 'ddc' => 'Sistem', 'keterangan' => 'Sistem dan teori sistem, termasuk teori informasi.'],
            ['kode_ddc' => '004', 'ddc' => 'Komputer dan Teknologi Informasi', 'keterangan' => 'Teknologi komputer, perangkat keras, perangkat lunak, dan internet.'],
            ['kode_ddc' => '005', 'ddc' => 'Pemrograman dan Data', 'keterangan' => 'Bahasa pemrograman, pengolahan data, dan algoritma.'],
            ['kode_ddc' => '006', 'ddc' => 'Kecerdasan Buatan', 'keterangan' => 'Kecerdasan buatan, pengenalan pola, dan robotika.'],
            ['kode_ddc' => '007', 'ddc' => 'Jurnalistik dan Media', 'keterangan' => 'Ilmu jurnalistik, media massa, dan penyiaran.'],
            ['kode_ddc' => '008', 'ddc' => 'Perkembangan Peradaban', 'keterangan' => 'Aspek sosial, budaya, dan teknologi dalam perkembangan manusia.'],
            ['kode_ddc' => '009', 'ddc' => 'Sejarah dan Geografi Umum', 'keterangan' => 'Sejarah dunia dan geografi umum.'],
        ];

        foreach ($ddcs as $ddc) {
            DB::table('tbl_ddc')->insert([
                'kode_ddc' => $ddc['kode_ddc'],
                'ddc' => $ddc['ddc'],
                'keterangan' => $ddc['keterangan'],
                'id_rak' => rand(1, 20), // ID Rak acak antara 1 hingga 20      
            ]);
        }
    }
}
