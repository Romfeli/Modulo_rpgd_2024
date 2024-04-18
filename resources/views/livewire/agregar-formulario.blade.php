<div>
    <label for="dni">DNI</label>
    <input type="text" id="dni" wire:model="dni" />
    <button wire:click="validateDni">Validar DNI</button>
    @error('dni') <span class="error">{{ $message }}</span> @enderror

    @if ($showForm)
        <form method="POST" id="formParticipant" wire:submit.prevent="saveData">
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

            <button type="button" onclick="showSignatureModal()">Firmar y Enviar</button>

        </form>
    @endif

    @if ($successMessage)
        <div class="success">{{ $successMessage }}</div>
    @endif

    <script>
        let signaturePad;
        let haComenzadoDibujo = false;

        function showSignatureModal() {
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
                const formData = new FormData(document.getElementById('formParticipant'));
                formData.append('_token', csrfToken);

                // Obtener la firma en formato base64
                const canvas = document.getElementById('signatureCanvas');
                const signatureBase64 = canvas.toDataURL();

                // Agregar la firma al formulario
                formData.append('signatureBase64', signatureBase64);
                
                const response = await fetch('/guardar-datos', {
                    method: 'POST',
                    body: formData,
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
