<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'employee_id' => '11543567-7',
                'firstName' => 'Alice',
                'lastName' => 'Johnson',
                'address' => '123 Main St',
                'birthdate' => '1985-05-15',
                'phone' => '1234567890',
                'position_id' => 1, // Administrador
                'schedule_id' => 1, // 07:00-19:00
                'photo' => 'photos/employee1.jpg',
            ],
            [
                'employee_id' => '17770742-2',
                'firstName' => 'Rosbita',
                'lastName' => 'Reyes',
                'address' => '456 Oak St',
                'birthdate' => '1990-08-20',
                'phone' => '0987654321',
                'position_id' => 2, // Desarrollador
                'schedule_id' => 2, // 19:00-07:00
                'photo' => 'photos/employee2.jpg',
            ],
            [
                'employee_id' => '7299553-6',
                'firstName' => 'Carlos',
                'lastName' => 'Davis',
                'address' => '789 Pine St',
                'birthdate' => '1988-12-25',
                'phone' => '1122334455',
                'position_id' => 3, // Diseñador
                'schedule_id' => 3, // 14:00-22:00
                'photo' => 'photos/employee3.jpg',
            ]
        ]);
    }
}
