<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeAtendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('employee_attendance.employeeAttendance');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin/employees', EmployeeController::class)
    ->except('show')
    ->names([
        'index' => 'admin.employees.index',
        'create' => 'admin.employees.create',
        'store' => 'admin.employees.store',
        'edit' => 'admin.employees.edit',
        'update' => 'admin.employees.update',
        'destroy' => 'admin.employees.destroy'
    ]);

    Route::resource('/admin/positions', PositionController::class)
        ->except('show')
        ->names([
            'index' => 'admin.positions.index',
            'create' => 'admin.positions.create',
            'store' => 'admin.positions.store',
            'edit' => 'admin.positions.edit',
            'update' => 'admin.positions.update',
            'destroy' => 'admin.positions.destroy'
        ]);

    Route::resource('/admin/schedules', ScheduleController::class)
        ->except('show')
        ->names([
            'index' => 'admin.schedules.index',
            'create' => 'admin.schedules.create',
            'store' => 'admin.schedules.store',
            'edit' => 'admin.schedules.edit',
            'update' => 'admin.schedules.update',
            'destroy' => 'admin.schedules.destroy'
        ]);

    Route::resource('/admin/attendances', AttendanceController::class)
        ->except('show')
        ->names([
            'index' => 'admin.attendances.index',
            'create' => 'admin.attendances.create',
            'store' => 'admin.attendances.store',
            'edit' => 'admin.attendances.edit',
            'update' => 'admin.attendances.update',
            'destroy' => 'admin.attendances.destroy'
        ]);

});


Route::middleware(['web'])->group(function () {
    // Ruta para mostrar el formulario de inicio de sesión de empleados
    Route::get('employee/login', [EmployeeController::class, 'employeeAttendance'])->name('employee.login');

    // Ruta para manejar la autenticación de empleados
    Route::post('employee/login', [EmployeeController::class, 'loginEmployee'])->name('employee.loguearse');

    // Ruta para el dashboard de empleados, protegida por el middleware
    Route::get('employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard')->middleware([\App\Http\Middleware\EmployeeAuth::class]);

    Route::get('employee/attendance', [EmployeeController::class, 'attendance'])->name('employee.attendance')->middleware([\App\Http\Middleware\EmployeeAuth::class]);

    Route::post('employee/logout', [EmployeeController::class, 'logoutEmployee'])->name('employee.logout');

    Route::post('employee/store',[EmployeeAtendanceController::class,'store'])->name('employee.store');
});