<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedules')->insert([
            ['time_in' => '07:00:00', 'time_out' => '19:00:00'],
            ['time_in' => '19:00:00', 'time_out' => '07:00:00'],
            ['time_in' => '14:00:00', 'time_out' => '22:00:00'],
        ]);
    }
}
