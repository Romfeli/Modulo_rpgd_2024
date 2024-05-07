

<div>

    <style>
        /* Estilos para el mensaje de éxito */
     #mensajeRespuesta {
    display: none;
    position: fixed;
    bottom: 50%;
    left: 50%;
    transform: translate(-50%, 50%);
    background-color: #F87171; /* Color rojo suave */
    color: #ffffff; /* Texto blanco */
    border: 1px solid #EF4444; /* Borde rojo oscuro */
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 9999;
}

    
        /* Estilos para el mensaje de éxito */
        #mensajeRespuesta strong {
            font-weight: bold;
        }
    </style>
    
    <!-- Botón "Ver Participante" -->
    <div class="flex justify-center mb-4">
        <button 
            wire:click="showFormulario" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Agregar participante
        </button>
    </div>

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

                <div>
                    <label for="phone_number" class="block mb-2">Teléfono</label>
                    <input type="text" id="phone_number" wire:model="phone_number" placeholder="Teléfono" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                    @error('phone_number') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>



                <div class="mb-4">
                    <label for="legal_text" class="block mb-2">Texto Legal</label>
                    <div class="border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                        {{ $legalText->content }}
                    </div>
                </div>            
            
              
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="check1" wire:model="firstCheckbox" class="form-checkbox h-5 w-5 text-blue-600" checked>
                        <span class="ml-2 text-gray-700">{{ $firstCheckbox->content}}</span>
                    </label>
                    @error('firstCheckbox') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="check2" wire:model="lastCheckbox" class="form-checkbox h-5 w-5 text-blue-600" checked>
                        <span class="ml-2 text-gray-700">{{ $lastCheckbox->content }}</span>
                    </label>
                    @error('lastCheckbox') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

    <label for="interest" class="block mb-2">Intereses</label>
    <select id="interest" wire:model="interest" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
        <option value="" disabled selected>Selecciona una opción</option>
        <option value="viajar">Viajar</option>
        <option value="estudiar">Estudiar</option>
        <option value="deporte">Deporte</option>
    </select>
   

                <button type="button" wire:click="validarFormulario" class="w-full bg-green-500 text-white py-2 px-4 rounded-md mb-4">Validar Datos</button>

                <button type="button" wire:click="saveData" onclick="showSignatureModal()" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">Firmar y Enviar</button>
            </form>
        </div>
    </div>
    @endif

    <!-- Mensaje de respuesta -->

<div id="mensajeRespuesta" style="display: none; background-color: green; color: white; border: 1px solid darkgreen; padding: 10px;">
</div>

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

document.addEventListener('livewire:load', function () {
        const inputElement = document.querySelector("#phone_number");
        const iti = window.intlTelInput(inputElement, {
            initialCountry: 'auto',
            separateDialCode: true,
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js' // Necesario para el formato y validación del número
        });

        inputElement.addEventListener('change', function () {
            const phoneNumber = iti.getNumber();
            @this.set('phone_number', phoneNumber);
        });
    });


function showMessage(esExitoso, mensaje) {
    const mensajeElemento = document.getElementById('mensajeRespuesta');

    if (esExitoso) {
        mensajeElemento.style.backgroundColor = '#34D399'; // Color verde suave
        mensajeElemento.style.borderColor = '#059669'; // Borde verde oscuro
        mensajeElemento.style.color = '#ffffff'; // Texto blanco
        mensajeElemento.innerHTML = mensaje; // Establecer el mensaje
    mensajeElemento.style.display = 'block'; // Mostrar el mensaje
        setTimeout(function() {
            location.reload(true); // Recargar la página después de 2 segundos
        }, 2000); // 2000 milisegundos = 2 segundos
    } else {
        mensajeElemento.innerHTML = mensaje; // Establecer el mensaje
         mensajeElemento.style.display = 'block'; // Mostrar el mensaje
        mensajeElemento.style.backgroundColor = '#F87171'; // Color rojo suave
        mensajeElemento.style.borderColor = '#EF4444'; // Borde rojo oscuro
        mensajeElemento.style.color = '#ffffff'; // Texto blanco
        setTimeout(function() {
        mensajeElemento.style.display = 'none'; // Ocultar el mensaje después de un tiempo
    }, 2000); // 2000 milisegundos = 2 segundos
    }

  

   
}

    let signaturePad;
    let haComenzadoDibujo = false;

    function showSignatureModal() {
        const dni = document.getElementById('dni').value;

        Swal.fire({
            title: 'Firma Digital',
            html: '<canvas id="signatureCanvas" width="400" height="200"></canvas>',
            showCancelButton: true,
            confirmButtonText: 'CONFIRMAR',
            didOpen: () => {
                const canvas = document.getElementById('signatureCanvas');
                signaturePad = new SignaturePad(canvas);
                canvas.addEventListener("mousedown", evento => {
                    haComenzadoDibujo = true;
                });
                canvas.addEventListener("mousemove", (evento) => {
                    if (!haComenzadoDibujo) {
                        return;
                    }
                    const x = evento.clientX - canvas.getBoundingClientRect().left;
                    const y = evento.clientY - canvas.getBoundingClientRect().top;
                    signaturePad.strokeMoveTo(x, y);
                    signaturePad.stroke();
                });
                ["mouseup", "mouseout"].forEach(nombreDeEvento => {
                    canvas.addEventListener(nombreDeEvento, () => {
                        haComenzadoDibujo = false;
                    });
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                handleSignatureAndShipping();
            }
        });
    }

    async function handleSignatureAndShipping() {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const formData = new FormData();
            formData.append('dni', document.getElementById('dni').value);
            formData.append('name_and_last_name', document.getElementById('name_and_last_name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone_number', document.getElementById('phone_number').value);
            
            const canvas = document.getElementById('signatureCanvas');
            if (!canvas) {
                throw new Error('No se encontró el elemento canvas de la firma.');
            }
        
            const signatureBase64 = canvas.toDataURL();
            formData.append('signatureBase64', signatureBase64);

            const response = await fetch('/guardar-datos', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }

            const data = await response.json();
            console.log('Respuesta del servidor:', data);

            // Mostrar mensaje de éxito
            showMessage(true, '¡Participante agregado exitosamente!');
        } catch (error) {
            console.error('Error al enviar el formulario:', error);
            // Mostrar mensaje de error
            showMessage(false, 'Hubo un error al procesar la solicitud.');
        }
    }

    // Función para validar los datos del formulario
    async function validarFormulario() {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const formData = new FormData();
            formData.append('dni', document.getElementById('dni').value);
            
            const response = await fetch('/validar-datos', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Error en la validación: ' + response.statusText);
            }

            const data = await response.json();
            console.log('Respuesta de validación:', data);

            // Mostrar mensaje de éxito
            showMessage(true, '¡Datos validados correctamente!');
        } catch (error) {
            console.error('Error al validar los datos:', error);
            // Mostrar mensaje de error
            showMessage(false, 'Hubo un error al validar los datos.');
        }
    }
</script>

