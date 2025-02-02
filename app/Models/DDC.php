<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DDC extends Model
{
    use HasFactory;

    protected $table = 'tbl_ddc';
    protected $primaryKey = 'id_ddc';
    public $incrementing = true;
    protected $fillable = ['id_rak', 'kode_ddc', 'ddc', 'keterangan'];
    public $timestamps = false;

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak');
    }
}