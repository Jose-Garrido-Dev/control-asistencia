<x-admin-layout>

    <h1 class="text-3xl font-semibold mb-2">
        Actualizar Cargo
    </h1>

    <form action="{{route('admin.positions.update',$position)}}" 
        method="POST" >

        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Cargo
            </x-label>

            <x-input name="description"
                value="{{$position->description}}"
                class="w-full" 
                placeholder="Ingrese el cargo" />
        </div>     


        <div class="flex justify-end">
            <x-button>
                Actualizar Cargo
            </x-button>
        </div>

    </form>

</x-admin-layout>