<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::latest('id')->paginate();
        return  view('admin.schedules.index', compact('schedules'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        $data = $request->all();
        $data['enable_collation'] = $request->has('enable_collation');

        Schedule::create($data);

        return redirect()->route('admin.schedules.index');
    }

 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit',compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'time_in' => 'required',
            'time_out' => 'required',
        ]);
        
        $data = $request->all();
        $data['enable_collation'] = $request->has('enable_collation');
        
        $schedule->update($data);
        return redirect()->route('admin.schedules.index', $schedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        // Eliminar el empleado
        $schedule->delete();

                    // Redirigir de nuevo a la lista de empleados con un mensaje de éxito
        return redirect()->route('admin.schedules.index')->with('success', 'Cargo eliminado correctamente');
    }
}
