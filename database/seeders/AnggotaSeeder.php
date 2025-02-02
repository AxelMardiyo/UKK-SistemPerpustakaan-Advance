<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggota = [
            [
                'id_jenis_anggota' => 1,  // Administrator
                'kode_anggota' => 'A001',
                'nama_anggota' => 'Axel Pratama',
                'tempat' => 'Surabaya',
                'tgl_lahir' => '1990-05-12',
                'alamat' => 'Jl. Raya No. 1',
                'no_telp' => '081234567890',
                'email' => 'admin@gmail.com',
                'tgl_daftar' => Carbon::now(),
                'masa_aktif' => Carbon::now()->addYears(5),
                'fa' => 'Y',  // Aktif
                'keterangan' => 'Administrator perpustakaan',
                'foto' => '',  // Foto dikosongkan
                'username' => 'admin',
                'password' => bcrypt('password'),
            ],
            [
                'id_jenis_anggota' => 2,  // Pustakawan
                'kode_anggota' => 'P001',
                'nama_anggota' => 'Jane Smith',
                'tempat' => 'Malang',
                'tgl_lahir' => '1985-08-22',
                'alamat' => 'Jl. Pustaka No. 2',
                'no_telp' => '081234567891',
                'email' => 'pustakawan@gmail.com',
                'tgl_daftar' => Carbon::now(),
                'masa_aktif' => Carbon::now()->addYears(1),
                'fa' => 'Y',  // Aktif
                'keterangan' => 'Pustakawan utama',
                'foto' => '',  // Foto dikosongkan
                'username' => 'pustakawan',
                'password' => bcrypt('password'),
            ],
            [
                'id_jenis_anggota' => 3,  // Siswa
                'kode_anggota' => 'S001',
                'nama_anggota' => 'Budi Santoso',
                'tempat' => 'Sidoarjo',
                'tgl_lahir' => '2005-02-20',
                'alamat' => 'Jl. Siswa No. 3',
                'no_telp' => '081234567892',
                'email' => 'budi.santoso@email.com',
                'tgl_daftar' => Carbon::now(),
                'masa_aktif' => Carbon::now()->addYears(1),
                'fa' => 'Y',  // Aktif
                'keterangan' => 'Siswa kelas 12',
                'foto' => '',  // Foto dikosongkan
                'username' => 'budisantoso',
                'password' => bcrypt('password789'),
            ],
            [
                'id_jenis_anggota' => 4,  // Guru
                'kode_anggota' => 'G001',
                'nama_anggota' => 'Dewi Kusuma',
                'tempat' => 'Surabaya',
                'tgl_lahir' => '1980-01-15',
                'alamat' => 'Jl. Guru No. 4',
                'no_telp' => '081234567893',
                'email' => 'dewi.kusuma@email.com',
                'tgl_daftar' => Carbon::now(),
                'masa_aktif' => Carbon::now()->addYears(1),
                'fa' => 'Y',  // Aktif
                'keterangan' => 'Guru matematika',
                'foto' => '',  // Foto dikosongkan
                'username' => 'dewikusuma',
                'password' => bcrypt('password101'),
            ],
        ];

        // Insert data ke tabel tbl_anggota
        DB::table('tbl_anggota')->insert($anggota);
    }
}
