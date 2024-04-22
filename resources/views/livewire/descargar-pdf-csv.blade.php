<div>
    <div class="flex justify-center mt-4">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Descargar</h2>
                    <form wire:submit.prevent="downloadPDF">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label for="fechaInicio" class="block text-sm font-medium text-gray-700">Fecha Inicial:</label>
                                <input wire:model="fechaInicio" type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="fechaInicio" name="fechaInicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaFin" class="block text-sm font-medium text-gray-700">Fecha Fin:</label>
                                <input wire:model="fechaFin" type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="fechaFin" name="fechaFin" required>
                            </div>
                        </div>
                        <div class="flex justify-between mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">Descargar PDF</button>
                            <button type="button" wire:click.prevent="downloadCSV" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">Descargar CSV</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
