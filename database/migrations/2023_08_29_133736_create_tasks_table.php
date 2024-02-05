<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status')->default('Open');
            $table->dateTime('assign_date');
            $table->dateTime('due_date');
            $table->string('priority');
            $table->unsignedBigInteger('service_order_id')->nullable();
            $table->unsignedBigInteger('crew_id')->nullable();

            $table->string('assigned_to_id');
            $table->foreign('assigned_to_id')->references('employee_id')->on('users');

            $table->string('assigned_by_id');
            $table->foreign('assigned_by_id')->references('employee_id')->on('users');
            $table->timestamps();
            $table->foreign('crew_id')->references('id')->on('crews')->onDelete('set null');

            $table->foreign('service_order_id')->references('id')->on('service_order_data')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
