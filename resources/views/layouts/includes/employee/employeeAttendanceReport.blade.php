

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                    Horario
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
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $i => $attendance)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                        @if ($attendance->employee->schedule)
                            {{ $attendance->employee->schedule->time_in }} - {{ $attendance->employee->schedule->time_out }}
                         @endif
                    </td>

                    <td class="px-6 py-4">
                        {{ $attendance->time_in }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $attendance->time_out }}
                    </td>

                    <td class="px-6 py-4">
                            @if ($attendance->status == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-1 px-1 py-0.1 rounded dark:bg-green-900 dark:text-green-300">A tiempo</span>
                            @elseif ($attendance->status == 2)
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-1 px-1 py-0.1 rounded dark:bg-red-900 dark:text-red-300">Atraso</span>
                            @else
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-1 px-1 py-0.1 rounded dark:bg-gray-700 dark:text-gray-300">No especifica</span>
                            @endif
                    </td>

                    <td class="px-6 py-4">
                        @if($attendance->time_out)
                            <span class="font-semibold text-gray-600">{{ number_format($attendance->num_hr, 2) }} hrs</span>
                        @else
                            <span class="text-gray-400 italic">En progreso...</span>
                        @endif
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
