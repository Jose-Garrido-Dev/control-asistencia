<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','rut', 'date', 'time_in',  'time_out','status', 'num_hr',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
