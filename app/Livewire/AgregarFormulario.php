<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Participante;
use Illuminate\Http\Request;

class AgregarFormulario extends Component
{
    public $dni;
    public $name_and_last_name;
    public $email;
    public $phone_number;
    public $successMessage;
    public $showForm = false;
    public $signatureBase64;


 

    

    public function render()
    {
        return view('livewire.agregar-formulario');
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
        $this->showForm = true;
        $this->resetForm();
        $this->successMessage = 'Los datos se han guardado correctamente.';

        $request->validate([
            'dni' => 'required|digits:8',
            'name_and_last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participantes,email',
            'phone_number' => ['required', 'regex:/^\+?\d+$/'],
            // Agrega más reglas de validación según sea necesario
        ]);
        $signatureBase64 = $request->input('signatureBase64');
        $imageSignature = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureBase64));

        Participante::create([
            'dni' => $request->dni,
            'name_and_last_name' => $request->name_and_last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'signatureBase64' => $request->signatureBase64,
        ]);


        return response()->json(['message' => $this->successMessage]);
   
    } catch (\Exception $e) {
        // Manejar cualquier excepción y devolver una respuesta de error
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
}
