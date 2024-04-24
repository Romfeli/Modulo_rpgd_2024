<?php

namespace Tests\Feature;
use App\Livewire\ListaParticipantes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Participante;

use Livewire\Livewire;


class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function muestra_la_lista_de_participantes(): void
    {
        // Insertar algunos datos de ejemplo en la tabla participantes
        Participante::factory()->count(5)->create();
    
        // Renderizar el componente Livewire y obtener la instancia
        $component = Livewire::test(ListaParticipantes::class);
    
        // Verificar que el botón "Ver participantes" está presente
        $component->assertSee('Ver participantes');
    
        // Hacer clic en el botón para mostrar la lista de participantes
        $component->call('toggleMostrarLista');
    
        // Verificar que la lista de participantes se muestra correctamente
        foreach (Participante::all() as $participante) {
            $component->assertSee($participante->name_and_last_name);
        }
    }
    

    
    public function manda_ok_el_formulario(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
  
}
