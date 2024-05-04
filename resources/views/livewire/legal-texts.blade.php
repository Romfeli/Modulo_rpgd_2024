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
                @foreach($legaltexts as $legaltext)
                    <tr>
                        <td>{{ $legaltext->id }}</td>
                        <td>
                            <input type="text" wire:model="legaltexts.{{ $loop->index }}.title" placeholder="Título">
                        </td>
                        <td>
                            <textarea wire:model="legaltexts.{{ $loop->index }}.content" placeholder="Contenido"></textarea>
                        </td>
                        <td>
                            <button type="button" wire:click.prevent="updateLegaltext({{ $legaltext->id }})">Actualizar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
