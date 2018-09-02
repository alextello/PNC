<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//TABLA QUE ALMACENA LOS TIPOS DE AUTOS Y ARMAS
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo', 100);
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
        Schema::dropIfExists('types');
    }
}
