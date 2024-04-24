@extends('layouts.app')

@section('content')
    <!-- Contenido de tu página aquí -->
    <main class="mt-6">
        <div>
            <livewire:lista-participantes />
        </div>
        <div>
            <livewire:agregar-formulario />
        </div>
    </main>
@endsection
