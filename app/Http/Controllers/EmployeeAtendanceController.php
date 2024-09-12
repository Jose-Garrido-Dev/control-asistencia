<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendancesExport;


class EmployeeAtendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
  
       
        // Validación de los datos del formulario
        $request->validate([
            'employee_id' => 'required'
        ]);

        $employee = Employee::where('employee_id', $request->employee_id)->first('id');
        if (!$employee) {
            return back()->with('error', 'Empleado no encontrado.');
        }
    
        $employee_id = $employee->id; // Acceder al valor del campo id

        if($request->time === 'in'){
            $currentTime = now()->format('H:i:s');
                    // Crear o actualizar el registro de asistencia

                // Verificar si ya existe un registro para hoy con 'time_in' ya registrado
            $existingAttendance = Attendance::where('employee_id', $employee_id)
                                                ->where('date', now()->toDateString())
                                                ->whereNotNull('time_in')
                                                ->first();

            if ($existingAttendance) {
            return back()->with('error', 'Ya se ha registrado una entrada para hoy.');
            }


        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $employee_id,
                'rut' => $request->employee_id,
                'date' => now()->toDateString(),
            ],
            [
                'time_in' => $currentTime, // Aquí se asigna la hora actual si es una entrada
                'time_out' => null, // Puedes decidir si asignar null o dejarlo como está
                'status' => 1, // Puedes ajustar esto según sea necesario
                'num_hr' => 0, // Puedes ajustar esto según sea necesario
            ]
        );
    
        // Devolver una redirección a la página anterior con un mensaje de éxito
        return back()->with('success', 'Asistencia registrada correctamente.');
        }

        if($request->time === 'out'){

            $currentTime = now()->format('H:i:s');

                    // Buscar el registro de asistencia del día de hoy para el empleado
            $attendance = Attendance::where('employee_id', $employee_id)
            ->where('date', now()->toDateString())
            ->first();

            if (!$attendance || !$attendance->time_in) {
                return back()->with('error', 'No se ha registrado una entrada para hoy.');
            }

                    // Verificar si ya se ha registrado una salida para hoy
        if ($attendance->time_out) {
            return back()->with('error', 'Ya se ha registrado una salida para hoy.');
        }

                    // Calcular las horas trabajadas
            $timeIn = Carbon::createFromFormat('H:i:s', $attendance->time_in);
            $timeOut = Carbon::createFromFormat('H:i:s', $currentTime);
            $numHr = $timeIn->diffInHours($timeOut);
            // Redondear hacia abajo (floor) o hacia arriba (ceil) según tu necesidad
            $numHr = floor($numHr);

            // Actualizar el registro de asistencia con la hora de salida y las horas trabajadas
            $attendance->update([
                'time_out' => $currentTime,
                'num_hr' => $numHr,
            ]);

            // Devolver una redirección a la página anterior con un mensaje de éxito
            return back()->with('success', 'Salida registrada correctamente.');
           }

        // En caso de que no se cumpla ninguna condición
        return back()->with('error', 'Operación no válida.');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function export()
    {
        return Excel::download(new AttendancesExport, 'attendances.xlsx');
    }

}
