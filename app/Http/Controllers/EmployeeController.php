<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

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
            'employee_id' => 'required|unique:employees|max:20',
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'birthdate' => 'required|date|before:today',
            'phone' => 'required|digits_between:8,10|numeric',
            'position_id' => 'required|exists:positions,id',
            'schedule_id' => 'required|exists:schedules,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'employee_id.required' => 'El RUT/DNI es obligatorio.',
            'employee_id.unique' => 'Este RUT/DNI ya está registrado.',
            'employee_id.max' => 'El RUT/DNI no puede tener más de 20 caracteres.',
            'firstName.required' => 'El nombre es obligatorio.',
            'firstName.max' => 'El nombre no puede tener más de 50 caracteres.',
            'lastName.required' => 'El apellido es obligatorio.',
            'lastName.max' => 'El apellido no puede tener más de 50 caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede tener más de 500 caracteres.',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria.',
            'birthdate.date' => 'La fecha de nacimiento no es válida.',
            'birthdate.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits_between' => 'El teléfono debe tener entre 8 y 10 dígitos.',
            'phone.numeric' => 'El teléfono solo debe contener números.',
            'position_id.required' => 'Debe seleccionar un cargo.',
            'position_id.exists' => 'El cargo seleccionado no existe.',
            'schedule_id.required' => 'Debe seleccionar un horario.',
            'schedule_id.exists' => 'El horario seleccionado no existe.',
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'photo.max' => 'La imagen no puede ser mayor a 2MB.',
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
            'employee_id' => 'required|unique:employees,employee_id,'. $employee->id . '|max:20',
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'birthdate' => 'required|date|before:today',
            'phone' => 'required|digits_between:8,10|numeric',
            'position_id' => 'required|exists:positions,id',
            'schedule_id' => 'required|exists:schedules,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'employee_id.required' => 'El RUT/DNI es obligatorio.',
            'employee_id.unique' => 'Este RUT/DNI ya está registrado.',
            'employee_id.max' => 'El RUT/DNI no puede tener más de 20 caracteres.',
            'firstName.required' => 'El nombre es obligatorio.',
            'firstName.max' => 'El nombre no puede tener más de 50 caracteres.',
            'lastName.required' => 'El apellido es obligatorio.',
            'lastName.max' => 'El apellido no puede tener más de 50 caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede tener más de 500 caracteres.',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria.',
            'birthdate.date' => 'La fecha de nacimiento no es válida.',
            'birthdate.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits_between' => 'El teléfono debe tener entre 8 y 10 dígitos.',
            'phone.numeric' => 'El teléfono solo debe contener números.',
            'position_id.required' => 'Debe seleccionar un cargo.',
            'position_id.exists' => 'El cargo seleccionado no existe.',
            'schedule_id.required' => 'Debe seleccionar un horario.',
            'schedule_id.exists' => 'El horario seleccionado no existe.',
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'photo.max' => 'La imagen no puede ser mayor a 2MB.',
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
    
            // Obtener el empleado completo con su horario
            $employeeData = Employee::with('schedule')->find($employee->id);
            $schedule = $employeeData->schedule;
    
            // Pasar los datos del empleado a la vista del dashboard
            $employees=Employee::all();
            $totalEmployees = $employees->count();
            return view('employee_attendance.index', compact('employee', 'firstName', 'lastName','totalEmployees', 'schedule'));
        }

        public function logoutEmployee(Request $request)
        {
            $request->session()->forget(['employee', 'firstName', 'lastName']);
            $request->session()->flush(); // Para asegurar que la sesión se limpie completamente
    
            return redirect()->route('employee.login');
        }

        public function attendance(Request $request){
            $employee = session('employee');
            $employeeId = $employee['employee_id'];


            // Filtrar las asistencias por el rut del usuario logueado para la vista
            $attendances = Attendance::where('rut', $employeeId)->get();
            return view('employee_attendance.attendance',compact('attendances'));
        }
}
