<div class="p-4 bg-white-900 text-black">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="flex justify-center ">
        <button type="button" wire:click="toggleMostrarLista" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Ver participantes
        </button>
    
        
    </div>
    
    @if($mostrarLista)
    
    <h1 class="text-center py-10 ">Registros de hoy</h1>
                      <div class="flex justify-center">
                    <table class="min-w-full divide-y divide-gray-200 bg-black shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white-300 uppercase tracking-wider">Nombres y apellidos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white-300 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white-300 uppercase tracking-wider">Fecha de Creación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($participantes as $participante)
                                <tr>
                                    <td class="px-6 py-4 ">{{ $participante->id }}</td>
                                    <td class="px-6 py-4 ">{{ $participante->name_and_last_name }}</td>
                                    
                                    <td class="px-6 py-4 ">{{ $participante->email }}</td>
                                    <td class="px-6 py-4 ">{{ $participante->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
    @endif
</div>

