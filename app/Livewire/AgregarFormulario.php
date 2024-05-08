<?php

namespace App\Livewire;

use App\Models\Checkbox;
use App\Models\LegalText;
use App\Models\Participante;
use Illuminate\Http\Request;
use Livewire\Component;

class AgregarFormulario extends Component
{
    public $dni;
    public $name_and_last_name;
    public $email;
    public $phone_number;
    public $signatureBase64;
    public $firstCheckbox= '';
    public $lastCheckbox= '';
    public $firstCheckboxChecked = '';
    public $lastCheckboxChecked = '';
    
    public $successMessage = '';

    public $showForm2 = false;
    public $showForm = false;

    public $legalText;
    
    protected $listeners = ['saveData' => 'saveData'];

    protected $rules = [
        'dni' => 'required|digits:8',
        'name_and_last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:participantes,email',
        'phone_number' => 'required|regex:/^\+?\d+$/',
        'firstCheckboxChecked' => 'accepted',
        'lastCheckboxChecked' => 'accepted',
        'signatureBase64' => 'required',

    ];
    
    public function mount()
{
    $this->firstCheckbox = Checkbox::first(); 
    $this->lastCheckbox = Checkbox::latest()->first();
    $this->legalText = LegalText::first();

    $this->firstCheckboxChecked = true;
    $this->lastCheckboxChecked = true;


}


    public function validateDni()
    {
        $this->validate([
            'dni' => 'required|digits:8',
        ]);

        $participante = Participante::where('dni', $this->dni)->latest()->first();

        $this->showForm = true;

        if ($participante) {
            $this->name_and_last_name = $participante->name_and_last_name;
            $this->email = $participante->email;
            $this->phone_number = $participante->phone_number;
        }
    }

    public function saveData()
{
    $validatedData = $this->validate(); // Asegúrate de que todos los campos estén validados

    try {
        Participante::create([
            'dni' => $this->dni,
            'name_and_last_name' => $this->name_and_last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'signatureBase64' => $this->signatureBase64, // Asegúrate de que este campo coincida con tu base de datos
            'firstCheckboxChecked' => $this->firstCheckboxChecked,
            'lastCheckboxChecked' => $this->lastCheckboxChecked,

       
        ]);
        $this->successMessage = 'Participante agregado correctamente!!';
        \Log::info('Dispatching data-saved event');
        $this->dispatch('data-saved'); // Make sure this is being called
        $this->resetForm();

    } catch (\Exception $e) {
        \Log::error('Error al guardar los datos: ' . $e->getMessage());
        $this->addError('saveError', 'Error al guardar los datos.'); // Use Livewire's error handling
        $this->dispatch('data-save-failed');
    }
}

    



    public function resetForm()
    {
        $this->dni = '';
        $this->name_and_last_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->signatureBase64 = '';

        $this->showForm = false;
    }

    public function showFormulario()
    {
        $this->resetForm();
        $this->showForm2 = !$this->showForm2; // Invert the value of $showForm2
    }

   

    public function render()
    {
        return view('livewire.agregar-formulario')->layout('layouts.app');
    }
}
