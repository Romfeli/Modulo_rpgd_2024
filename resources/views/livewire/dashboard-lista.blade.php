<div>
    <div class="flex justify-center">
        <div class="w-full sm:w-11/12 lg:w-10/12 xl:w-8/12">
            <div class="py-6 px-2 sm:px-4">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Registros de Hoy</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres y Apellidos</th>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Creación</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($participantes as $participante)
                                    <tr>
                                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">{{ $participante->id }}</td>
                                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">{{ $participante->name_and_last_name }}</td>
                                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">{{ $participante->email }}</td>
                                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">{{ $participante->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
