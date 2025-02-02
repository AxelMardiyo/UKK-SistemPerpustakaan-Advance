<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $table = 'tbl_format';
    protected $primaryKey = 'id_format';
    public $incrementing = true;
    protected $fillable = ['kode_format', 'format', 'keterangan'];
    public $timestamps = false;
}
