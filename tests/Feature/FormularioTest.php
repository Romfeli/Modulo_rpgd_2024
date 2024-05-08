<?php

namespace Tests\Feature;

use App\Models\Checkbox;
use App\Models\LegalText;
use App\Models\Participante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\AgregarFormulario;

class FormularioTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function formulario_se_completa_y_envia_correctamente()
    {
     

        Livewire::test(AgregarFormulario::class)
        ->set('dni', '12345678')
        ->set('name_and_last_name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('phone_number', '+1234567890')
        ->set('signatureBase64', 'base64-encoded-signature')
        ->set('firstCheckboxChecked', true)
        ->set('lastCheckboxChecked', true)
        ->call('saveData')
        ->assertStatus(200);

      // Verificar que los datos se han guardado en la base de datos.
      $this->assertDatabaseHas('participantes', [
        'dni' => '12345678',
        'name_and_last_name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'phone_number' => '+1234567890',
        'signatureBase64' => 'base64-encoded-signature',
        'firstCheckboxChecked' => 1,
        'lastCheckboxChecked' => 1
    ]);
    }
}