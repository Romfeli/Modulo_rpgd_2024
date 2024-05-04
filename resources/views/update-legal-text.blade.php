<!-- resources/views/checkboxs.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Legal Text') }}</div>
                <div class="card-body">
                    <!-- Renderizar el componente Livewire -->
                    <livewire:legal-texts />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
