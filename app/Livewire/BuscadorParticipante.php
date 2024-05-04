<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Participante;

class BuscadorParticipante extends Component
{
    public $search = '';
    public $searchBy = 'dni';

    public function render()
    {
        // Determinar el campo por el cual buscar
        $campoBusqueda = $this->searchBy;

        // Realizar la búsqueda de participantes según el término de búsqueda y el campo seleccionado
        $participantes = Participante::where($campoBusqueda, 'like', '%'.$this->search.'%')->get();
        
        // Devolver la vista con los datos de los participantes
        return view('livewire.buscador-participante', [
            'participantes' => $participantes,
        ]);
    }
}
