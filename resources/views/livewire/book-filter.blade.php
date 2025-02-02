<section class="daftarBuku my-10" id="buku">
    <p class="text-indigo-500 font-semibold text-center">BUKU</p>
    <h1 class="text-4xl font-bold text-center mb-8">Daftar Buku</h1>

    <div class="flex container mx-auto">
        <!-- Sidebar Filter -->
        <div class="w-1/4 bg-white p-6 ms-5 shadow-lg rounded-md h-full max-h-screen overflow-y-auto">
            <h3 class="text-2xl font-bold  mb-8">Filter Buku</h3>

            <!-- Search Filter -->
            <div class="mb-6">
                <label for="search" class="block text-xl font-semibold text-gray-700">Cari Judul</label>
                <input type="text" id="search" wire:model.live="search"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                    placeholder="Cari...">
            </div>

            <!-- Format Filter (Multiple Checkbox) -->
            <div class="mb-6">
                <label class="block text-xl font-semibold text-gray-700">Format</label>
                <div class="space-y-4 mt-2">
                    @foreach ($formats as $key => $format)
                        <label
                            class="flex items-center space-x-3 cursor-pointer rounded-md transition-all duration-300">
                            <input type="checkbox" wire:model.live="selectedFormat" value="{{ $key }}"
                                class="hidden peer">
                            <span
                                class="py-2 px-4 rounded-lg shadow-md bg-slate-200 text-black peer-checked:bg-indigo-500 peer-checked:text-white peer-hover:bg-indigo-100 peer-hover:text-indigo-600 transition duration-300">
                                {{ $format }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-xl font-semibold text-gray-700">DDC</label>
                <div class="space-y-4 mt-2">
                    @foreach ($ddcs as $key => $ddc)
                        <label
                            class="flex items-center space-x-3 cursor-pointer rounded-md transition-all duration-300">
                            <input type="checkbox" wire:model.live="selectedDDC" value="{{ $key }}"
                                class="hidden peer">
                            <span
                                class="py-2 px-4 rounded-lg shadow-md bg-slate-200 text-black peer-checked:bg-indigo-500 peer-checked:text-white peer-hover:bg-indigo-100 peer-hover:text-indigo-600 transition duration-300">
                                {{ $ddc }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Daftar Buku -->
        <div class="w-3/4 ml-8">
            <!-- Daftar Buku -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8 mx-auto px-5 container">
                @forelse ($pustaka as $book)
                    <a href="{{ route('digilib.show', $book->id_pustaka) }}" class="group">
                        <div
                            class="bg-white p-3 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                            <img src="{{ asset('storage/' . $book->gambar) }}" alt="Cover Buku"
                                class="w-full h-64 object-cover rounded-md mb-1 group-hover:opacity-90 transition-opacity duration-300">
                            <h3
                                class="text-xl font-semibold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300">
                                {{ $book->judul_pustaka }}</h3>
                            <p
                                class="text-sm text-slate-600 mt-1 group-hover:text-slate-800 transition-colors duration-300">
                                {{ Str::limit($book->abstraksi, 100) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-xl font-semibold col-span-4 text-gray-500 w-full">Tidak ada buku yang
                        tersedia saat ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
