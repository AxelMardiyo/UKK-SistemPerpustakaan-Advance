<?php

namespace App\Http\Controllers;

use App\Models\Pustaka;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id_anggota;
        $transaksi = Transaksi::with('pustaka')->where('id_anggota', $userId)->get();
        // dd($userId);
        return view('user.transaksi', compact('transaksi'));
    }

    public function create($id_buku)
    {
        $user = auth()->user();
        $buku = Pustaka::with(['format', 'pengarang', 'penerbit', 'ddc'])->findOrFail($id_buku);
        
        return view('user.reservasiForm', compact('user', 'buku'));
    }

    public function store(Request $request, $id_buku)
    {
        $userId = auth()->user()->id;
        $buku = Pustaka::with(['format', 'pengarang', 'penerbit', 'ddc'])->findOrFail($id_buku);
        $transaksi = Transaksi::create([
            'id_buku' => $buku->id_buku,
            'id_anggota' => $userId,
            'status' => 'pending',
        ]);
        return redirect()->route('buku.detail', $buku->id_buku);
    }

    public function storeReservasi(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_pustaka' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam|before_or_equal:' . now()->addDays(7)->toDateString(),
            'keterangan' => 'required|max:50',
        ], [
            'tgl_kembali.after_or_equal' => 'Tanggal kembali tidak boleh lebih kecil dari tanggal pinjam.',
            'tgl_kembali.before_or_equal' => 'Tanggal kembali tidak boleh lebih dari 7 hari setelah tanggal pinjam.',
        ]);

        // Menyimpan data transaksi
        $transaksi = new Transaksi();
        $transaksi->id_pustaka = $request->input('id_pustaka');
        $transaksi->id_anggota = $request->input('id_anggota');
        $transaksi->tgl_pinjam = $request->input('tgl_pinjam');
        $transaksi->tgl_kembali = $request->input('tgl_kembali');
        $transaksi->keterangan = $request->input('keterangan');
        // $transaksi->status = 'pending';
        $transaksi->save();

        return redirect()->route('home');
    }

}
