<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiprosterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiproster', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shiptypeid');
            $table->string('status');
            $table->string('notes');
            $table->string('propulsionstatus',1);
            $table->string('shieldstatus',1);
            $table->string('weoponstatus',1);
            $table->string('lifesupportstatus',1);
            $table->string('structurestatus',1);
            $table->string('navstatus',1);
            $table->string('commstatus',1);
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
        Schema::dropIfExists('shiproster');
    }
}
