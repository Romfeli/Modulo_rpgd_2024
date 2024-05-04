<?php

namespace App\Livewire;

use App\Models\Participante;
use Livewire\Component;

class ListaParticipantes extends Component
{
    public $mostrarLista = false;
    public $participantes;

    public function toggleMostrarLista()
    {
        $this->mostrarLista = !$this->mostrarLista;
        if ($this->mostrarLista) {
            $this->participantes = Participante::all();
        } else {
            $this->participantes = [];
        }
    }

    public function render()
    {
        return view('livewire.lista-participantes');
    }
}

