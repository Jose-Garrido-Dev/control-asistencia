<x-admin-layout>

    <h1 class="text-3xl font-semibold mb-2">
        Editar Horario
    </h1>

    <form action="{{route('admin.schedules.update', $schedule)}}" 
        method="POST" >

        @csrf
        @method('PUT')
        
        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Horario de Entrada
            </x-label>

            <x-input name="time_in"
                type="time"
                value="{{$schedule->time_in}}"
                class="w-full"  />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Horario de Salida
            </x-label>

            <x-input name="time_out"
                type="time"
                value="{{$schedule->time_out}}"
                class="w-full"  />
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" 
                    name="enable_collation" 
                    value="1" 
                    {{ $schedule->enable_collation ? 'checked' : '' }}
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">Habilitar registro de colación</span>
            </label>
        </div>

        <div class="flex justify-end">
            <x-button>
                Actualizar Horario
            </x-button>
        </div>

    </form>

</x-admin-layout>