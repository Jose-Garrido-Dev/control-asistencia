<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Actualizar registros existentes sin time_out a num_hr = 0
        DB::table('attendances')
            ->whereNull('time_out')
            ->update(['num_hr' => 0]);
            
        Schema::table('attendances', function (Blueprint $table) {
            $table->double('num_hr', 8, 2)->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->double('num_hr', 8, 2)->nullable()->default(8)->change();
        });
    }
};
