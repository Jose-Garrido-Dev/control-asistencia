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
                'rut' => '11543567-7',
                'date' => '2024-06-01',
                'time_in' => '07:00:00',
                'status' => 1,
                'time_out' => '19:00:00',
                'num_hr' => 8,
            ],
            [
                'employee_id' => 2, // Rosbita
                'rut' => '17770742-2',
                'date' => '2024-06-01',
                'time_in' => '19:00:00',
                'status' => 1,
                'time_out' => '07:00:00',
                'num_hr' => 8,
            ],
            [
                'employee_id' => 3, // Carlos
                'rut' => '7299553-6',
                'date' => '2024-06-01',
                'time_in' => '14:00:00',
                'status' => 1,
                'time_out' => '22:00:00',
                'num_hr' => 8,
            ]
        ]);
    }
}
