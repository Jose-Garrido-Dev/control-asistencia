<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

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

        if($request->time === 'in'){
            $currentTime = now()->format('H:i:s');
                    // Crear o actualizar el registro de asistencia
        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
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
            return "usted ha salido";
        }

        // Obtener la hora actual en formato hh:mm:ss
        


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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
