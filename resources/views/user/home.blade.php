    @extends('user.layouts')

    @section('content')
    {{-- banner --}}
    <section class="banner relative py-20 bg-indigo-100 h-screen flex items-center justify-center" id="beranda" style="background: url('{{ asset('img/wave.svg') }}') no-repeat bottom; background-size: cover; background-attachment: fixed;">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center gap-10 lg:flex-row">
                {{-- Content --}}
                <div class="w-full space-y-4 text-center lg:w-1/2 lg:text-left ps-4 lg:px-10" data-aos="fade-up" data-aos-duration="1500">
                    <h1 class="text-5xl font-bold text-slate-800 leading-tight">
                        Selamat Datang di Portal <br>
                        <span class="text-indigo-600">Perpustakaan Digital</span>
                    </h1>
                    <p class="text-2xl text-slate-600">
                        SMK Antartika 1 Sidoarjo <br>
                    </p>
                    <p class="text-xl text-slate-600">
                        Jl. Siwalanpanji, Kec. Buduran Sidoarjo, Indonesia
                    </p>
                    <a href="#explore" class="inline-block px-6 py-3 text-white bg-indigo-600 rounded-sm shadow-md ring-2 ring-indigo-400 hover:bg-indigo-500 transition-all">
                        Jelajahi Koleksi
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                {{-- Image --}}
                <div class="w-full lg:w-1/2" data-aos="zoom-in-left" data-aos-duration="1500">
                    <img
                        src="{{ asset('img/frontend/rb_2149341898.png') }}"
                        class="w-4/5"
                        alt="Perpustakaan Digital"
                    />
                </div>
            </div>
        </div>
    </section>

    {{-- about --}}
    <section class="about py-20 bg-white" id="tentang">
        <div class="container mx-auto px-10 py" data-aos="fade-up" data-aos-duration="1000">
            <p class="text-indigo-500 font-semibold text-center" data-aos="fade-up" data-aos-duration="1000">TENTANG</p>
            <h1 class="text-4xl font-bold text-center mt-5" data-aos="fade-up" data-aos-duration="1000">Tentang Kami</h1>
            <div class="flex flex-col-reverse lg:flex-row mx-10 mt-8 items-center gap-10 bg-indigo-200">
                <!-- Text -->
                <div class="w-full lg:w-1/2 space-y-6 px-10">
                    <h2 class="text-4xl font-bold text-gray-800">
                        Tentang Kami
                    </h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Perpustakaan Digital SMK Antartika 1 Sidoarjo hadir untuk memfasilitasi siswa dan guru dalam mengakses berbagai koleksi buku digital secara mudah dan cepat. Kami berkomitmen untuk meningkatkan minat baca dan mendukung pembelajaran berbasis teknologi.
                    </p>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Akses Koleksi Buku Lengkap
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Kemudahan Peminjaman Digital
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Dukungan Pembelajaran Interaktif
                        </li>
                    </ul>
                </div>

                <!-- Image -->
                <div class="w-full lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden shadow-lg">
                        <img 
                            src="{{ asset('img/frontend/perpustakaan.webp') }}" 
                            alt="Tentang Kami" 
                            class="w-full h-full object-cover"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- stats --}}
    <section class="py-10">
        <div class="container mx-auto px-6">
            @livewire('home-cards')
        </div>
    </section>

    {{-- Layanan --}}
    <section class="py-10" id="layanan">
        <div class="container mx-auto px-6">
            <p class="text-indigo-500 font-semibold text-center" data-aos="fade-up" data-aos-duration="1000">LAYANAN PERPUSTAKAAN</p>
            <h1 class="text-4xl font-bold text-center mt-5" data-aos="fade-up" data-aos-duration="1000">Nikmati Layanan Perpustakaan SMK Antartika 1 Sidoarjo</h1>
            <div class="w-full items-center mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 mt-8 px-10">
                <!-- Layanan 1 -->
                <div class="rounded-md shadow-lg p-6 bg-white border-b-indigo-500 border-b-4 text-center transition-all duration-300 hover:bg-indigo-100 group" data-aos="zoom-in-up" data-aos-duration="1500" style="box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2);">
                    <div class="logo rounded-full mx-auto p-5 w-16 h-16 flex items-center justify-center transition-all duration-300 group-hover:bg-white bg-indigo-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-indigo-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                    </div>
                    <div class="px-5">
                        <h3 class="text-lg font-semibold mt-4">Peminjaman Buku</h3>
                        <p class="text-gray-600 mt-2">Nikmati kemudahan meminjam buku dengan proses cepat dan praktis.</p>
                        <a href="#" class="text-indigo-500 font-semibold mt-4 block">Selengkapnya</a>
                    </div>
                </div>

                <!-- Layanan 2 -->
                <div class="rounded-md shadow-lg p-6 bg-white border-b-green-500 border-b-4 text-center transition-all duration-300 hover:bg-green-100 group" data-aos="zoom-in-up" data-aos-duration="1500" style="box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2);">
                    <div class="logo rounded-full mx-auto p-5  w-16 h-16 flex items-center justify-center transition-all duration-300 group-hover:bg-white bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mt-4">Layanan E-Book</h3>
                    <div class="px-5">
                        <p class="text-gray-600 mt-2">Akses koleksi e-book terkini untuk menunjang kebutuhan belajar.</p>
                        <a href="#" class="text-green-500 font-semibold mt-4 block">Selengkapnya</a>
                    </div>
                </div>

                <!-- Layanan 3 -->
                <div class="rounded-md shadow-lg p-6 bg-white border-b-yellow-500 border-b-4 text-center transition-all duration-300 hover:bg-yellow-100 group" data-aos="zoom-in-up" data-aos-duration="1500" style="box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2);">
                    <div class="logo rounded-full mx-auto p-5 b w-16 h-16 flex items-center justify-center transition-all duration-300 group-hover:bg-white bg-yellow-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-yellow-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c-4.97 0-9-4.03-9-9 0-4.97 4.03-9 9-9 4.97 0 9 4.03 9 9 0 4.97-4.03 9-9 9ZM12 15.75V12m0-4.5h.007v.008H12V7.5Z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mt-4">Konsultasi Literasi</h3>
                    <div class="px-5">
                        <p class="text-gray-600 mt-2">Dapatkan panduan dan bantuan terkait sumber bacaan yang Anda butuhkan.</p>
                        <a href="#" class="text-yellow-500 font-semibold mt-4 block">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kontak --}}
    <section class="py-20 bg-gray-100" id="kontak">
        <div class="container mx-auto px-10">
            <p class="text-indigo-500 font-semibold text-center" data-aos="fade-up" data-aos-duration="1000">KONTAK</p>
            <h1 class="text-4xl font-bold text-center mt-5" data-aos="fade-up" data-aos-duration="1000">Hubungi Kami</h1>
            <div class="flex flex-col lg:flex-row items-center gap-10 mt-8">
                <!-- Google Maps -->
                <div class="w-full lg:w-1/2 flex-grow">
                    <div class="h-full rounded-lg overflow-hidden shadow-lg">
                        <iframe
                            src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=smk%20antartika%201%20sidoarjo+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            height="435"
                            class="w-full" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>

                <!-- Form Kontak -->
                <div class="w-full lg:w-1/2 bg-white p-8 rounded-lg shadow-lg flex-grow">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Hubungi Kami</h2>
                    <form action="" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea id="pesan" name="pesan" rows="4" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-500 transition-all">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>








    @endsection
