<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pustaka;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Picqer\Barcode\BarcodeGeneratorHTML;

class UserController extends Controller
{
    public function index()
    {
        $pustaka = Pustaka::get();
        return view('user.digilib.digilib', compact('pustaka'));
    }

    public function pustaka()
    {
        $pustaka = Pustaka::get();
        return view('user.digilib.pustaka', compact('pustaka'));
    }

    public function show($id_pustaka)
    {
        $book = Pustaka::with(['format', 'ddc', 'penerbit', 'pengarang'])->findOrFail($id_pustaka);
        return view('user.digilib.show', compact('book'));
    }

    public function transaksi()
    {
        $id_anggota = Auth::user()->id_anggota;
        $transaksi = Transaksi::where('id_anggota', $id_anggota)
            ->with('pustaka')
            ->orderBy('id_transaksi', 'desc') // Urutkan berdasarkan kolom 'id' dari yang terbesar ke terkecil
            ->get();
        return view('user.digilib.transaksi', compact('transaksi'));
    }

    public function create($id_pustaka)
    {
        $id_anggota = Auth::user()->id_anggota;

        $pustaka = Pustaka::get();
        return view('user.digilib.create', compact('id_anggota', 'pustaka', 'id_pustaka'));
    }


    public function store(Request $request)
    {
        $id_anggota = Auth::user()->id_anggota;
        $anggota = Anggota::where('id_anggota', $id_anggota)->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data Anggota tidak ditemukan');
        }

        $max_pinjam = $anggota->jenisAnggota->max_pinjam;
        // Periksa apakah ada transaksi yang belum selesai
        $existingTransaction = Transaksi::where('id_anggota', $id_anggota)
            ->where('fp', '0')
            ->exists();

        $countTransaksi = Transaksi::where('id_anggota', $id_anggota)->where('fp', '0')->count();


        if ($countTransaksi >= $max_pinjam) {
            return redirect()->back()->with('error', 'Anda telah mencapai batas maksimal peminjaman!');
        }

        $request->validate([
            'id_pustaka' => 'required|exists:tbl_pustaka,id_pustaka',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'keterangan' => 'nullable|string|max:50',
        ]);

        if (strtotime($request->tgl_kembali) < strtotime($request->tgl_pinjam)) {
            return redirect()->back()->with('error', 'Tanggal kembali tidak boleh lebih kecil dari tanggal pinjam.');
        }

        Transaksi::create([
            'id_pustaka' => $request->id_pustaka,
            'id_anggota' => $id_anggota,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'fp' => '0',
            'keterangan' => $request->keterangan ?? '-',
        ]);

        return redirect('/digilib')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function cancel($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);

        // Periksa status transaksi
        if ($transaksi->status_request == 'pending') {
            // Hapus transaksi jika statusnya masih pending
            $transaksi->delete();

            return response()->json(['message' => 'Transaksi berhasil dibatalkan.']);
        }

        return response()->json(['message' => 'Transaksi tidak dapat dibatalkan.'], 400);
    }

    public function printInvoice($id_transaksi)
    {
        $transaksi = Transaksi::with(['pustaka', 'anggota'])->findOrFail($id_transaksi);

        // Pastikan hanya transaksi yang sudah approved yang dapat dicetak
        if ($transaksi->status_request != 'approved') {
            return redirect('/digilib')->with('error', 'Transaksi belum disetujui.');
        }

        // Membuat data untuk invoice
        // $data = [
        //     'transaksi' => $transaksi,
        //     'anggota' => $transaksi->anggota,
        //     'tanggal' => now()->format('d-m-Y')
        // ];

        $hashedKodeTransaksi = substr(md5($transaksi->id_transaksi), 0, 15);

        // Generate Barcode for the transaction code
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($transaksi->id_transaksi, BarcodeGeneratorHTML::TYPE_CODE_128);

        // Generate the data for the invoice
        $data = [
            'transaksi' => $transaksi,
            'anggota' => $transaksi->anggota,
            'hashedKodeTransaksi' => $hashedKodeTransaksi,
            'tanggal' => now()->format('d-m-Y'),
            'barcode' => $barcode,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('user.digilib.invoice', $data);

        // Mengatur ukuran kertas ke 80mm x 200mm (ukuran struk)
        $pdf->setPaper('a4', 'portrait');  // [x1, y1, x2, y2] adalah ukuran kertas dalam mm

        // Menyimpan dan mendownload PDF
        return $pdf->stream('invoice_' . $transaksi->id_transaksi . '.pdf');
    }
}
