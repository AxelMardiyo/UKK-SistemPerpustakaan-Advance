<?php

namespace App\Http\Controllers;

use App\Models\Pustaka;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    public function index() {
        $buku = Pustaka::with(['format', 'pengarang', 'penerbit', 'ddc'])->get();
        $bukuLimit = Pustaka::with(['format', 'pengarang', 'penerbit', 'ddc'])->limit(6)->get();
        return view('user.home', compact('buku', 'bukuLimit'));
    }
    public function show($id_buku)
    {
        $buku = Pustaka::with(['format', 'pengarang', 'penerbit', 'ddc']) // Hilangkan 'judul_pustaka' dan 'gambar', karena bukan relasi
            ->findOrFail($id_buku);

        return view('user.detailBuku', compact('buku'));
    }

}
