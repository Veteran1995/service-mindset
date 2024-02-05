<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('body');
            $table->text('status')->default('unread');
            $table->text('notification')->default('unseen');
            $table->string('sender_id');
            $table->foreign('sender_id')->references('employee_id')->on('users');
            $table->string('receiver_id');
            $table->foreign('receiver_id')->references('employee_id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
