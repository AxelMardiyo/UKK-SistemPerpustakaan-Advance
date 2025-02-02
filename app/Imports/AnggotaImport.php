<?php

namespace App\Imports;

use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anggota([
            'kode_anggota' => $row['kode_anggota'],
            'id_jenis_anggota' => $row['id_jenis_anggota'], 
            'nama_anggota' => $row['nama_anggota'],
            'tempat' => $row['tempat'],
            'tgl_lahir' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir'])), // Konversi tanggal
            'alamat' => $row['alamat'],
            'no_telp' => $row['no_telp'],
            'email' => $row['email'],
            'username' => $row['username'],
            'password' => bcrypt($row['password']),
            'tgl_daftar' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_daftar'])), // Konversi tanggal
            'masa_aktif' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['masa_aktif'])), // Konversi tanggal
            'fa' => $row['fa'],
        ]);
    }
}
