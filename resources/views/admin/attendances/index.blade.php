    <x-admin-layout>
    
        <div class="flex justify-end mb-4">
            <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{route('admin.attendances.create')}}">Nuevo</a>
        </div>
    
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Rut Colaborador
                        </th>
    
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Hora de entrada
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Hora de salida
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Horas trabajadas
                        </th>
    
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $i => $attendance)
                    
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $i+1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $attendance->employee->employee_id }}
                            </td>
    
                            <td class="px-6 py-4">
                                {{ $attendance->date }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $attendance->time_in }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $attendance->time_out }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $attendance->status }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $attendance->num_hour }}
                            </td>
    
                            <td class="px-6 py-4">
                                <a href="{{route('admin.attendances.edit', $attendance)}}">Editar</a>
                            </td>
    
                            <td>
                                <form id="frm_{{$attendance->id}}" method="POST" action="{{route('admin.attendances.destroy', $attendance)}}" onsubmit="return confirmDelete('{{ $attendance->time_in }} - {{ $attendance->time_out  }}')">
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
            {{ $attendances->links() }}
        </div>
    </x-admin-layout>
    
    <script>
        function confirmDelete(name) {
            return confirm('¿Está seguro que desea eliminar el Horario ' + name + '?');
        }
    </script>