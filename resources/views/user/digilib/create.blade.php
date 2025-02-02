@extends('user.digilib.layouts')

@section('content')
    <div class="h-screen flex items-center justify-center mx-auto lg:w-3/4 px-10 py-20">
        <div class="container">
            <h1 class="text-4xl font-bold text-center mb-8">Form Reservasi</h1>

            <form action="{{ route('digilib.store') }}" method="POST" class="space-y-4">
                @csrf <!-- CSRF Token untuk keamanan -->

                <!-- Input ID Pustaka -->
                <div>
                    <label for="id_pustaka" class="block mb-2 text-sm font-medium text-gray-700">Pustaka</label>
                    <select name="id_pustaka" id="id_pustaka"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-150">
                        @foreach ($pustaka as $p)
                            <option value="{{ $p->id_pustaka }}" @if ($id_pustaka == $p->id_pustaka) selected @endif>
                                {{ $p->judul_pustaka }} | Stok Tersedia : {{ $p->sisa }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pustaka')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tanggal Pinjam -->
                <div>
                    <label for="tgl_pinjam" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" id="tgl_pinjam"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                    @error('tgl_pinjam')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Tanggal Kembali -->
                <div>
                    <label for="tgl_kembali" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                    @error('tgl_kembali')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Keterangan -->
                <div>
                    <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" maxlength="50"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Keterangan tambahan (opsional)">
                    @error('keterangan')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-blue-600">
                        Submit
                    </button>
                    <a href="/digilib" class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK',
                showCancelButton: true, // Menampilkan tombol tambahan
                cancelButtonText: 'Lihat Daftar Transaksi', // Teks untuk tombol tambahan
                cancelButtonColor: '#3085d6', // Warna tombol tambahan
                reverseButtons: true, // Membalik urutan tombol
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '{{ route('digilib.transaksi') }}'; // Redirect ke daftar transaksi
                }
            });
        @endif
    </script>
@endsection
