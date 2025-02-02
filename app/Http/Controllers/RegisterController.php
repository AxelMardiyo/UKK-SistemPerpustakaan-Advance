<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\JenisAnggota;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $jenisAnggota = JenisAnggota::whereNotIn('id_jenis_anggota', [3, 4])->get();
        return view('user.register', compact('jenisAnggota'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|max:100',
            'tempat' => 'required|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'email' => 'required|email|max:30',
            'masa_aktif' => 'required|date',
            'id_jenis_anggota' => 'required|exists:tbl_jenis_anggota,id_jenis_anggota',
            'username' => 'required|max:50|unique:tbl_anggota',
            'password' => 'required|max:50',
        ]);
    
        // Generate kode anggota otomatis dengan format AGXXX
        $lastKodeAnggota = \App\Models\Anggota::where('kode_anggota', 'like', 'AG%')
            ->orderBy('kode_anggota', 'desc')
            ->first();

        if ($lastKodeAnggota) {
            $lastNumber = (int) substr($lastKodeAnggota->kode_anggota, 2); // Ambil angka setelah 'AG'
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1; // Jika belum ada data, mulai dari 1
        }

        $kodeAnggota = 'AG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT); // Format AGXXX

        // Buat data anggota baru
        Anggota::create([
            'kode_anggota' => $kodeAnggota,
            'nama_anggota' => $request->nama_anggota,
            'tempat' => $request->tempat,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'tgl_daftar' => date('Y-m-d'),
            'masa_aktif' => $request->masa_aktif,
            'id_jenis_anggota' => $request->id_jenis_anggota,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'fa' => 'T',
        ]);
    
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
    
}
