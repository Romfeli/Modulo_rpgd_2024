<div>
    <label for="dni">DNI</label>
    <!-- Aquí usamos wire:model para enlazar el valor del campo 'dni' al componente de Livewire -->
    <input type="text" id="dni" wire:model="dni" />
    <button wire:click="validateDni">Validar DNI</button>
    <!-- Aquí mostramos cualquier error de validación relacionado con el campo 'dni' -->
    @error('dni') <span class="error">{{ $message }}</span> @enderror

    @if ($showForm)
    <!-- Aquí usamos wire:model para enlazar el valor del campo 'dni' al componente de Livewire -->
   
    <form method="POST" id="formParticipante"  wire:submit.prevent="saveData">
        @csrf

            <!-- Agrega el campo 'dni' dentro del formulario -->

            <!-- Campos existentes -->
            <label for="name_and_last_name">Nombre y Apellido</label>
            <input type="text" id="name_and_last_name" wire:model="name_and_last_name" placeholder="Nombre y Apellido" />
            @error('name_and_last_name') <span class="error">{{ $message }}</span> @enderror

            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" placeholder="Email" />
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <label for="phone_number">Teléfono</label>
            <input type="text" id="phone_number" wire:model="phone_number" placeholder="Teléfono" />
            @error('phone_number') <span class="error">{{ $message }}</span> @enderror

            <button type="button"  onclick="showSignatureModal()">Firmar y Enviar</button>
        </form>
    @endif


    @if ($successMessage)
        <div class="success">{{ $successMessage }}</div>
    @endif

    <script>
        
         function validateForm() {
        // Validación básica en el frontend
        const dni = document.getElementById('dni').value;
        const name = document.getElementById('name_and_last_name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone_number').value;

        if (!dni || !name || !email || !phone) {
            alert('Por favor, complete todos los campos.');
            return false;
        }

        // Validación adicional, como verificar el formato del correo electrónico, longitud del teléfono, etc.

        return true;
    }





        let signaturePad;
        let haComenzadoDibujo = false;
    
        function showSignatureModal() {
            // Obtener el valor del campo 'dni'
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
                    // Llamada a la función para manejar la firma y el envío del formulario
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
        // Obtener el canvas de la firma
        const canvas = document.getElementById('signatureCanvas');
        if (!canvas) {
            throw new Error('No se encontró el elemento canvas de la firma.');
        }
        
        // Obtener la firma en formato base64
        const signatureBase64 = canvas.toDataURL();

        // Agregar la firma al formulario
     
        formData.append('signatureBase64', signatureBase64);



        const response = await fetch('/guardar-datos', {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Asegúrate de enviar el token CSRF
            },
            body: formData,
            
        });
        formData.forEach((value, key) => {
            console.log(key + ': ' + value);
        });

        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
        }

        const data = await response.json();
        console.log('Respuesta del servidor:', data);
        // Aquí puedes manejar la respuesta del servidor, como mostrar un mensaje de éxito, etc.
    } catch (error) {
        console.error('Error al enviar el formulario:', error);
        // Aquí puedes manejar el error, como mostrar un mensaje de error al usuario, etc.
    }
}

    </script>
    
</div>




