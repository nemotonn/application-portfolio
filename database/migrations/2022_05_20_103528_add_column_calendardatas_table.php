<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCalendardatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendardatas', function (Blueprint $table) {
            $table->string('quickcycle')->nullable();
            $table->date('startday')->nullable();
            $table->date('endday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendardatas', function (Blueprint $table) {
            //
        });
    }
}
