@extends('user.digilib.layouts')

@section('content')
    <section class="detailBuku my-10 py-10">
        <p class="text-indigo-500 font-semibold text-center">DETAIL BUKU</p>
        <h1 class="text-4xl font-bold text-center mb-8">{{ $book->judul_pustaka }}</h1>

        <div class="container mx-auto px-10">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <!-- Gambar Buku -->
                <div class="md:w-1/4">
                    <img src="{{ asset('storage/' . $book->gambar) }}" alt="Cover Buku"
                        class="object-cover rounded-md shadow-md">
                </div>

                <!-- Detail Buku -->
                <div class="w-full md:w-3/4">
                    <div class="bg-white p-6 rounded-md shadow-lg">
                        <p class="text-lg font-semibold text-gray-800 mb-4">
                            {{ \Illuminate\Support\Str::limit($book->abstraksi, 700) }}
                        </p>
                        <div class="mb-4">
                            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                            <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
                            <p><strong>Harga Buku:</strong> Rp {{ number_format($book->harga_buku, 0, ',', '.') }}</p>
                            <p><strong>Kondisi Buku:</strong> {{ $book->kondisi_buku }}</p>
                            <p><strong>Ket. Fisik:</strong> {{ $book->keterangan_fisik ?? 'Tidak ada' }}</p>
                            <p><strong>Stok Tersedia:</strong> {{ $book->sisa }}</p>
                        </div>

                        <div class="mb-4">
                            <p><strong>DDC:</strong> {{ $book->ddc->ddc ?? 'Tidak ada' }}</p>
                            <p><strong>Format:</strong> {{ $book->format->format ?? 'Tidak ada' }}</p>
                            <p><strong>Penerbit:</strong> {{ $book->penerbit->nama_penerbit ?? 'Tidak ada' }}</p>
                            <p><strong>Pengarang:</strong> {{ $book->pengarang->nama_pengarang ?? 'Tidak ada' }}</p>
                        </div>

                        <div class="mb-4">
                            <p><strong>Denda Terlambat:</strong>Rp {{ number_format($book->denda_terlambat, 0, ',', '.') }}</p>
                            <p><strong>Denda Hilang:</strong> Rp {{ number_format($book->denda_hilang, 0, ',', '.') }}</p>
                        </div>

                        <!-- Button Kembali ke Daftar Buku dan Tombol Reservasi -->
                        <div class="mt-4 flex space-x-4">
                            <a href="/digilib#buku">
                                <button 
                                    class="bg-indigo-500 text-white px-6 py-2 rounded-md hover:bg-indigo-600 transition duration-300">
                                    Kembali ke Daftar Buku
                                </button>
                            </a>
                            @auth
                            <a href="{{ route('digilib.create', $book->id_pustaka) }}">
                                <button
                                    class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                                    Reservasi Buku
                                </button>
                            </a>
                            @endauth
                            @guest
                                <p class="px-6 py-2 text-gray-600 font-semibold">Login untuk melakukan reservasi</p>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
