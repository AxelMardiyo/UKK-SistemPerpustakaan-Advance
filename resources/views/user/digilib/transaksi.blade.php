@extends('user.digilib.layouts')

@section('content')
    <div class="h-screen flex items-center justify-center px-10 py-20">
        <div class="container">
            <h1 class="text-4xl font-bold text-center mb-8">Detail Transaksi</h1>

            @if ($transaksi->isEmpty())
                <p class="text-gray-500 text-center">Tidak ada transaksi ditemukan.</p>
            @else
                <table class="w-full border-collapse border border-gray-200 mb-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No.</th>
                            <th class="border px-4 py-2">Judul Pustaka</th>
                            <th class="border px-4 py-2">Tanggal Pinjam</th>
                            <th class="border px-4 py-2">Tanggal Kembali</th>
                            <th class="border px-4 py-2">Tanggal Pengembalian</th>
                            <th class="border px-4 py-2">Dikembalikan</th>
                            <th class="border px-4 py-2">Keterangan</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $item->pustaka->judul_pustaka }}</td>
                                <td class="border px-4 py-2">{{ $item['tgl_pinjam'] }}</td>
                                <td class="border px-4 py-2">{{ $item['tgl_kembali'] }}</td>
                                <td class="border px-4 py-2">{{ $item['tgl_pengembalian'] ?? '-' }}</td>
                                <td class="border px-4 py-2 {{ $item['fp'] == 1 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $item['fp'] == 1 ? 'Dikembalikan' : 'Belum Dikembalikan' }}
                                </td>
                                <td class="border px-4 py-2">{{ $item['keterangan'] }}</td>
                                <td class="border px-4 py-2">
                                    <span
                                        class="
                                        px-2 py-1 rounded text-white text-sm 
                                        {{ $item['status_request'] == 'pending' ? 'bg-yellow-500' : '' }}
                                        {{ $item['status_request'] == 'approved' ? 'bg-blue-600' : '' }}
                                        {{ $item['status_request'] == 'rejected' ? 'bg-red-500' : '' }}
                                    ">{{ ucfirst($item['status_request']) }}</span>
                                </td>
                                <td class="border px-4 py-2">
                                    @if ($item['status_request'] == 'pending')
                                        <button type="button"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                                            onclick="batalkanTransaksi({{ $item->id_transaksi }})">
                                            Batalkan
                                        </button>
                                    @endif
                                    @if ($item['status_request'] == 'approved')
                                        <a href="{{ route('digilib.printInvoice', $item->id_transaksi) }}"
                                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                            Cetak Invoice
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="text-center">
                <a href="/digilib" class="inline-block px-4 my-3 py-2 bg-indigo-500 text-white rounded hover:bg-blue-600">
                    Kembali
                </a>
            </div>
        </div>
    </div>
    <script>
        function batalkanTransaksi(id_transaksi) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Transaksi ini akan dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Tidak, batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Melakukan penghapusan transaksi via ajax atau formulir
                    axios.put(`/digilib/cancel/${id_transaksi}`)
                        .then(response => {
                            Swal.fire('Berhasil!', 'Transaksi telah dibatalkan.', 'success')
                                .then(() => {
                                    window.location.reload(); // Refresh halaman setelah sukses
                                });
                        })
                        .catch(error => {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat membatalkan transaksi.', 'error');
                        });
                }
            });
        }
    </script>
@endsection
