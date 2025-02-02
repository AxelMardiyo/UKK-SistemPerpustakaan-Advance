<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SmartOne E-Library</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full m-5 max-w-2xl">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Register for SmartOne Lib</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="nama_anggota" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                <input type="text" id="nama_anggota" name="nama_anggota" required maxlength="100"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="tempat" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" id="tempat" name="tempat" required maxlength="20"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" required
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" id="alamat" name="alamat" required maxlength="50"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telepon</label>
                <input type="text" id="no_telp" name="no_telp" required maxlength="15"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required maxlength="30"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="tgl_daftar" class="block text-sm font-medium text-gray-700">Tanggal Daftar</label>
                <input type="date" id="tgl_daftar" name="tgl_daftar"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300"
                    value="{{ date('Y-m-d') }}" disabled>
            </div>

            <div>
                <label for="masa_aktif" class="block text-sm font-medium text-gray-700">Masa Aktif</label>
                <input type="date" id="masa_aktif" name="masa_aktif" required
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="id_jenis_anggota" class="block text-sm font-medium text-gray-700">Jenis Anggota</label>
                <select id="id_jenis_anggota" name="id_jenis_anggota" required
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
                    <option value="">Pilih Jenis Anggota</option>
                    @foreach ($jenisAnggota as $jenis)
                        <option value="{{ $jenis->id_jenis_anggota }}">{{ $jenis->jenis_anggota }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" required maxlength="50"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required maxlength="50"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300">
                Register
            </button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Login</a>
        </p>
    </div>

</body>

</html>
