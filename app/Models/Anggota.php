<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Filament\Panel;

class Anggota extends Authenticatable implements FilamentUser
{
    use HasFactory;

    protected $table = 'tbl_anggota';
    protected $primaryKey = 'id_anggota';
    public $incrementing = true;
    protected $fillable = [
        'id_jenis_anggota', 'kode_anggota', 'nama_anggota', 'tempat', 'tgl_lahir', 
        'alamat', 'no_telp', 'email', 'tgl_daftar', 'masa_aktif', 'fa', 
        'keterangan', 'foto', 'username', 'password', 'remember_token'
    ];
    public $timestamps = false;

    public function jenisAnggota()
    {
        return $this->belongsTo(JenisAnggota::class, 'id_jenis_anggota');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Panel Admin hanya untuk jenis anggota 3 (Administrator) dan 4 (Pustakawan)
        if ($panel->getId() === 'admin') {
            return in_array($this->id_jenis_anggota, [1,2]);
        }

        // Panel User hanya untuk jenis anggota 1 (Siswa) dan 2 (Guru)
        if ($panel->getId() === 'user') {
            return in_array($this->id_jenis_anggota, [3,4]);
        }

        // Default: Tidak memiliki akses
        return false;
    }
}
