<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->nullable();
            $table->integer('assign_status')->default(0);
            $table->string('location');
            $table->string('longitude');
            $table->string('latitude');
            // Add other columns specific to the ServiceOrder table
            $table->unsignedBigInteger('meter_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('meter_id')->references('id')->on('meters')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('user_id')->references('employee_id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_orders');
    }
}
