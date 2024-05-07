<?php
// app/Livewire/Checkboxs.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Checkbox;

class CheckBoxs extends Component
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

    // Encuentra el checkbox por su ID
    $checkbox = CheckBox::findOrFail($id);

    // Actualiza el checkbox con los datos del formulario
    // Utiliza el índice correcto basado en el ID proporcionado
    $checkbox->title = $this->checkboxs[$id -1]['title'];
    $checkbox->content = $this->checkboxs[$id -1 ]['content'];
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
