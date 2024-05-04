<div class="p-4">
    <div class="flex mb-4">
        <select wire:model="searchBy" class="mr-2 p-2 rounded border border-gray-300">
            <option value="dni">DNI</option>
            <option value="name_and_last_name">Nombre y Apellido</option>
            <option value="email">Email</option>
            <option value="phone_number">Número de Teléfono</option>
        </select>

        <input type="text" wire:model.live="search" class="p-2 rounded border border-gray-300 flex-grow" placeholder="Search...">
    </div>

    <ul>
        @foreach($participantes as $participante)
            <li class="mb-2 p-2 ">
                <span class="font-bold">DNI:</span> {{ $participante->dni }}, 
                <span class="font-bold">Email:</span> {{ $participante->email }},
                <span class="font-bold">Nombre y apellido:</span> {{ $participante->name_and_last_name }}
            </li>
        @endforeach
    </ul>
</div>
