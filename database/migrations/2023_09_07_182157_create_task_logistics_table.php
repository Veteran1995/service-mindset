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
        Schema::create('task_logistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_report_id');
            $table->string('logistics')->nullable();
            $table->timestamps();

            $table->foreign('task_report_id')->references('id')->on('service_order_reports');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_logistics');
    }
};
