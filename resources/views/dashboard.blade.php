@extends('layouts.app')

@section('content')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="mt-4">
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Registros de hoy</h2>
                                @livewire('dashboard-lista')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Descargar PDF y CSV</h2>
                                @livewire('descargar-pdf-csv')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

