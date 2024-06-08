<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'firstName' => 'John',
                'lastName' => 'Doe',
                'photo' => 'photos/admin1.jpg',
            ],
            [
                'username' => 'admin2',
                'password' => Hash::make('admin2'),
                'firstName' => 'Jane',
                'lastName' => 'Smith',
                'photo' => 'photos/admin2.jpg',
            ],
            [
                'username' => 'admin3',
                'password' => Hash::make('admin3'),
                'firstName' => 'Jim',
                'lastName' => 'Beam',
                'photo' => 'photos/admin3.jpg',
            ]
        ]);
    }
}
