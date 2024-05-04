



<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Editar Textos Legales</h3>
        </div>
        <div class="border-t border-gray-200">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contenido</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($legaltexts as $legaltext)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $legaltext->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text" wire:model="legaltexts.{{ $loop->index }}.title" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Título">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <textarea wire:model="legaltexts.{{ $loop->index }}.content" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Contenido"></textarea>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button type="button" wire:click.prevent="updateLegaltext({{ $legaltext->id }})" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Actualizar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
