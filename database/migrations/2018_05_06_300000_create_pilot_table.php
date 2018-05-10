<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('callname');
            $table->string('rank');
            $table->integer('age');
            $table->string('race');
            $table->integer('currentship')->unsigned();
            $table->integer('kills');
            $table->integer('crashes');
            $table->integer('shipslost');
            $table->string('awards');
            $table->string('notes');
            $table->rememberToken();
            $table->timestamps();
        });
        /*Schema::table('pilots', function (Blueprint $table) {
            $table->foreign('currentship')->references('id')->on('ships');
        });*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pilots');
    }
}
