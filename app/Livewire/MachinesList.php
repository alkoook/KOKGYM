<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Machine;

class MachinesList extends Component
{
    public function render()
    {
        return view('livewire.machines-list', [
            'machines' => Machine::orderBy('id', 'desc')->get(),
        ]);
    }
}
