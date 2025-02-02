<?php 
namespace App\Livewire;

use App\Models\DDC;
use App\Models\Format;
use App\Models\Pustaka;
use Livewire\Component;

class CariBuku extends Component
{
    public $search = '';
    public $allBuku;
    public $selectedDdc = []; // Array untuk menyimpan pilihan ID DDC
    public $ddcOptions = [];
    public $selectedFormat = [];
    public $formatOptions = [];

    public function mount()
    {
        $this->allBuku = Pustaka::all();
        // $this->ddcOptions = Pustaka::with('ddc')
        //     ->select('id_ddc')
        //     ->distinct()
        //     ->get()
        //     ->mapWithKeys(function ($item) {
        //         return [$item->id_ddc => $item->ddc->ddc];
        //     });
        $this->ddcOptions = DDC::pluck('ddc', 'id_ddc')->toArray();
        // $this->formatOptions = Pustaka::with('format')
        //     ->select('id_format')
        //     ->distinct()
        //     ->get()
        //     ->mapWithKeys(function ($item) {
        //         return [$item->id_format => $item->format->format];
        //     });
        $this->formatOptions = Format::pluck('format', 'id_format')->toArray();
        // dd($this->formatOptions);
    }

    public function render()
    {
        $buku = Pustaka::query()
            ->when($this->search, function($query) {
                $query->where('judul_pustaka', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedDdc, function($query) {
                $query->whereIn('id_ddc', $this->selectedDdc);
            })
            ->when($this->selectedFormat, function($query) {
                $query->whereIn('id_format', $this->selectedFormat);
            })
            ->get();

        return view('livewire.cari-buku', compact('buku'));
    }
}
