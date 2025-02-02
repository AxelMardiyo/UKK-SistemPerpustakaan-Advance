<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'tbl_rak';
    protected $primaryKey = 'id_rak';
    public $incrementing = true;
    protected $fillable = ['kode_rak', 'rak', 'keterangan'];
    public $timestamps = false;
}
