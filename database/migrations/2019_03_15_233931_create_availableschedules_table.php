<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availableschedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tahap');
            $table->integer('remaining_quota');
            $table->integer('available_shift');
            $table->dateTime('available_schedule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availableschedules');
    }
}
