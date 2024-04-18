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
    public $successMessage;
    public $showForm = false;
    public $signatureBase64;

    protected $rules = [
        'dni' => 'required|digits:8',
        'name_and_last_name' => 'required|string',
        'email' => 'required|email|unique:participantes,email',
        'phone_number' => 'required|string',
        'signatureBase64' => 'required|string', // Agrega regla de validación para la firma
    ];

    public function render()
    {
        return view('livewire.agregar-formulario');
    }

    public function validateDni()
    {
        $this->validate(['dni' => 'required|digits:8']);

        // Verificar si existe un participante con el DNI proporcionado
        $participante = Participante::where('dni', $this->dni)->latest()->first();

        if ($participante) {
            // Si se encuentra un participante, cargar sus datos en el formulario
            $this->name_and_last_name = $participante->name_and_last_name;
            $this->email = $participante->email;
            $this->phone_number = $participante->phone_number;

            // Mostrar el formulario
            $this->showForm = true;
        } else {
            $this->showForm = true;
        }
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
            'signatureBase64' => $this->signatureBase64,
        ]);

        // Reiniciar el formulario después de guardar los datos
        $this->resetForm();
        $this->successMessage = 'Los datos se han guardado correctamente.';
    }

    public function resetForm()
    {
        $this->dni = '';
        $this->name_and_last_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->showForm = false;
    }

    public function showSignatureModal()
    {
        $this->dispatchBrowserEvent('openSignatureModal');
    }
}
