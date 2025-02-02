<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation Proof</title>

    <style type="text/css">
        @page {
            size: 10cm 15cm;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
            padding: 0;
            margin-left: 1pt;
            margin-right: 2pt;
        }

        h2,
        h3 {
            margin: 5px 0;
        }

        table {
            width: 100%;
            font-size: small;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 5px;
            font-size: small;
        }

        .gray {
            background-color: lightgray;
        }

        .bold {
            font-weight: bold;
        }

        /* Ensure the barcode container is centered */
        .barcode-container {
            display: flex;
            justify-content: center; /* Centers horizontally */
            align-items: center; /* Centers vertically (if needed) */
            margin-top: 20px;
            width: 100%;
        }

        /* Make sure barcode itself is sized and centered properly */
        .barcode {
            text-align: center;
        }

    </style>

</head>

<body>

    <table>
        <tr>
            <td colspan="2" align="center">
                <h2>SmartOne Lib</h2>
                <h3>Bukti Tanda Reservasi Peminjaman Buku</h3>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td><strong>Kode Anggota:</strong></td>
            <td>{{ $anggota->kode_anggota }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Anggota:</strong></td>
            <td>{{ $anggota->jenisAnggota->jenis_anggota }}</td>
        </tr>
        <tr>
            <td><strong>Nama Anggota:</strong></td>
            <td>{{ $anggota->nama_anggota }}</td>
        </tr>
        <tr>
            <td><strong>Kode Transaksi:</strong></td>
            <td>{{ $hashedKodeTransaksi }}</td>
        </tr>
    </table>

    <br />

    <table>
        <tr>
            <th>No</th>
            <th>Detail</th>
            <th>Information</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Nama Pustaka</td>
            <td>{{ $transaksi->pustaka->judul_pustaka }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Tanggal Pinjam</td>
            <td>{{ $transaksi->tgl_pinjam }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Tanggal Kembali</td>
            <td>{{ $transaksi->tgl_kembali }}</td>
        </tr>
    </table>

    <!-- Barcode Section: Flexbox for centering -->
    {{-- <div class="barcode-container">
        <div class="barcode">
            {!! $barcode !!}
        </div>
    </div> --}}

    <div class="footer">
        <p>Thank you for using SmartOne Library!</p>
    </div>

</body>

</html>
