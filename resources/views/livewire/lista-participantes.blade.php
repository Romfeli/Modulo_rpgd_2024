<div>
    <div class="p-4 bg-white text-gray-800">
        <!-- Botón para ver participantes -->
        <div class="flex justify-center mb-4">
            <button type="button" wire:click="toggleMostrarLista" 
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full sm:w-auto transition-colors duration-200">
            <i class="fas fa-users mr-2"></i> 

            Ver participantes
            </button>
        </div>
    
        <!-- Mostrar lista si está activada -->
        @if($mostrarLista)
        <h1 class="text-center text-lg font-semibold mb-6">Registros de hoy</h1>
        <div class="flex justify-center">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nombres y apellidos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase ">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase hidden md:table-cell">Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($participantes as $participante)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $participante->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $participante->name_and_last_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 ">{{ $participante->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 hidden md:table-cell">{{ $participante->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>