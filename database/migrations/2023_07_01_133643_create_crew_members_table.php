<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewMembersTable extends Migration
{
    public function up()
    {
        Schema::create('crew_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crew_id');
            $table->foreign('crew_id')->references('id')->on('crews');
            $table->string('member_id');
            $table->foreign('member_id')->references('employee_id')->on('users');
            // Add other crew member fields

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crew_members');
    }
}
