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
        Schema::create('assigment_meters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assign_id');
            $table->integer('meter_id');
            $table->timestamps();

            $table->foreign('meter_id')->references('id')->on('meter_data');
            $table->foreign('assign_id')->references('id')->on('meter_assignments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigment_meters');
    }
};
