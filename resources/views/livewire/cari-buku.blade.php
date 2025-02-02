
<div class="grid grid-cols-12 gap-6">
    <!-- Sidebar -->
    <aside class="col-span-3 bg-white p-4 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Filter DDC</h3>
        <div class="flex flex-col gap-2">
            @foreach($ddcOptions as $key => $ddc)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="selectedDdc" value="{{ $key }}" class="hidden peer">
                    <span class="py-2 px-4 rounded-lg shadow-md bg-slate-200 text-black hover:bg-slate-600 hover:text-white cursor-pointer peer-checked:bg-slate-600 peer-checked:text-white transition">{{ $ddc }}</span>
                </label>
            @endforeach
        </div>

        <h3 class="text-lg font-semibold mt-6 mb-4">Filter Format</h3>
        <div class="flex flex-col gap-2">
            @foreach($formatOptions as $key => $format)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="selectedFormat" value="{{ $key }}" class="hidden peer">
                    <span class="py-2 px-4 rounded-lg shadow-md bg-slate-200 text-black hover:bg-slate-600 hover:text-white cursor-pointer peer-checked:bg-slate-600 peer-checked:text-white transition">{{ $format }}</span>
                </label>
            @endforeach
        </div>
    </aside>

    <!-- Buku -->
    <section class="col-span-9">
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-6">
            @forelse($buku as $b)
                <div class="relative bg-white shadow-lg border border-slate-200 rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                    <img src="{{ asset('storage/' . $b->gambar) }}" alt="Buku {{ $b->judul_pustaka }}" class="w-full h-48 object-cover">
                </div>
            @empty
                <div class="col-span-3 text-center py-4">
                    <p class="text-gray-500">Tidak ada hasil ditemukan.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>