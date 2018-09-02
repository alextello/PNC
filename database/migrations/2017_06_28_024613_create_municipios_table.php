<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('url', 100);//EL CAMPO URL SE GENERA A PARTIR DEL CAMPO NOMBRE PERO OMITIENDO CARACTERES ESPECIALES Y REEMPLAZANDO ESPACIOS POR GUIONES ESTO PARA HACER MAS AMIGABLES LAS URLS
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
        Schema::dropIfExists('municipios');
    }
}
