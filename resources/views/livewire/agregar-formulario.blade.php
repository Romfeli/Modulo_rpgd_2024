<div>
    <div class="flex justify-center items-center h-screen">
        <div class="w-96 bg-white p-8 rounded-lg shadow-md">
            <label for="dni" class="block mb-2">DNI</label>
            <input type="text" id="dni" wire:model="dni" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
    
            <button wire:click="validateDni" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md mb-4">Validar DNI</button>
    
            @error('dni')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
    
            @if ($showForm)
                <form id="formParticipante" wire:submit.prevent="saveData">
                    @csrf
    
                    <label for="name_and_last_name" class="block mb-2">Nombre y Apellido</label>
                    <input type="text" id="name_and_last_name" wire:model="name_and_last_name" placeholder="Nombre y Apellido" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                    @error('name_and_last_name') <span class="text-red-500">{{ $message }}</span> @enderror
    
                    <label for="email" class="block mb-2">Email</label>
                    <input type="email" id="email" wire:model="email" placeholder="Email" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
    
                    <label for="phone_number" class="block mb-2">Teléfono</label>
                    <input type="text" id="phone_number" wire:model="phone_number" placeholder="Teléfono" class="w-full border-gray-300 rounded-md py-2 px-3 mb-4 focus:outline-none focus:ring focus:border-blue-300">
                    @error('phone_number') <span class="text-red-500">{{ $message }}</span> @enderror
    
                    <button type="button" onclick="showSignatureModal()" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">Firmar y Enviar</button>
                </form>
            @endif
    
            @if ($successMessage)
                <div class="text-green-500 mt-4">{{ $successMessage }}</div>
            @endif
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const dni = document.getElementById('dni').value;
        const name = document.getElementById('name_and_last_name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone_number').value;

        if (!dni || !name || !email || !phone) {
            alert('Por favor, complete todos los campos.');
            return false;
        }

        return true;
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

            formData.forEach((value, key) => {
                console.log(key + ': ' + value);
            });

            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }

            const data = await response.json();
            console.log('Respuesta del servidor:', data);
        } catch (error) {
            console.error('Error al enviar el formulario:', error);
        }
    }
</script>
