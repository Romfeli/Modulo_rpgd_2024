<?php
// app/Livewire/Checkboxs.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Checkbox;

class Checkboxs extends Component
{
    public $checkboxs;

    protected $rules = [
        'checkboxs.*.title' => 'required|max:255',
        'checkboxs.*.content' => 'required',
    ];

    public function mount()
    {
        $this->checkboxs = Checkbox::all();
    }

    public function updateCheckboxs($id)
    {
        $this->validate();

        $checkbox = Checkbox::findOrFail($id);

        // Actualizar los campos en el modelo Checkbox con los datos del formulario
        $checkbox->title = $this->checkboxs[0]['title'];
        $checkbox->content = $this->checkboxs[0]['content'];
        $checkbox->save();

        session()->flash('success', 'Checkbox actualizado con éxito.');

        // Emitir un evento de actualización después de la actualización
        $this->dispatch('checkboxUpdated');
    }

    public function render()
    {
        return view('livewire.checkboxs');
    }
}
