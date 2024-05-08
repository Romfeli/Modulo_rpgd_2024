<div>
<div class="flex justify-center">
    <div class="w-full lg:w-10/12 xl:w-8/12">
        <div class="py-4 px-2 sm:px-4">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Editar Checkboxes</h3>
                </div>
                <div class="border-t border-gray-200">
                    <div class="table-responsive">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contenido</th>
                                    <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($checkboxs as $checkbox)
                                    <tr>
                                        <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">{{ $checkbox['id'] }}</td>
                                        <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                            <input type="text" wire:model="checkboxs.{{ $loop->index }}.title" class="block w-full px-2 sm:px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Título">
                                        </td>
                                        <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                            <textarea wire:model="checkboxs.{{ $loop->index }}.content" class="block w-full px-2 sm:px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Contenido"></textarea>
                                        </td>
                                        <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                            <button type="button" wire:click.prevent="updateCheckboxs({{ $checkbox['id'] }})" class="inline-flex items-center px-3 sm:px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
</div>

<div class="flex justify-center mt-4">
    <div x-data="{ show: false }"
         x-show="show"
         x-init="@this.on('checkboxUpdated', () => { show = true; setTimeout(() => show = false, 2000); })"
         class="p-2 sm:p-4 bg-green-100 border border-green-400 text-center text-green-700 rounded-md transition-opacity duration-500 ease-in-out"
         style="z-index: 50;"
         role="alert">
        {{ session('success') }}
    </div>
</div>
</div>
