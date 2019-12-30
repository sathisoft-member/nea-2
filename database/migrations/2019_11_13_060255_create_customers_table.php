<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('submitted');
            $table->string('phone');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->bigInteger('meter_id')->default(0);
            $table->string('take_date')->nullable();
            $table->bigInteger('customer_id')->default(0);
            $table->string('return_remarks')->nullable();
            $table->string('reject_remarks')->nullable();
            $table->bigInteger('add_id')->default(0);
            $table->bigInteger('edit_id')->default(0);
            $table->bigInteger('rejected_id')->default(0);
            $table->bigInteger('reject_track_id')->default(0);
            $table->bigInteger('completed_id')->default(0);
            $table->bigInteger('return_id')->default(0);
            $table->bigInteger('return_by')->nullable();
            $table->bigInteger('done_id')->default(0);
            $table->bigInteger('completed_by')->default(0);
            $table->integer('status')->default(0);
            $table->boolean('vauchar_status')->default(0);
            $table->bigInteger('vauchar_number')->default(0);
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
        Schema::dropIfExists('customers');
    }
}
