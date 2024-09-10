<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalEmployees = Employee::count();

        //Obtener la fecha actual
        $today = Carbon::today();


         // Contar los empleados a tiempo y atrasados basados en el estado de hoy
         $employeesOnTime = Attendance::where('date', $today)->where('status', 1)->count();
         $employeesLate = Attendance::where('date', $today)->where('status', 2)->count();
 
         return view('admin.dashboard', compact('totalEmployees','employeesOnTime', 'employeesLate'));
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
        //
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
