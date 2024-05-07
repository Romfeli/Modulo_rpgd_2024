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
    public $successMessage = '';
    public $showForm2 = false;
    public $showForm = false;
    public $legalText;
    public $firstCheckbox= false;
    public $lastCheckbox= false;

    protected $rules = [
        'dni' => 'required|digits:8',
        'name_and_last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:participantes,email',
        'phone_number' => 'required|regex:/^\+?\d+$/',
        'firstCheckbox' => 'required', // Regla de validación para firstCheckbox
        'lastCheckbox' => 'required',  // Regla de validación para lastCheckbox
       
    ];

    public function validarFormulario()
    {
        $this->validate();


        $this->successMessage = 'Los datos son válidos, ya puedes firmar y enviar';
        $this->dispatch('hideSuccessMessage');

        return response()->json(['message' => $this->successMessage]);
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

    public function saveData(Request $request)
    {
        try {
            $this->validate();
           

            Participante::create([
                'dni' => $request->dni,
                'name_and_last_name' => $request->name_and_last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'signatureBase64' => $request->signatureBase64,
            ]);

            $this->showForm = false;
            $this->successMessage = 'Los datos se han guardado correctamente.';

            return response()->json(['message' => $this->successMessage]);
        } catch (\Exception $e) {
            \Log::error('Error al procesar la solicitud POST: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error interno en el servidor.'], 500);
        }
    }

    public function resetForm()
    {
        $this->dni = '';
        $this->name_and_last_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->showForm = false;
    }

    public function showFormulario()
    {
        $this->resetForm();
        $this->showForm2 = !$this->showForm2; // Invert the value of $showForm2
    }

    public function mount()
    {
        $this->firstCheckbox = Checkbox::first();
        $this->lastCheckbox = Checkbox::latest()->first();
        $this->legalText = LegalText::first();
    }

    public function render()
    {
        return view('livewire.agregar-formulario')->layout('layouts.app');
    }
}
