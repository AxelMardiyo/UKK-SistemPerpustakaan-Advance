<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SmartOne E-Library')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@500;700&display=swap"
        rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="bg-slate-100">
    <header id="navbar"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-white md:bg-transparent">
        <nav class="flex justify-between items-center w-[92%] mx-auto py-4">
            <a href="{{ route('home') }}">
                <div id="logo" class="text-2xl font-bold text-slate-800">
                    SmartOne | DigiLib
                </div>
            </a>

            {{-- Jika login --}}
            @auth
                <div class="relative">
                    <button id="dropdownButton"
                        class="bg-slate-700 text-white px-5 py-2 rounded-full hover:bg-slate-600 transition-all flex items-center gap-2">
                        {{ Auth::user()->nama_anggota }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownMenu" class="absolute right-0 mt-2 bg-white rounded-lg shadow-lg w-48 hidden">
                        <a href="{{ route('digilib.transaksi') }}"
                            class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100">Transaksi</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            {{-- Jika belum login --}}
            @guest
                <a href="{{ route('login') }}"
                    class="bg-slate-700 text-white px-5 py-2 rounded-full hover:bg-slate-600 transition-all">
                    Sign in
                </a>
            @endguest

            <svg onclick="onToggleMenu(this)" name="menu" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-8 h-8 cursor-pointer md:hidden text-slate-800">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </nav>
    </header>


    <!-- Main Content -->
    <main class="">
        @yield('content')
        
    </main>

    <!-- Footer -->
    <footer class="bg-slate-800 text-white py-8">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center md:items-start gap-8">
            <!-- Logo dan Deskripsi -->
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h3 class="text-3xl mb-3 font-bold">SmartOne Lib</h3>
                <h3 class="text-xl font-bold">SMK Antartika 1 Sidoarjo</h3>
                <p class="text-sm text-gray-300 mt-2">
                    Membentuk generasi unggul dengan keterampilan dan pengetahuan yang siap menghadapi dunia kerja dan
                    era digital.
                </p>
            </div>

            <!-- Detail Kontak -->
            <div class="w-full md:w-1/2 text-sm space-y-2">
                <h3 class="text-lg font-bold mb-2">Kontak Kami</h3>
                <p><strong>Alamat:</strong> Jalan Raya Siwalan Panji, Bedrek, Siwalanpanji, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61252</p>
                <p><strong>Telepon:</strong> (031) 123-4567</p>
                <p><strong>Email:</strong> info@smkantartika1.sch.id</p>
                <p><strong>Jam Operasional:</strong> Senin - Jumat, 08:00 - 16:00</p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 text-center border-t border-gray-600 pt-4 text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} SmartOne E-Library. All rights reserved.</p>
        </div>
    </footer>

    @livewireScripts
    <script>
        // Ambil elemen-elemen yang dibutuhkan
        const navLinks = document.querySelector('.nav-links');
        const navbar = document.getElementById('navbar');
        const logo = document.getElementById('logo');
        const toggleIcon = document.querySelector('[onclick="onToggleMenu(this)"]');

        // Fungsi toggle menu
        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu';
            navLinks.classList.toggle('hidden');
            if (window.innerWidth < 768) {
                logo.classList.toggle('hidden');
            }
        }

        // Efek scroll pada navbar
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50 && window.innerWidth >= 768) {
                navbar.classList.remove('md:bg-transparent', 'text-white');
                navbar.classList.add('bg-white', 'shadow-lg', 'text-black');
            } else if (window.innerWidth >= 768) {
                navbar.classList.remove('bg-white', 'shadow-lg', 'text-black');
                navbar.classList.add('md:bg-transparent', 'text-white');
            }
        });

        // Reset menu dan logo saat resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                navLinks.classList.remove('hidden');
                logo.classList.remove('hidden');
                toggleIcon.name = 'menu';
            } else {
                navLinks.classList.add('hidden');
            }
        });
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton?.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Tutup dropdown jika klik di luar
        document.addEventListener('click', (e) => {
            if (!dropdownButton?.contains(e.target) && !dropdownMenu?.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
        
    </script>
</body>

</html>
