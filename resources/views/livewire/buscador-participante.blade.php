<div class="p-4">
    <div class="flex mb-4">
        <select wire:model="searchBy" class="mr-2 p-2 rounded border border-gray-300">
            <option value="dni">DNI</option>
            <option value="name_and_last_name">Nombre y Apellido</option>
            <option value="email">Email</option>
            <option value="phone_number">Número de Teléfono</option>
        </select>

        <input type="text" wire:model.live="search" class="p-2 rounded border border-gray-300 flex-grow" placeholder="Buscar...">
    </div>

    @if($participantes->count() > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre y Apellido</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($participantes as $participante)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->dni }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->name_and_last_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center text-gray-500 mt-4">No se encontraron participantes.</p>
    @endif
</div>
