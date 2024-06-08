<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attendances')->insert([
            [
                'employee_id' => 1, // Alice
                'date' => '2024-06-01',
                'time_in' => '07:00:00',
                'status' => 1,
                'time_out' => '19:00:00',
                'num_hr' => 8,
            ],
            [
                'employee_id' => 2, // Bob
                'date' => '2024-06-01',
                'time_in' => '19:00:00',
                'status' => 1,
                'time_out' => '07:00:00',
                'num_hr' => 8,
            ],
            [
                'employee_id' => 3, // Charlie
                'date' => '2024-06-01',
                'time_in' => '14:30:00',
                'status' => 1,
                'time_out' => '22:00:00',
                'num_hr' => 8,
            ]
        ]);
    }
}
