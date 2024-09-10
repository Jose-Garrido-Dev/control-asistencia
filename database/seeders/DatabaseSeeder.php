<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

    //    User::factory()->create([
      //      'name' => 'Test User',
       //     'email' => 'test@example.com',
        //]);
                User::factory()->create([
            'rut' => '11111111-1',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        $this->call([
            AdminSeeder::class,
            PositionSeeder::class,
            ScheduleSeeder::class,
            EmployeeSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}
