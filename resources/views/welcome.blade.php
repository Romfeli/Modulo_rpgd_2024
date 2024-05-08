@extends('layouts.app')

@section('content')
    <main class="mt-6">
         <!-- Componente Tablero de Inicio -->
         <div class="flex justify-center mb-6">
            <livewire:tablero-inicio />
        </div>
        
         
        
        <!-- Componente Agregar Formulario (inicialmente oculto) -->
        <div class="flex justify-center mb-4" wire:loading.remove>
            
            <div class="w-full sm:w-3/4 md:w-1/2 lg:w-2/5 xl:w-1/3 bg-white rounded-lg  overflow-hidden">
                    <livewire:agregar-formulario />
                </div>
           
        </div>
        <!-- Contenedor para Lista de Participantes -->

        <div class="flex justify-center my-4">
            <div class="w-full sm:w-3/4 md:w-1/2 lg:w-2/5 xl:w-1/3 bg-white rounded-lg  overflow-hidden">
                <livewire:lista-participantes />
            </div>
        </div>
    </main>
@endsection


