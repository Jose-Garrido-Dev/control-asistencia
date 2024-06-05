<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['time_in', 'time_out'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
