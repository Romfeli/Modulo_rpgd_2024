<div class="container mx-auto p-4">
    <!-- Botón "Ver Participante" -->
    <div class="flex justify-center mb-4">
        <button 
            wire:click="showFormulario" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Agregar participante
        </button>
    </div>

    <!-- Formulario para mostrar el DNI -->
    @if ($showForm2)
    <div class="flex justify-center items-center ">
        <div  class="w-96 bg-white p-8 rounded-lg shadow-md">
            <label for="dni" class="block mb-2">DNI</label>
            <input type="text" id="dni" wire:model="dni" value="{{ old('dni') }}" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
            
            <button wire:click="validateDni" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md mb-4">Validar DNI</button>
    
            @error('dni')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @endif

    <!-- Formulario principal -->
    @if ($showForm)
    <div class="flex justify-center items-center ">
        <div  class="w-96 bg-white p-8 rounded-lg shadow-md">
            <form id="formParticipante" wire:submit.prevent="saveData">
                @csrf

                <label for="name_and_last_name" class="block mb-2">Nombre y Apellido</label>
                <input type="text" id="name_and_last_name" wire:model="name_and_last_name" placeholder="Nombre y Apellido" value="{{ old('name_and_last_name') }}" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                @error('name_and_last_name') <span class="text-red-500">{{ $message }}</span> @enderror

                <label for="email" class="block mb-2">Email</label>
                <input type="email" id="email" wire:model="email" placeholder="Email" value="{{ old('Email') }}" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

                <div class="mb-4">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" id="phone_number" wire:model.lazy="phone_number" placeholder="Teléfono" class="w-full border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-300 focus:border-blue-300">
                    @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="legal_text" class="block mb-2">Texto Legal</label>
                    <div class="border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                        {{ $legalText->content }}
                    </div>
                </div>            
            
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="firstCheckboxChecked" wire:model="firstCheckboxChecked" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">{{$firstCheckbox->content}}</span>
                    </label>
                    @error('firstCheckboxChecked') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
    
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="lastCheckboxChecked" wire:model="lastCheckboxChecked" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">{{$lastCheckbox->content}}</span>
                    </label>
                    @error('lastCheckboxChecked') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <label for="interest" class="block mb-2">Intereses</label>
                <select id="interest" wire:model="interest" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="viajar">Viajar</option>
                    <option value="estudiar">Estudiar</option>
                    <option value="deporte">Deporte</option>
                </select>

                @error('signatureBase64') <span class="text-red-500">{{ $message }}</span> @enderror
                <button type="button" onclick="showSignatureModal()" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">Firmar</button>
                <input type="hidden" id="signatureBase64" wire:model="signatureBase64">

                <button type="button" wire:click="saveData" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md mt-4">Enviar</button>
            </form>
        </div>
    </div>
    @endif

    <!-- Mensaje de respuesta -->
    @if($successMessage)
    <div  class="flex justify-center items-center mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-96" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ $successMessage }}</span>
        </div>
    </div>
    @else
    <p>  </p>
    @endif
</div>


<script>

document.addEventListener('DOMContentLoaded', () => {
    window.addEventListener('hide-success-message', event => {
        setTimeout(() => {
            @this.set('successMessage', '');
        }, 3000);  // Ocultar mensaje después de 3 segundos
    });
});



    let signaturePad;

    window.showSignatureModal = function () {
    const canvasHtml = `<canvas id="signatureCanvas" width="400" height="200" style="border:1px solid #ccc;"></canvas>`;
    Swal.fire({
        title: 'Firma Digital',
        html: canvasHtml,
        focusConfirm: false,
        preConfirm: () => {
            const canvas = document.getElementById('signatureCanvas');
            if (!signaturePad.isEmpty()) {
                const signatureData = signaturePad.toDataURL();
                document.getElementById('signatureBase64').value = signatureData;
                @this.set('signatureBase64', signatureData); // Actualizar el valor en Livewire
                
                // Mostrar un mensaje de éxito
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Firma guardada correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });

                return true;
            } else {
                Swal.showValidationMessage("Por favor, proporciona una firma.");
                return false;
            }
        },
        didOpen: () => {
            const canvas = document.getElementById('signatureCanvas');
            signaturePad = new SignaturePad(canvas);
        }
    });
};



</script>

