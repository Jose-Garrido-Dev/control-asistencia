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
    $request->validate([
        'employee_id' => 'required'
    ]);

    $employee = Employee::with('schedule')->where('employee_id', $request->employee_id)->first();
    if (!$employee) {
        return back()->with('error', 'Empleado no encontrado.');
    }
    
    $employee_id = $employee->id;
    $schedule = $employee->schedule;
    $currentTime = now()->format('H:i:s');
    $attendance = Attendance::where('employee_id', $employee_id)
                            ->where('date', now()->toDateString())
                            ->first();

    // Verificar el tipo de registro (entrada, salida, inicio colación, término colación)
    switch ($request->time) {
        case 'in':
            if ($attendance && $attendance->time_in) {
                return back()->with('error', 'Ya se ha registrado una entrada para hoy.');
            }
            
            // Determinar si llegó a tiempo o atrasado
            $status = 1; // Por defecto a tiempo
            if ($schedule) {
                $scheduledTime = Carbon::createFromFormat('H:i:s', $schedule->time_in);
                $actualTime = Carbon::createFromFormat('H:i:s', $currentTime);
                
                // Si la hora actual es mayor que la hora programada, está atrasado
                if ($actualTime->gt($scheduledTime)) {
                    $status = 2; // Atrasado
                }
            }
            
            Attendance::updateOrCreate(
                ['employee_id' => $employee_id, 'date' => now()->toDateString()],
                ['rut' => $employee->employee_id, 'time_in' => $currentTime, 'status' => $status, 'num_hr' => 0]
            );
            return back()->with('success', 'Entrada registrada correctamente.');

        case 'out':
            if (!$attendance || !$attendance->time_in || $attendance->time_out) {
                return back()->with('error', 'No se puede registrar la salida.');
            }
            
            // Crear objetos Carbon con la fecha completa para manejar turnos nocturnos
            $timeIn = Carbon::parse($attendance->date . ' ' . $attendance->time_in);
            $timeOut = Carbon::parse(now()->toDateString() . ' ' . $currentTime);
            
            // Si la hora de salida es menor que la hora de entrada, añadir un día (turno nocturno)
            if ($timeOut->lt($timeIn)) {
                $timeOut->addDay();
            }
            
            // Calcular horas trabajadas con decimales
            $numHr = round($timeIn->diffInHours($timeOut, true), 2);
            
            $attendance->update(['time_out' => $currentTime, 'num_hr' => $numHr]);
            return back()->with('success', 'Salida registrada correctamente.');

        case 'in-collation':
            if (!$schedule || !$schedule->enable_collation) {
                return back()->with('error', 'El registro de colación no está habilitado para su horario.');
            }
            if (!$attendance || !$attendance->time_in) {
                return back()->with('error', 'Debe registrar una entrada antes de iniciar la colación.');
            }
            if ($attendance->start_collation) {
                return back()->with('error', 'Inicio de colación ya registrado.');
            }
            $attendance->update(['start_collation' => $currentTime]);
            return back()->with('success', 'Inicio de colación registrado correctamente.');

        case 'out-collation':
            if (!$schedule || !$schedule->enable_collation) {
                return back()->with('error', 'El registro de colación no está habilitado para su horario.');
            }
            if (!$attendance || !$attendance->time_in) {
                return back()->with('error', 'Debe registrar una entrada antes de terminar la colación.');
            }
            if (!$attendance->start_collation || $attendance->end_collation) {
                return back()->with('error', 'No se puede registrar el término de colación.');
            }
            $attendance->update(['end_collation' => $currentTime]);
            return back()->with('success', 'Término de colación registrado correctamente.');
        
        default:
            return back()->with('error', 'Operación no válida.');
    }
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
