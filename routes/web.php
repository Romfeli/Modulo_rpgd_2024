<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\AgregarFormulario;
use App\Livewire\ListaParticipantes;
use App\Livewire\DescargarPdfCsv;
use App\Livewire\BuscadorParticipante;
use App\Livewire\Checkboxs;







Route::get('/', function () {
    return view('welcome');
});

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

Route::post('/guardar-datos', [AgregarFormulario::class, 'saveData']);



Route::get('/agregar-formulario', [AgregarFormulario::class, 'render']);
Route::post('/validate-dni', [AgregarFormulario::class, 'validateDni']);
Route::post('/agregar-formulario', [AgregarFormulario::class, 'saveData']);

Route::get('/descargar', [DescargarPdfCsv::class, 'descargarPdf']);


Route::get('/checkboxs', Checkboxs::class)->name('checkboxs');

Route::get('/update-checkboxs', function () {
    return view('update-checkboxs');
})->name('update-checkboxs');

