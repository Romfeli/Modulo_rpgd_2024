<?php
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\AgregarFormulario;
use App\Livewire\ListaParticipantes;


Route::post('/guardar-datos', [AgregarFormulario::class, 'saveData'])->name('guardar-datos');

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
});


