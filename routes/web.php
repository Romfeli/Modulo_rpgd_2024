<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\AgregarFormulario;
use App\Livewire\ListaParticipantes;
use App\Livewire\DescargarPdfCsv;
use App\Livewire\BuscadorParticipante;


Route::get('/', function () {
    return view('welcome');
});



Route::post('/guardar-datos', [AgregarFormulario::class, 'saveData']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/buscador', function () {
        return view('buscador');
    })->name('buscador');
});

Route::get('/agregar-formulario', [AgregarFormulario::class, 'render']);
Route::post('/validate-dni', [AgregarFormulario::class, 'validateDni']);
Route::post('/agregar-formulario', [AgregarFormulario::class, 'saveData']);

Route::get('/descargar', [DescargarPdfCsv::class, 'descargarPdf']);

