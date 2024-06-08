<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttendanceController;

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return "Hola mundo";
});