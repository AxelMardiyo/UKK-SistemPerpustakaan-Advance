<?php

namespace App\Livewire;

use App\Models\DDC;
use Livewire\Component;

class DdcCards extends Component
{
    public function render()
    {
        $ddcs = DDC::all(); // Ambil data DDC dari database
        return view('livewire.ddc-cards', compact('ddcs'));
    }
}
