<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Schedule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest('id')->paginate();
        $positions = Position::all();
        $schedules = Schedule::all();

        return view('admin.employees.index',compact('employees','positions','schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $schedules = Schedule::all();
        return view('admin.employees.create', compact('positions','schedules'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'employee_id' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'birthdate' => 'required|date',
            'phone' => 'required',
            'position_id' => 'required|exists:positions,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        Employee::create($request->all());

        return redirect()->route('admin.employees.index');


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
