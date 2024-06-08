<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'firstName', 'lastName', 'address', 'birthdate', 'phone', 'position_id', 'schedule_id', 'photo',
    ];
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    
}
