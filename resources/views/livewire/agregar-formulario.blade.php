<!-- Blade (Componente Livewire) -->
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
            <button type="submit">Firmar y Enviar</button>
        </form>
    @endif

    @if ($successMessage)
        <div class="success">{{ $successMessage }}</div>
    @endif

</div>
