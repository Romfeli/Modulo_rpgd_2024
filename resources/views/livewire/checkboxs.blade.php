<!-- resources/views/livewire/checkboxs.blade.php -->

<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkboxs as $checkbox)
                    <tr>
                        <td>{{ $checkbox['id'] }}</td> <!-- Acceder al ID del checkbox -->
                        <td>
                            <input type="text" wire:model="checkboxs.{{ $loop->index }}.title" placeholder="Título">
                        </td>
                        <td>
                            <textarea wire:model="checkboxs.{{ $loop->index }}.content" placeholder="Contenido"></textarea>
                        </td>
                        <td>
                            <button type="submit" wire:click.prevent="updateCheckboxs({{ $checkbox['id'] }})">Actualizar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
