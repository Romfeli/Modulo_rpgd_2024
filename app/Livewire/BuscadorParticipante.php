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
        $campoBusqueda = '';
        if ($this->searchBy === 'dni') {
            $campoBusqueda = 'dni';
        } elseif ($this->searchBy === 'name_and_last_name') {
            $campoBusqueda = 'name_and_last_name';
        } elseif ($this->searchBy === 'email') {
            $campoBusqueda = 'email';
        } elseif ($this->searchBy === 'phone_number') {
            $campoBusqueda = 'phone_number';
        }

        // Realizar la búsqueda de participantes según el término de búsqueda y el campo seleccionado
        $participantes = Participante::where($campoBusqueda, 'like', '%'.$this->search.'%')->get();
        
        // Devolver la vista con los datos de los participantes
        return view('livewire.buscador-participante', [
            'participantes' => $participantes,
        ]);
    }
}