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
            $table->text('available_shift');
            $table->integer('ruangan');

            //1 -> daskom 3
            //2 -> daskom 1

            $table->date('schedule');
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
