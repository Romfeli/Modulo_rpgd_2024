<!-- resources/views/checkboxs.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkboxes') }}</div>
                <div class="card-body">
                    <!-- Renderizar el componente Livewire -->
                    <livewire:checkboxs />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
