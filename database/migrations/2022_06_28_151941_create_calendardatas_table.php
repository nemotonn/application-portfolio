<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendardatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendardatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('placename');
            $table->integer('numOfCycles');
            $table->string('cycle');
            $table->string('quickcycle');
            $table->date('startday');
            $table->date('endday');

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
        Schema::dropIfExists('calendardatas');
    }
}
