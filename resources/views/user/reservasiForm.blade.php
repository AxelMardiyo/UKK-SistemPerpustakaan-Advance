@extends('user.layouts')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Form Peminjaman Buku</h2>

            <div class="flex flex-col md:flex-row items-start space-x-6">
                <!-- Gambar dan Detail Buku -->
                <div class="flex flex-col md:flex-row items-start space-x-4 w-full md:w-1/2">
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $buku->gambar) }}" alt="Buku {{ $buku->judul_pustaka }}" class="w-full max-w-[200px] object-cover rounded-lg shadow-md">
                    </div>

                    <div class="space-y-4 p-5">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $buku->judul_pustaka }}</h3>
                        <p class="text-gray-700"><strong>ISBN:</strong> {{ $buku->isbn }}</p>
                        <p class="text-gray-700"><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                        <p class="text-gray-700"><strong>Pengarang:</strong> {{ $buku->pengarang->nama_pengarang }}</p>
                        <p class="text-gray-700"><strong>Penerbit:</strong> {{ $buku->penerbit->nama_penerbit }}</p>
                        <p class="text-gray-700"><strong>Kategori DDC:</strong> {{ $buku->ddc->ddc }}</p>
                    </div>
                </div>

                <!-- Form Peminjaman -->
                <div class="w-full md:w-1/2">
                    <form action="{{ route('buku.storeReservasi') }}" method="POST" class="space-y-6 bg-gray-100 p-5 rounded-lg shadow-md">
                        @csrf
                        <input type="hidden" name="id_pustaka" value="{{ $buku->id_pustaka }}">
                        <input type="hidden" id="id_anggota" name="id_anggota" value="{{ auth()->user()->id_anggota }}">

                        <!-- Tanggal Pinjam -->
                        <div>
                            <label for="tgl_pinjam" class="block text-gray-700 font-semibold">Tanggal Pinjam</label>
                            <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('tgl_pinjam') }}" required>
                            @error('tgl_pinjam')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Kembali -->
                        <div>
                            <label for="tgl_kembali" class="block text-gray-700 font-semibold">Tanggal Kembali</label>
                            <input type="date" id="tgl_kembali" name="tgl_kembali" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('tgl_kembali') }}" required>
                            @error('tgl_kembali')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="keterangan" class="block text-gray-700 font-semibold">Keterangan</label>
                            <input type="text" id="keterangan" name="keterangan" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="50" value="{{ old('keterangan') }}" required>
                            @error('keterangan')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">Buat Reservasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection