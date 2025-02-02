@extends('user.layouts')

@section('title', $buku->judul_pustaka)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Gambar Buku -->
            <div class="lg:w-1/3">
                <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul_pustaka }}" class="w-full h-auto rounded-lg shadow-lg">
            </div>

            <!-- Informasi Buku -->
            <div class="lg:w-2/3">
                <h1 class="text-3xl font-bold text-slate-800">{{ $buku->judul_pustaka }}</h1>
                <p class="text-lg text-gray-600 mt-2">Pengarang: <span class="font-semibold">{{ $buku->pengarang->nama_pengarang }}</span></p>
                <p class="text-lg text-gray-600">Penerbit: <span class="font-semibold">{{ $buku->penerbit->nama_penerbit }}</span></p>
                <p class="text-lg text-gray-600">Tahun Terbit: <span class="font-semibold">{{ $buku->tahun_terbit }}</span></p>
                <p class="text-lg text-gray-600">Jumlah Halaman: <span class="font-semibold">{{ $buku->jumlah_halaman }}</span></p>

                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-blue-600">Deskripsi</h2>
                    <p class="mt-2 text-gray-700 leading-relaxed">{{ $buku->deskripsi }}</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6">
                    {{-- <a href="{{ route('transaksi.pinjam', ['id_buku' => $buku->id_pustaka]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Pinjam Buku</a> --}}
                    {{-- <a href="{{ route('buku.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">Kembali ke Daftar Buku</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
