<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//TABLA QUE ALMACENA LAS MARCAS DE AUTOS Y ARMAS
        Schema::create('marcas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('modelo', 50);
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
        Schema::dropIfExists('marcas');
    }
}
