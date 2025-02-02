<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisAnggota = [
            [
                'kode_jenis_anggota' => '01',
                'jenis_anggota' => 'Administrator',
                'max_pinjam' => '10',  // Jumlah maksimal buku yang dapat dipinjam
                'keterangan' => 'Anggota dengan hak akses penuh untuk mengelola perpustakaan.',
            ],
            [
                'kode_jenis_anggota' => '02',
                'jenis_anggota' => 'Pustakawan',
                'max_pinjam' => '5',  // Jumlah maksimal buku yang dapat dipinjam
                'keterangan' => 'Anggota yang bertanggung jawab atas pengelolaan perpustakaan.',
            ],
            [
                'kode_jenis_anggota' => '03',
                'jenis_anggota' => 'Siswa',
                'max_pinjam' => '3',  // Jumlah maksimal buku yang dapat dipinjam
                'keterangan' => 'Anggota yang merupakan siswa di sekolah ini.',
            ],
            [
                'kode_jenis_anggota' => '04',
                'jenis_anggota' => 'Guru',
                'max_pinjam' => '5',  // Jumlah maksimal buku yang dapat dipinjam
                'keterangan' => 'Anggota yang merupakan guru di sekolah ini.',
            ]
        ];

        // Insert data ke tabel tbl_jenis_anggota
        DB::table('tbl_jenis_anggota')->insert($jenisAnggota);
    }
}
