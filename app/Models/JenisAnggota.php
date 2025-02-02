<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAnggota extends Model
{
    use HasFactory;

    protected $table = 'tbl_jenis_anggota';
    protected $primaryKey = 'id_jenis_anggota';
    public $incrementing = true;
    protected $fillable = ['kode_jenis_anggota', 'jenis_anggota', 'max_pinjam', 'keterangan'];

    public $timestamps = false;
}
