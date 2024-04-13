<?php

namespace App\Livewire;
use Illuminate\Http\Request;

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
    public $showForm = false; // Define y asigna un valor inicial a $showForm

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

    public function toggleSignatureSection()
    {
        $this->validate();

        // Emitir un evento hacia JavaScript para mostrar la sección de firma
        $this->dispatch('openSignatureModal');
    }

    public function saveData()
    {
        $this->validate();

        // Guardar datos en la base de datos
        Participante::create([
            'dni' => $this->dni,
            'name_and_last_name' => $this->name_and_last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'signature_base64' => $this->signatureBase64,
        ]);

        // Reiniciar el formulario y mostrar mensaje de éxito
        $this->resetForm();
        $this->successMessage = 'Los datos se han guardado correctamente.';
    }

    public function resetForm()
    {
        $this->dni = '';
        $this->name_and_last_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->signatureBase64 = '';
    }
}
