@extends('layouts.app')

@section('content')
    <!-- pagina home donde solo entra el invitado y la sesion iniciada -->
  
    <main class="mt-6">
         <!-- Componente Tablero de Inicio -->
         <div class="flex justify-center mb-6">
            <livewire:tablero-inicio />
        </div>
        
         <!-- Componente Agregar Formulario -->
         <div class=""> <!-- Ancho fijo del 50% del contenedor padre -->
            <livewire:agregar-formulario />
        </div>
        
        <!-- Contenedor para Lista de Participantes y Agregar Formulario -->
        <div class="flex justify-center space-x-4">
            <!-- Componente Lista de Participantes -->
            <div class=""> <!-- Ancho fijo del 50% del contenedor padre -->
                <livewire:lista-participantes />
            </div>

           
        </div>
    </main>
@endsection
