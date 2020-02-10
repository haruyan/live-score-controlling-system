<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('arbitre')->unsigned();
            $table->string('player_one');
            $table->string('player_two');
            $table->time('duration')->default('00:45:00');
            $table->string('field');
            $table->enum('status', ['waiting', 'pending', 'ongoing', 'finished'])->default('waiting');
            $table->time('timer')->default('00:00:00');
            $table->dateTime('startTime')->nullable();
            $table->dateTime('endTime')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('arbitre')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
