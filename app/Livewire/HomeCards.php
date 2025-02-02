<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Pustaka;
use App\Models\Transaksi;

class HomeCards extends Component
{
    public $anggotaCount;
    public $pustakaCount;
    public $transaksiCount;

    public function mount()
    {
        // Hitung data dinamis
        $this->anggotaCount = Anggota::count();
        $this->pustakaCount = Pustaka::count();
        $this->transaksiCount = Transaksi::count();
    }

    public function render()
    {
        return view('livewire.home-cards');
    }
}
