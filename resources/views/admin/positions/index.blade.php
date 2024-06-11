<x-admin-layout>
    
    <div class="flex justify-end mb-4">
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{route('admin.positions.create')}}">Nuevo</a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cargo
                    </th>

                    <th scope="col" class="px-6 py-3">
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($positions as $i => $position)
                
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $i+1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $position->description }}
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{route('admin.positions.edit', $position)}}">Editar</a>
                        </td>

                        <td>
                            <form id="frm_{{$position->id}}" method="POST" action="{{route('admin.positions.destroy', $position)}}" onsubmit="return confirmDelete('{{ $position->description }}')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Borrar<i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $positions->links() }}
    </div>
</x-admin-layout>

<script>
    function confirmDelete(name) {
        return confirm('¿Está seguro que desea eliminar el cargo ' + name + '?');
    }
</script>