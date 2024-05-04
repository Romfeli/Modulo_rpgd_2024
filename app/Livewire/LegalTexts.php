<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LegalText;

class LegalTexts extends Component
{
    public $legaltexts;

    protected $rules = [
        'legaltexts.*.title' => 'required|max:255',
        'legaltexts.*.content' => 'required',
    ];

    public function mount()
    {
        $this->legaltexts = LegalText::all();
    }

    public function updateLegaltext($id)
    {
        $this->validate();

        $legaltext = LegalText::findOrFail($id);

        // Update the legal text with the form data
        $legaltext->title = $this->legaltexts[$id == 0]['title']; // Adjust index to match array index
        $legaltext->content = $this->legaltexts[$id == 0]['content']; // Adjust index to match array index
        $legaltext->save();

        // Flash success message
        session()->flash('success', 'Texto legal actualizado con éxito.');

        // Emit an event after the update
        $this->dispatch('updateLegaltext');
    }

    public function render()
    {
        return view('livewire.legal-texts'); // Correct view name
    }
}
