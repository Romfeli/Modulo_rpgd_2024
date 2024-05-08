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
        ->set('name_and_last_name', 'Jane Doe') // Ajusta la regla para permitir espacios
        ->set('email', 'jane@example.com')
        ->set('phone_number', '+123456789') // Asegúrate de que cumpla con la regla de 6 a 9 dígitos
        ->set('signatureBase64', 'data:image/png;base64,AAA...') // Usa un valor adecuado que cumpla con 'min:100'
        ->set('firstCheckboxChecked', 1)
        ->set('lastCheckboxChecked', 1)
        ->call('saveData');

    // Verificar que los datos se han guardado en la base de datos.
    $this->assertDatabaseHas('participantes', [
        'dni' => '12345678',
        'name_and_last_name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'phone_number' => '+123456789',
        'signatureBase64' => 'data:image/png;base64,AAA...',
        'firstCheckboxChecked' => 1,
        'lastCheckboxChecked' => 1
    ]);
}

}