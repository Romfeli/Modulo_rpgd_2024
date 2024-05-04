@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Apariencia') }}</div>
                <div class="card-body">
                    <h1>Subir Logo</h1>
                    <form action="{{ route('logo.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="logo" required>
                        <button type="submit">Subir Logo</button>
                    </form>

                    <form action="{{ route('logo.toggle') }}" method="POST">
                        @csrf
                        <label class="switch">
                        <input type="checkbox" name="logo_active" onchange="this.form.submit()" {{ $isLogoActive ? 'checked' : '' }}>
                        <span class="slider round"></span>
                        </label>
                    </form>


                    {{-- Mostrar mensaje de éxito --}}
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                        {{-- Mostrar imagen subida si existe --}}
                        @if(session('logo'))
                            <div class="mt-3">
                                <img src="{{ asset('logos/' . session('logo')) }}" alt="Logo Subido" style="max-width: 30%;">
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
