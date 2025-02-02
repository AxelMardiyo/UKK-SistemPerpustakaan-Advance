<div class="w-3/4 items-center mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card 1: Jumlah Anggota -->
    <div class="bg-white shadow-md rounded-lg p-6 text-start" data-aos="flip-up" data-aos-duration="1000">
        <div class="flex gap-3 items-center">
            <!-- Icon dengan warna biru -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-14 text-blue-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <div>
                <p class="text-4xl font-bold text-indigo-600">{{ $anggotaCount }}</p>
                <h3 class="text-xl font-semibold text-gray-700">Jumlah Anggota</h3>
            </div>
        </div>
    </div>
    
    <!-- Card 2: Jumlah Pustaka -->
    <div class="bg-white shadow-md rounded-lg p-6 text-start" data-aos="flip-down" data-aos-duration="1000">
        <div class="flex gap-3 items-center">
            <!-- Icon dengan warna hijau -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-14 text-green-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <div>
                <p class="text-4xl font-bold text-indigo-600">{{ $pustakaCount }}</p>
                <h3 class="text-xl font-semibold text-gray-700">Jumlah Pustaka</h3>
            </div>
        </div>
    </div>
    
    <!-- Card 3: Jumlah Transaksi -->
    <div class="bg-white shadow-md rounded-lg p-6 text-start" data-aos="flip-up" data-aos-duration="1000">
        <div class="flex gap-3 items-center">
            <!-- Icon dengan warna merah -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-14 text-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
            </svg>
            <div>
                <p class="text-4xl font-bold text-indigo-600">{{ $transaksiCount }}</p>
                <h3 class="text-xl font-semibold text-gray-700">Jumlah Transaksi</h3>
            </div>
        </div>
    </div>
</div>
