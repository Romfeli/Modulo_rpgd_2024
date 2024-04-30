<?php

namespace Tests\Feature;

use App\Models\Checkbox;
use App\Livewire\Checkboxs;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckboxsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_checkbox_successfully()
    {
        // Crear un checkbox para actualizar
        $checkbox = Checkbox::factory()->create([
            'title' => 'Título inicial',
            'content' => 'Contenido inicial',
        ]);

        // Inicializar el componente Livewire con el checkbox existente
        Livewire::test(Checkboxs::class, ['checkboxs' => [$checkbox->toArray()]])
            ->set('checkboxs.0.title', 'Nuevo Título') // Actualizar el título del checkbox
            ->set('checkboxs.0.content', 'Nuevo Contenido') // Actualizar el contenido del checkbox
            ->call('updateCheckboxs', $checkbox->id); // Llamar al método para actualizar

        // Verificar que el checkbox se haya actualizado en la base de datos
        $this->assertDatabaseHas('checkboxes', [
            'id' => $checkbox->id,
            'title' => 'Nuevo Título', // Verificar el nuevo título esperado
            'content' => 'Nuevo Contenido', // Verificar el nuevo contenido esperado
        ]);
    }
}
