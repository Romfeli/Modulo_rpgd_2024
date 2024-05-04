<?php

namespace Tests\Feature;

use App\Models\Participante;
use Livewire\Livewire;
use Tests\TestCase;

class BuscadorParticipanteTest extends TestCase
{
    /** @test */
    public function puede_buscar_participantes_por_dni()
    {
        // Crear algunos participantes para la prueba
        $participante1 = Participante::factory()->create(['dni' => '12345678']);
        $participante2 = Participante::factory()->create(['dni' => '87654321']);

        Livewire::test('buscador-participante')
            ->set('searchBy', 'dni')
            ->set('search', '1234') // Búsqueda que debe coincidir con $participante1
            ->assertSee($participante1->dni)
            ->assertDontSee($participante2->dni);
    }

    /** @test */
    public function puede_buscar_participantes_por_email()
    {
        // Crear algunos participantes para la prueba
        $participante1 = Participante::factory()->create(['email' => 'JuanPérez@s.com']);
        $participante2 = Participante::factory()->create(['email' => 'MaríaGarcía@c.com']);

        Livewire::test('buscador-participante')
            ->set('searchBy', 'email')
            ->set('search', 'Juan') // Búsqueda que debe coincidir con $participante1
            ->assertSee($participante1->email)
            ->assertDontSee($participante2->email);
    }

 /** @test */
 public function puede_buscar_participantes_por_nombre_y_apellido()
 {
     // Crear algunos participantes para la prueba
     $participante1 = Participante::factory()->create(['name_and_last_name' => 'Juan Pérez']);
     $participante2 = Participante::factory()->create(['name_and_last_name' => 'María García']);

     Livewire::test('buscador-participante')
         ->set('searchBy', 'name_and_last_name')
         ->set('search', 'Juan') // Búsqueda que debe coincidir con $participante1
         ->assertSee($participante1->name_and_last_name)
         ->assertDontSee($participante2->name_and_last_name);
 }
}
