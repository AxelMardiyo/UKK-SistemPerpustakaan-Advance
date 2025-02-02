<?php

namespace App\Livewire;

use App\Models\DDC;
use App\Models\Format;
use App\Models\Pustaka;
use Livewire\Component;

class BookFilter extends Component
{
    public $search = '';
    public $allBuku;
    public $formats = [];  // Array untuk format
    public $ddcs = [];     // Array untuk ddc
    public $selectedFormat = [];  // Array untuk format yang dipilih
    public $selectedDDC = [];     // Array untuk ddc yang dipilih

    public function mount() {
        $this->allBuku = Pustaka::all();
        $this->ddcs = DDC::pluck('ddc', 'id_ddc')->toArray();
        $this->formats = Format::pluck('format', 'id_format')->toArray();
    }

    public function render()
    {

        $pustaka = Pustaka::query()
            ->when($this->search, function ($query) {
                return $query->where('judul_pustaka', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedFormat, function ($query) {
                return $query->whereIn('id_format', $this->selectedFormat);
            })
            ->when($this->selectedDDC, function ($query) {
                return $query->whereIn('id_ddc', $this->selectedDDC);
            }) // Mengambil relasi format dan ddc
            ->get();

        return view('livewire.book-filter', compact('pustaka'));
    }
}
