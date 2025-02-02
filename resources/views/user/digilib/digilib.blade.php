@extends('user.digilib.layouts')

@section('content')
    <section class="banner relative h-screen py-20 bg-indigo-100 flex items-center justify-center" id="beranda"
        style="background: url('{{ asset('img/wave1.svg') }}') no-repeat bottom; background-size: cover; background-attachment: fixed;">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center gap-10 lg:flex-row">
                {{-- Content --}}
                <div class="w-full space-y-4 text-center lg:w-1/2 lg:text-left ps-4 lg:px-10" data-aos="fade-up"
                    data-aos-duration="1500">
                    <h1 class="text-5xl font-bold text-slate-800 leading-tight">
                        Selamat Datang di <br>
                        <span class="text-indigo-600">DigiLib - Perpustakaan Digital</span>
                    </h1>
                    <p class="text-2xl text-slate-600">
                        SMK Antartika 1 Sidoarjo <br>
                    </p>
                    <p class="text-xl text-slate-600">
                        Jl. Siwalanpanji, Kec. Buduran Sidoarjo, Indonesia
                    </p>
                    <a href="#buku"
                        class="inline-block px-6 py-3 text-white bg-indigo-600 rounded-sm shadow-md ring-2 ring-indigo-400 hover:bg-indigo-500 transition-all">
                        Jelajahi Koleksi
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                {{-- Image --}}
                <div class="w-full lg:w-1/2" data-aos="zoom-in-left" data-aos-duration="1500">
                    <img src="{{ asset('img/frontend/rb_2149341898.png') }}" class="w-4/5" alt="Perpustakaan Digital" />
                </div>
            </div>
        </div>
    </section>


    <livewire:ddc-cards />
    <livewire:book-filter />

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
                confirmButtonText: 'OK'
            });
        @endif
    </script>

        {{-- @foreach ($pustaka as $book)
            <a href="" class="group">
                <div class="bg-white p-3 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('storage/' . $book->gambar) }}" alt="Cover Buku"
                        class="w-full h-64 object-cover rounded-md mb-1 group-hover:opacity-90 transition-opacity duration-300">
                    <h3
                        class="text-xl font-semibold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300">
                        {{ $book->judul_pustaka }}</h3>
                    <p class="text-sm text-slate-600 mt-1 group-hover:text-slate-800 transition-colors duration-300">
                        {{ Str::limit($book->abstraksi, 100) }}</p>
                </div>
            </a>
            <a href="" class="group">
                <div class="bg-white p-3 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('storage/' . $book->gambar) }}" alt="Cover Buku"
                        class="w-full h-64 object-cover rounded-md mb-1 group-hover:opacity-90 transition-opacity duration-300">
                    <h3
                        class="text-xl font-semibold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300">
                        {{ $book->judul_pustaka }}</h3>
                    <p class="text-sm text-slate-600 mt-1 group-hover:text-slate-800 transition-colors duration-300">
                        {{ Str::limit($book->abstraksi, 100) }}</p>
                </div>
            </a>
            <a href="" class="group">
                <div class="bg-white p-3 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('storage/' . $book->gambar) }}" alt="Cover Buku"
                        class="w-full h-64 object-cover rounded-md mb-1 group-hover:opacity-90 transition-opacity duration-300">
                    <h3
                        class="text-xl font-semibold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300">
                        {{ $book->judul_pustaka }}</h3>
                    <p class="text-sm text-slate-600 mt-1 group-hover:text-slate-800 transition-colors duration-300">
                        {{ Str::limit($book->abstraksi, 100) }}</p>
                </div>
            </a>
        @endforeach --}}
    
@endsection
