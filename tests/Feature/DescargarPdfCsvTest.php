<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Participante;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DescargarPdfCsvTest extends TestCase
{
    use RefreshDatabase;


    public function signIn($user = null)
    {
        $user = $user ?: User::factory()->create(); // Utiliza el modelo de usuario o Factory adecuado
        $this->actingAs($user); // Inicia sesión como el usuario dado
        return $this;
    }

    /** @test */
    public function puede_descargar_pdf()
    {

        
        // Arrange
        $this->signIn(); // Si tienes autenticación, ingresa al usuario necesario para acceder al método
        
        // Act
        Livewire::test('descargar-pdf-csv')
            ->set('fechaInicio', '2024-04-01')
            ->set('fechaFin', '2024-04-30')
            ->call('descargarPdf')
            ->assertOk();

        // Assert
        // Aquí puedes agregar más aserciones según tus necesidades
    }

    /** @test */
    public function puede_descargar_csv()
    {
        // Arrange
        $this->signIn(); // Si tienes autenticación, ingresa al usuario necesario para acceder al método
        
        // Act
        Livewire::test('descargar-pdf-csv')
            ->set('fechaInicio', '2024-04-01')
            ->set('fechaFin', '2024-04-30')
            ->call('downloadCSV')
            ->assertOk();

        // Assert
        // Aquí puedes agregar más aserciones según tus necesidades
    }

    // Otras pruebas según sea necesario
}
