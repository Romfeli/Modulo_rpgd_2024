<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\AgregarFormulario;
use App\Livewire\ListaParticipantes;
use App\Livewire\DescargarPdfCsv;
use App\Livewire\BuscadorParticipante;
use App\Livewire\Checkboxs;
use App\Livewire\LegalText;
use App\Livewire\LogoToggle;
use App\Http\Controllers\AparienciaController;







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

    Route::get('/update-checkboxs', function () {
        return view('update-checkboxs');
    })->name('update-checkboxs');

    
    Route::get('/update-legal-text', function () {
        return view('update-legal-text');
    })->name('update-legal-text');

    Route::get('/apariencia', function () {
        return view('apariencia');
    })->name('apariencia');




    Route::post('/logo-toggle', [AparienciaController::class, 'toggleLogo'])->name('logo.toggle');
    Route::get('/apariencia', [AparienciaController::class, 'index'])->name('apariencia');
    Route::post('/logo-upload', [AparienciaController::class, 'uploadLogo'])->name('logo.upload');

    Route::get('/descargar', [DescargarPdfCsv::class, 'descargarPdf']);

    
}
);
Route::post('/guardar-datos', [AgregarFormulario::class, 'saveData']);
Route::get('/agregar-formulario', [AgregarFormulario::class, 'render']);
Route::post('/validate-dni', [AgregarFormulario::class, 'validateDni']);
Route::post('/agregar-formulario', [AgregarFormulario::class, 'saveData']);
Route::get('/send-check', [Checkboxs::class, 'send_check']);





