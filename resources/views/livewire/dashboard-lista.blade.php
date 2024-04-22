<!-- resources/views/livewire/today-records.blade.php -->

<div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombres y apellidos
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha de Creación
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($participantes as $participante)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->name_and_last_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
