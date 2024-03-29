<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->default(0)->unsigned();
            $table->integer('tahap_berkas')->default(0)->nullable();
            $table->integer('tahap_tes')->default(0)->nullable();
            $table->integer('tahap_wawancara')->default(0)->nullable();
            $table->integer('tahap_tucil')->default(0)->nullable();
            $table->integer('tahap_teaching')->default(0)->nullable();
            $table->integer('tahap_upgrading')->default(0)->nullable();

            /*
            * 0 => not start yet
            * 1 => finished (successfully passed)
            * 2 => in progress
            * 3 => failed
            */

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
