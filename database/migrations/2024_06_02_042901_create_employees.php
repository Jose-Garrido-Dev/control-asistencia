<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->text('address');
            $table->date('birthdate');
            $table->string('phone', 10);
            $table->foreignId('position_id')->constrained('positions');
            $table->foreignId('schedule_id')->constrained('schedules');
            $table->string('photo', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
