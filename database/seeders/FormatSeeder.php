<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formats = [
            ['kode_format' => 'FMT001', 'format' => 'Fisik', 'keterangan' => 'Buku dalam bentuk cetak'],
            ['kode_format' => 'FMT002', 'format' => 'Ebook', 'keterangan' => 'Buku dalam bentuk elektronik'],
            ['kode_format' => 'FMT003', 'format' => 'Jurnal', 'keterangan' => 'Publikasi ilmiah berbentuk jurnal'],
            ['kode_format' => 'FMT004', 'format' => 'Majalah', 'keterangan' => 'Bentuk cetak majalah'],
            ['kode_format' => 'FMT005', 'format' => 'Surat Kabar', 'keterangan' => 'Koran harian atau mingguan'],
            ['kode_format' => 'FMT006', 'format' => 'Makalah', 'keterangan' => 'Makalah ilmiah atau tugas'],
            ['kode_format' => 'FMT007', 'format' => 'Artikel', 'keterangan' => 'Artikel pendek atau opini'],
            ['kode_format' => 'FMT008', 'format' => 'CD/DVD', 'keterangan' => 'File dalam bentuk CD atau DVD'],
            ['kode_format' => 'FMT009', 'format' => 'Audio Book', 'keterangan' => 'Buku dalam bentuk audio'],
            ['kode_format' => 'FMT010', 'format' => 'Video', 'keterangan' => 'Materi dalam bentuk video'],
        ];

        DB::table('tbl_format')->insert($formats);
    }
}
