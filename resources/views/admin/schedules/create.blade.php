<x-admin-layout>

    <h1 class="text-3xl font-semibold mb-2">
        Nuevo Horario
    </h1>

    <form action="{{route('admin.schedules.store')}}" 
        method="POST" >

        @csrf

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Horario de Entrada
            </x-label>

            <x-input name="time_in"
                type="time"
                value="{{old('time_in')}}"
                x-model="time_in"
                class="w-full" 
                placeholder="Ingrese el horario de entrada" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Horario de Salida
            </x-label>

            <x-input name="time_out"
                type="time"
                value="{{old('time_out')}}"
                x-model="time_out"
                class="w-full" 
                placeholder="Ingrese el horario de salida" />
        </div>


        <div class="flex justify-end">
            <x-button>
                Crear Nuevo Horario
            </x-button>
        </div>

    </form>

</x-admin-layout>