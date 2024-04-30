<?php

namespace App\Livewire;
use App\Models\Participante;
use Livewire\Component;

class TableroInicio extends Component
{
    public $participantes;

    public function mount()
    {
        // Obtener la lista de participantes desde la base de datos u otro origen
        $this->participantes = Participante::all(); 
    }

    public function render()
    {
        return view('livewire.tablero-inicio');
    }
}
