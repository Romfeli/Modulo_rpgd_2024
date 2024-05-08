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

    // Find the checkbox in the loaded array that matches the given ID.
    $checkbox = $this->checkboxs->firstWhere('id', $id);

    if ($checkbox) {
        // Update the checkbox with the data from the form.
        $checkbox->title = $checkbox['title'];
        $checkbox->content = $checkbox['content'];
        $checkbox->save();

        session()->flash('success', 'Checkbox actualizado con éxito.');

        // Emit an update event after the update
        $this->dispatch('checkboxUpdated');
    } else {
        session()->flash('error', 'Checkbox no encontrado.');
    }
}

    public function render()
    {
        return view('livewire.checkboxs');
    }
}
