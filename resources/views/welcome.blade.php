@extends('layouts.app')

@section('content')
    <main class="mt-6">
         <!-- Componente Tablero de Inicio -->
         <div class="flex justify-center mb-6">
            <livewire:tablero-inicio />
        </div>
        
         
        
        <!-- Componente Agregar Formulario (inicialmente oculto) -->
        <div class="flex justify-center mb-4" wire:loading.remove>
            
                <div class="w-1/2"> <!-- Ancho fijo del 50% del contenedor padre -->
                    <livewire:agregar-formulario />
                </div>
           
        </div>
        
        <!-- Contenedor para Lista de Participantes -->
        <div class="flex justify-center space-x-4">
            <div class="w-1/2">
                <livewire:lista-participantes />
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('showFormulario', () => {
            const formulario = document.querySelector('.w-1/2');
            if (formulario) {
                formulario.classList.remove('hidden');
            }
        });
    });
</script>
@endpush
