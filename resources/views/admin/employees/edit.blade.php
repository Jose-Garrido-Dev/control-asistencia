<?php
// Obtener la fecha actual en formato YYYY-MM-DD
$currentDate = date('Y-m-d');
?>

<x-admin-layout>

    <h1 class="text-3xl font-semibold mb-2">
        Actualizar Empleado
    </h1>

    <form action="{{route('admin.employees.update',$employee)}}" 
        method="POST" >

        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Rut
            </x-label>

            <x-input name="employee_id"
                value="{{$employee->employee_id}}"
                class="w-full" 
                placeholder="Ingrese el rut" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Nombre
            </x-label>

            <x-input name="firstName"
                value="{{$employee->firstName}}"
                class="w-full" 
                placeholder="Ingrese los nombres" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Apellidos
            </x-label>

            <x-input name="lastName"
                value="{{$employee->lastName}}"
                class="w-full" 
                placeholder="Ingrese el segundo apellido" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Dirección
            </x-label>

            <x-input name="address"
                value="{{$employee->address}}"
                class="w-full" 
                placeholder="Ingrese la dirección" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Fecha de Nacimiento
            </x-label>

            <x-input type="date" name="birthdate"
                min="1920-01-01"  max="<?php echo $currentDate; ?>"
                value="{{$employee->birthdate}}"
                class="w-full" 
                placeholder="Ingrese la fecha de nacimiento" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Celular
            </x-label>

            <x-input name="phone"
                value="{{$employee->phone}}"
                class="w-full" 
                placeholder="Ingrese el nro de teléfono" />
        </div>

        <div class="mb-4">
            <x-label>
                Cargo
            </x-label>

            <x-select class="w-full" name="position_id">

                @foreach ($positions as $position)
                    <option value="{{$position->id}}" @if($employee->position_id == $position->id) selected @endif>
                        {{$position->description}}
                    </option>
                @endforeach

            </x-select>
        </div>

        <div class="mb-4">
            <x-label>
                Horario colaborador
            </x-label>

            <x-select class="w-full" name="schedule_id">

                @foreach ($schedules as $schedule)
                    <option value="{{$schedule->id}}" @if($employee->schedule_id == $schedule->id) selected @endif>
                        {{$schedule->time_in}} - {{$schedule->time_out}}
                    </option>
                @endforeach

            </x-select>
        </div>
        


        <div class="flex justify-end">
            <x-button>
                Actualizar Empleado
            </x-button>
        </div>

    </form>

</x-admin-layout>