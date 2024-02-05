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
        Schema::create('meter_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('energy_type');
            $table->string('reading_circle');
            $table->timestamps();

            $table->foreign('user_id')->references('employee_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_assignments');
    }
};
