<?php

// database/migrations/YYYY_MM_DD_HHmmss_create_meters_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetersTable extends Migration
{
    public function up()
    {
        Schema::create('meters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('serial_number');
            $table->string('seal_tag');
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meters');
    }
}
