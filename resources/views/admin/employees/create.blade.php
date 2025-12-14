<?php
// Obtener la fecha actual en formato YYYY-MM-DD
$currentDate = date('Y-m-d');
?>

<x-admin-layout>

    <h1 class="text-3xl font-semibold mb-2">
        Nuevo Empleado
    </h1>

    <form action="{{route('admin.employees.store')}}" 
        method="POST" >

        @csrf

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Rut
            </x-label>

            <x-input name="employee_id"
                value="{{old('employee_id')}}"
                x-model="employee_id"
                class="w-full" 
                placeholder="Ingrese el rut" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Nombre
            </x-label>

            <x-input name="firstName"
                value="{{old('firstName')}}"
                x-model="firstName"
                class="w-full" 
                placeholder="Ingrese los nombres" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Apellidos
            </x-label>

            <x-input name="lastName"
                value="{{old('lastName')}}"
                x-model="lastName"
                class="w-full" 
                placeholder="Ingrese el segundo apellid" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Dirección
            </x-label>

            <x-input name="address"
                value="{{old('address')}}"
                x-model="address"
                class="w-full" 
                placeholder="Ingrese la dirección" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Fecha de Nacimiento
            </x-label>

            <x-input type="date" name="birthdate"
                min="1920-01-01"  max="<?php echo $currentDate; ?>"
                value="{{old('birthdate')}}"
                x-model="birthdate"
                class="w-full" 
                placeholder="Ingrese la fecha de nacimiento" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Celular
            </x-label>

            <x-input name="phone"
                value="{{old('phone')}}"
                x-model="phone"
                class="w-full" 
                placeholder="Ingrese el nro de teléfono" />
        </div>

        <div class="mb-4">
            <x-label>
                Cargo
            </x-label>

            <x-select class="w-full" name="position_id">

                @foreach ($positions as $position)
                    <option @selected(old('position_id') == $position->id)
                        value="{{$position->id}}">
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
                    <option @selected(old('schedule_id') == $schedule->id)
                        value="{{$schedule->id}}">
                        {{$schedule->time_in}} - {{$schedule->time_out}}
                    </option>
                @endforeach

            </x-select>
        </div>
        


        <div class="flex justify-end">
            <x-button>
                Crear Empleado
            </x-button>
        </div>

    </form>

</x-admin-layout>