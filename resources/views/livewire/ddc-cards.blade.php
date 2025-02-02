<div class="mt-5">
    {{-- <p class="text-indigo-500 font-semibold text-center" data-aos="fade-up" data-aos-duration="1000">DDC</p>
    <h1 class="text-4xl font-bold text-center" data-aos="fade-up" data-aos-duration="1000">Daftar DDC</h1> --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8 mt-4 px-5 container mx-auto">
        
        @foreach($ddcs as $ddc)
        <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <h3 class="text-xl font-semibold text-slate-800">{{ $ddc->kode_ddc }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ $ddc->ddc }}</p>
        </div>
        @endforeach
    </div>
</div>
