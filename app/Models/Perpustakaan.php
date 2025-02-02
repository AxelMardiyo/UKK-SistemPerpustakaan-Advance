<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpustakaan extends Model
{
    use HasFactory;

    protected $table = 'tbl_perpustakaan';
    protected $primaryKey = 'id_perpustakaan';
    public $incrementing = true;
    protected $fillable = ['nama_perpustakaan', 'nama_pustakawan', 'alamat', 'email', 'website', 'no_telp', 'keterangan'];
}
