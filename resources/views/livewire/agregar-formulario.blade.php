<div>
    <input type="text" wire:model="dni" />
    <button wire:click="validateDni">Validar DNI</button>
    @error('dni') <span class="error">{{ $message }}</span> @enderror

    @if ($showForm)
        <form wire:submit.prevent="saveData">
            <!-- Campos existentes -->
            <input type="text" wire:model="name_and_last_name" placeholder="Nombre y Apellido" />
            @error('name_and_last_name') <span class="error">{{ $message }}</span> @enderror

            <input type="email" wire:model="email" placeholder="Email" />
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <input type="text" wire:model="phone_number" placeholder="Teléfono" />
            @error('phone_number') <span class="error">{{ $message }}</span> @enderror

            <div id="signature-pad" class="signature-pad">
                <canvas id="signature-canvas" width="400" height="200"></canvas>
            </div>

            <button type="button" onclick="showSignatureModal()">Firmar y Enviar</button>

            <!-- Este botón estará oculto y se utilizará para enviar el formulario -->
            <button type="submit" id="submitForm" style="display: none;"></button>
        </form>
    @endif

    @if ($successMessage)
        <div class="success">{{ $successMessage }}</div>
    @endif

    <script>

        let signaturePad; // Variable global para almacenar la instancia de SignaturePad

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
                    // Enviamos el formulario al hacer clic en el botón oculto
                    document.getElementById('submitForm').click();
                }
            });
        }
    </script>
</div>
