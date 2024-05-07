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
    public $firstCheckbox= true;
    public $lastCheckbox= true;
    public $firstCheckboxChecked = false;
    public $lastCheckboxChecked = false;
    
    public $successMessage = '';

    public $showForm2 = false;
    public $showForm = false;

    public $legalText;
    

    protected $rules = [
        'dni' => 'required|digits:8',
        'name_and_last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:participantes,email',
        'phone_number' => 'required|regex:/^\+?\d+$/',
        'firstCheckboxChecked' => 'accepted',
        'lastCheckboxChecked' => 'accepted',
        
    ];
    
    public function mount()
{
    $this->firstCheckbox = Checkbox::first(); 
    $this->lastCheckbox = Checkbox::latest()->first();
    $this->legalText = LegalText::first();



   
    
}


      
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

    public function saveData()
    {
        try {
            $participante = Participante::create([
                'dni' => $this->dni,
                'name_and_last_name' => $this->name_and_last_name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'signatureBase64' => $this->signatureBase64,
                'firstCheckbox' => $this->firstCheckboxChecked,
                'lastCheckbox' => $this->lastCheckboxChecked,
            ]);
    
            // No es necesario llamar a $participante->save(), ya que ya se guardó con create()
    
            $this->successMessage = 'Los datos se han guardado correctamente.';
        } catch (\Exception $e) {
            \Log::error('Error al procesar la solicitud POST: ' . $e->getMessage());
            $this->successMessage = 'Hubo un error al guardar los datos.';
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

   

    public function render()
    {
        return view('livewire.agregar-formulario')->layout('layouts.app');
    }
}
