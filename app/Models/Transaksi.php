<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = true;
    protected $fillable = ['id_pustaka', 'id_anggota', 'tgl_pinjam', 'tgl_kembali', 'tgl_pengembalian', 'fp', 'keterangan', 'status_request'];
    public $timestamps = false;

    public function pustaka()
    {
        return $this->belongsTo(Pustaka::class, 'id_pustaka');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }
}
