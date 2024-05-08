<div class="flex justify-center">
    <div class="p-4 w-full sm:w-11/12 md:w-10/12 lg:w-8/12 xl:w-7/12">
        <h3 class="text-lg font-medium leading-6 text-gray-900 text-center mb-4">Buscador:</h3>
        <div class="p-4 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col md:flex-row items-center justify-center mb-4">
                <select wire:model="searchBy" class="p-2 rounded border border-gray-300 mb-2 md:mb-0">
                    <option value="dni">DNI</option>
                    <option value="name_and_last_name">Nombre y Apellido</option>
                    <option value="email">Email</option>
                    <option value="phone_number">Número de Teléfono</option>
                </select>
    
                <input type="text" wire:model.live="search" class="p-2 rounded border border-gray-300 flex-grow w-full md:w-auto ml-2" placeholder="Buscar...">
            </div>
    
            @if($participantes->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">DNI</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Nombre y Apellido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participantes as $participante)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 text-sm">{{ $participante->dni }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $participante->email }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $participante->name_and_last_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-gray-500 mt-4">No se encontraron participantes.</p>
            @endif
        </div>
    </div>
</div>
