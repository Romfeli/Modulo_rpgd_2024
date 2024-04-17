<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Participante;

class AgregarFormulario extends Component
{
    public $dni;
    public $name_and_last_name;
    public $email;
    public $phone_number;
    public $signatureBase64;
    public $successMessage;
    public $showForm = false; 

    protected $rules = [
        'dni' => 'required|digits:8',
        'name_and_last_name' => 'required|string',
        'email' => 'required|email',
        'phone_number' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.agregar-formulario');
    }

    public function validateDni()
    {
        $this->validate(['dni' => 'required|digits:8']);
        $this->showForm = true;
    }

    public function saveData()
    {
        $validatedData = $this->validate();

        // Guardar datos en la base de datos
        Participante::create($validatedData);

        // Reiniciar el formulario y mostrar mensaje de éxito
        $this->resetForm();
        $this->successMessage = 'Los datos se han guardado correctamente.';
    }

    public function resetForm()
    {
        $this->reset(['dni', 'name_and_last_name', 'email', 'phone_number', 'signatureBase64']);
    }
}
