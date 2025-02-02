<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_penerbit')->insert([
            [
                'kode_penerbit' => 'P001',
                'nama_penerbit' => 'Erlangga',
                'alamat_penerbit' => 'Jl. Raya Jakarta No. 123, Jakarta',
                'no_telp' => '0211234567',
                'email' => 'info@erlangga.co.id',
                'fax' => '0217654321',
                'website' => 'https://www.erlangga.co.id',
                'kontak' => 'Bagian Publikasi',
            ],
            [
                'kode_penerbit' => 'P002',
                'nama_penerbit' => 'Gramedia',
                'alamat_penerbit' => 'Jl. Palmerah Barat No. 29, Jakarta',
                'no_telp' => '0217654321',
                'email' => 'contact@gramedia.com',
                'fax' => '0218765432',
                'website' => 'https://www.gramedia.com',
                'kontak' => 'Layanan Pelanggan',
            ],
            [
                'kode_penerbit' => 'P003',
                'nama_penerbit' => 'Andi Offset',
                'alamat_penerbit' => 'Jl. Sosrowijayan No. 12, Yogyakarta',
                'no_telp' => '0274123456',
                'email' => 'cs@andioffset.co.id',
                'fax' => '0274765432',
                'website' => 'https://www.andioffset.co.id',
                'kontak' => 'Admin Penerbitan',
            ],
            [
                'kode_penerbit' => 'P004',
                'nama_penerbit' => 'Media Edukasi',
                'alamat_penerbit' => 'Jl. Kaliurang KM 7 No. 25, Sleman',
                'no_telp' => '0274509876',
                'email' => 'info@mediaedukasi.com',
                'fax' => '0274598765',
                'website' => 'https://www.mediaedukasi.com',
                'kontak' => 'Divisi Penjualan',
            ],
            [
                'kode_penerbit' => 'P005',
                'nama_penerbit' => 'Mizan',
                'alamat_penerbit' => 'Jl. Margonda Raya No. 45, Depok',
                'no_telp' => '02188990000',
                'email' => 'marketing@mizan.com',
                'fax' => '02188887777',
                'website' => 'https://www.mizan.com',
                'kontak' => 'Tim Marketing',
            ],
        ]);
    }
}
