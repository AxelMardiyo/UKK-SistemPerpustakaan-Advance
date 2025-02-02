<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 10px;
        }
        .card {
            width: 85.6mm;
            height: 54mm;
            border: 1px solid #000;
            margin: 5px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }
        .card-header {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 5px;
            font-size: 12px;
        }
        .card-body {
            padding: 10px;
            display: flex;
            flex-direction: row;
            gap: 10px;
        }
        .card-body img {
            width: 40mm;
            height: 40mm;
            object-fit: cover;
            border-radius: 5px;
        }
        .card-info {
            font-size: 10px;
            line-height: 1.4;
        }
        .card-info h4 {
            margin: 0;
            font-size: 12px;
            font-weight: bold;
        }
        .footer {
            position: absolute;
            bottom: 5px;
            left: 10px;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <div class="card-container">
        @foreach ($members as $member)
        <div class="card">
            <!-- Header -->
            <div class="card-header">
                <strong>PERPUSTAKAAN SMK ANTARTIKA</strong>
            </div>
            <!-- Body -->
            <div class="card-body">
                <!-- Foto -->
                <img src="{{ asset('storage/' . $member->foto) }}" alt="Foto Anggota" style="width: 40mm; height: 40mm; object-fit: cover; border-radius: 5px;">
                <!-- Info -->
                <div class="card-info">
                    <h4>{{ $member->nama_anggota }}</h4>
                    <p>ID: {{ $member->id_anggota }}</p>
                    <p>Kode: {{ $member->kode_anggota }}</p>
                    <p>Masa Aktif: {{ \Carbon\Carbon::parse($member->masa_aktif)->format('d-m-Y') }}</p>
                </div>
            </div>
            <!-- Footer -->
            <div class="footer">
                <em>{{ $member->keterangan }}</em>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
