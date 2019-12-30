<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('meter_type');
            $table->integer('meter_phase');
            $table->integer('meter_voltage');
            $table->integer('meter_digit');
            $table->string('meter_decimal');
            $table->string('mfg_date');
            $table->string('meter_serial_number');
            $table->string('meter_manufacture');
            $table->string('initial_reading');
            $table->string('meter_company');
            $table->string('meter_capacity');
            $table->string('meter_resulation');
            $table->integer('meter_type_electro');
            $table->bigInteger('add_id')->default(0);
            $table->bigInteger('edit_id')->default(0);
            $table->bigInteger('return_by')->default(0);
            $table->string('return_date')->nullable();
            $table->bigInteger('return_status')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meters');
    }
}
