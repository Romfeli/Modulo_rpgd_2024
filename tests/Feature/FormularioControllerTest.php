<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormularioControllerTest extends TestCase
{
    /**
 * prueba de que los datos se guardan en el formulario
 * 
 * @test
 * 
 */
                public function puede_guardar_datos()
                {
                    $response = $this->post('/guardar-datos', [
                        'dni' => '12345678',
                        'name_and_last_name' => 'John Doe',
                        'email' => 'john@example.com',
                        'phone_number' => '+123456789',
                        'signatureBase64' => 'base64-encoded-signature',
                        'firstCheckbox' => true, // Cambiado a false
                        'lastCheckbox' => true // Cambiado a false
                    ]);

                    $response->assertStatus(200)
                        ->assertJson([
                            'message' => 'Los datos se han guardado correctamente.'
                        ]);

                    // Verificar que los datos se hayan guardado en la base de datos
                    $this->assertDatabaseHas('participantes', [
                        'dni' => '12345678',
                        'name_and_last_name' => 'John Doe',
                        'email' => 'john@example.com',
                        'phone_number' => '+123456789',
                        'signatureBase64' => 'base64-encoded-signature',
                        'firstCheckbox' => true,
                        'lastCheckbox' => true
                    ]);

                    
                }
}
