<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Participante;

class DashboardLista extends Component
{
    public function render()
    {
        $participantes = Participante::whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.dashboard-lista', ['participantes' => $participantes]);
    }
}
