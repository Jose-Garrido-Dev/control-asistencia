<x-admin-layout>

    <h1 class="text-3xl font-semibold mb-2">
        Nuevo Cargo
    </h1>

    <form action="{{route('admin.positions.store')}}" 
        method="POST" >

        @csrf

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Cargo
            </x-label>

            <x-input name="description"
                value="{{old('description')}}"
                x-model="description"
                class="w-full" 
                placeholder="Ingrese el nombre del cargo" />
        </div>


        <div class="flex justify-end">
            <x-button>
                Crear Cargo
            </x-button>
        </div>

    </form>

</x-admin-layout>