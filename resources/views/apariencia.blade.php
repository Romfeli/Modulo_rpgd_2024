@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-center text-2xl font-semibold mb-6">Subir Logo</h1>
        
        <form action="{{ route('logo.upload') }}" method="POST" enctype="multipart/form-data" class="mb-6">
            @csrf
            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium text-gray-700">Seleccionar archivo:</label>
                <input type="file" name="logo" id="logo" required class="form-input w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full block w-full transition duration-300 ease-in-out transform hover:scale-105">
                Subir Logo
            </button>
        </form>

        <form action="{{ route('logo.toggle') }}" method="POST" class="flex items-center justify-between">
            @csrf
            <span class="text-gray-700">Logo Activo</span>
            <label for="toggleLogo" class="flex items-center cursor-pointer">
                <input id="toggleLogo" type="checkbox" name="logo_active" onchange="this.form.submit()" {{ $isLogoActive ? 'checked' : '' }} class="hidden">
                <span class="slider rounded-full w-9 h-5 bg-gray-300 inline-block relative">
                    <span class="slider-thumb absolute w-4 h-4 rounded-full bg-white shadow-md transition-transform transform {{ $isLogoActive ? 'translate-x-full bg-green-400' : 'translate-x-0 bg-red-400' }}"></span>
                </span>
            </label>
        </form>

        {{-- Mostrar mensaje de éxito --}}
        @if(session('success'))
            <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                {{ session('success') }}
            </div>
            {{-- Mostrar imagen subida si existe --}}
            @if(session('logo'))
                <div class="mt-6">
                    <img src="{{ asset('logos/' . session('logo')) }}" alt="Logo Subido" class="mx-auto rounded-lg shadow-md" style="max-width: 300px;">
                </div>
            @endif
        @endif
    </div>
</div>

<style>
    /* Estilos para el slider-thumb */
    .slider-thumb {
        transition-duration: 0.3s; /* Duración de la transición */
    }
</style>

@endsection
