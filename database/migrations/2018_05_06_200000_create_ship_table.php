<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60)->unique();
            $table->string('type');
            $table->string('status');
            $table->integer('offensivelevel');
            $table->integer('defensivelevel');
            $table->integer('maneuverlevel');
            $table->integer('speedlevel');
            $table->integer('cargolevel');
            $table->integer('crewlevel');
            $table->string('notes');
            $table->rememberToken();
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
        Schema::dropIfExists('ships');
    }
}
