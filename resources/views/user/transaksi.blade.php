@extends('user.layouts')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Daftar Transaksi</h2>

            <!-- Tabel Transaksi -->
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-blue-100 text-left">
                        <th class="px-4 py-2 text-gray-700">No</th>
                        <th class="px-4 py-2 text-gray-700">Judul Buku</th>
                        <th class="px-4 py-2 text-gray-700">Tanggal Pinjam</th>
                        <th class="px-4 py-2 text-gray-700">Tanggal Kembali</th>
                        <th class="px-4 py-2 text-gray-700">Tanggal Pengembalian</th>
                        <th class="px-4 py-2 text-gray-700">Keterangan</th>
                        <th class="px-4 py-2 text-gray-700">Dikembalikan</th>
                        <th class="px-4 py-2 text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $index => $trans)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $trans->pustaka->judul_pustaka }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $trans->tgl_pinjam }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $trans->tgl_kembali }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $trans->tgl_pengembalian }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $trans->keterangan }}</td>
                            <td class="px-4 py-2 text-gray-700">
                                <span class="bg-{{ $trans->fp == '0' ? 'red' : 'green' }}-500 text-white py-1 px-3 rounded-full">
                                    {{ $trans->fp == '0' ? 'Belum Dikembalikan' : 'Sudah Dikembalikan' }}
                                </span>
                            </td>
                            
                            <td class="px-4 py-2 text-gray-700">
                                <span class="bg-{{ $trans->status_request == 'pending' ? 'orange' : 'green' }}-500 text-white py-1 px-3 rounded-full">
                                    {{ ucfirst($trans->status_request) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($transaksi->isEmpty())
                <p class="text-gray-500 mt-4">Anda belum memiliki transaksi.</p>
            @endif
        </div>
    </div>
@endsection
