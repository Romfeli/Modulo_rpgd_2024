<?php

namespace Tests\Feature;

use App\Models\LegalText;
use App\Livewire\LegalTexts;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LegaltextTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_legal_text_successfully()
    {
        // Crear un checkbox para actualizar
        $legaltext = LegalText::factory()->create([
            'title' => 'Título inicial',
            'content' => 'Contenido inicial',
        ]);

        // Inicializar el componente Livewire con el checkbox existente
        Livewire::test(LegalTexts::class, ['legaltexts' => [$legaltext->toArray()]])
            ->set('legaltexts.0.title', 'Nuevo Título') // Actualizar el título del checkbox
            ->set('legaltexts.0.content', 'Nuevo Contenido') // Actualizar el contenido del checkbox
            ->call('updateLegaltext', $legaltext->id); // Llamar al método para actualizar

        // Verificar que el checkbox se haya actualizado en la base de datos
        $this->assertDatabaseHas('legal_texts', [
            'id' => $legaltext->id,
            'title' => 'Nuevo Título', // Verificar el nuevo título esperado
            'content' => 'Nuevo Contenido', // Verificar el nuevo contenido esperado
        ]);
    }
}
