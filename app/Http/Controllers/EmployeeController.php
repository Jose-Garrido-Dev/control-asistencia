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
            'employee_id' => 'required|unique:employees',
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
    public function edit(Employee $employee)
    {

        $positions = Position::all();
        $schedules = Schedule::all();

        return view('admin.employees.edit', compact('employee','positions','schedules'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {

        $request->validate([
            'employee_id' => 'required|unique:employees,employee_id,'. $employee->id,
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'birthdate' => 'required|date',
            'phone' => 'required',
            'position_id' => 'required|exists:positions,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        $employee->update($request->all());
        return redirect()->route('admin.employees.index', $employee);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {

    // Eliminar el empleado
    $employee->delete();

    // Redirigir de nuevo a la lista de empleados con un mensaje de éxito
    return redirect()->route('admin.employees.index')->with('success', 'Empleado eliminado correctamente');
    }


    public function employeeAttendance(){
        return view('employee_attendance.employeeAttendance');
    }

        // Maneja la autenticación de empleados
        public function loginEmployee(Request $request)
        {
            
            $request->validate([
                'employee_id' => 'required',
                'password' => 'required',
            ]);
    
            $employee = Employee::where('employee_id', $request->employee_id)->first();
    
            if ($employee && substr($employee->employee_id, 0, 4) == $request->password) {
                // Aquí puedes autenticar al empleado de la manera que prefieras
                // Por ejemplo, usando una sesión personalizada:
                
                session([
                    'employee' => $employee,
                    'firstName' => $employee->firstName,
                    'lastName' => $employee->lastName,
                ]);

                //$data = $request->session()->all();

                //return $data;

           
                return redirect()->route('employee.dashboard',compact('employee')); // Cambia esto según tu necesidad
            }
    
            return back()->withErrors([
                'employee_id' => 'La clave o el usuario ingresado no son correctos.',
            ]);
        }

        public function dashboard()
        {
            // Obtener los datos del empleado desde la sesión
            $employee = session('employee');
            $firstName = session('firstName');
            $lastName = session('lastName');
    
            // Verificar que los datos de la sesión están presentes
            if (!$employee) {
                return redirect()->route('employee.login')->withErrors('Por favor, inicia sesión primero.');
            }
    
            // Pasar los datos del empleado a la vista del dashboard

            $employees=Employee::all();
            $totalEmployees = $employees->count();
            return view('employee_attendance.index', compact('employee', 'firstName', 'lastName','totalEmployees'));
        }

        public function logoutEmployee(Request $request)
        {
            $request->session()->forget(['employee', 'firstName', 'lastName']);
            $request->session()->flush(); // Para asegurar que la sesión se limpie completamente
    
            return redirect()->route('employee.login');
        }
}
