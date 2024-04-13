<!-- Blade (Componente Livewire) -->
<div>
    <input type="text" wire:model="dni" />
    <button wire:click="validateDni">Validar DNI</button>
    @error('dni') <span class="error">{{ $message }}</span> @enderror

    @if ($showForm)
        <form wire:submit.prevent="toggleSignatureSection">
            <!-- Campos existentes -->
            <input type="text" wire:model="name_and_last_name" placeholder="Nombre y Apellido" />
            @error('name_and_last_name') <span class="error">{{ $message }}</span> @enderror

            <input type="email" wire:model="email" placeholder="Email" />
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <input type="text" wire:model="phone_number" placeholder="Teléfono" />
            @error('phone_number') <span class="error">{{ $message }}</span> @enderror
            <button type="submit">Firmar y Enviar</button>
        </form>
    @endif

    @if ($successMessage)
        <div class="success">{{ $successMessage }}</div>
    @endif
</div>

@push('scripts')
<script src="ruta/a/signature-pad.js"></script>
<script>
    Livewire.on('openSignatureModal', () => {
        const modal = document.getElementById('signature-modal');
        const canvas = document.getElementById('signatureCanvas');
        signaturePad = new SignaturePad(canvas);

        modal.style.display = 'block';
    });

    Livewire.on('closeSignatureModal', () => {
        const modal = document.getElementById('signature-modal');
        modal.style.display = 'none';
    });

    document.addEventListener("DOMContentLoaded", function() {
        const canvas = document.getElementById('signatureCanvas');
        canvas.addEventListener("mousedown", handleMouseDown);
        canvas.addEventListener("mousemove", handleMouseMove);
        ["mouseup", "mouseout"].forEach(eventName => {
            canvas.addEventListener(eventName, handleMouseUp);
        });
    });
</script>
@endpush
