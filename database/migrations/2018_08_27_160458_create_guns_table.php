<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id')->nullable();//TIPO DE ARMA
            $table->unsignedInteger('marca_id')->nullable();//MARCA DEL ARMA
            $table->string('registro')->default('IGN')->nullable();
            $table->string('calibre')->default('IGN')->nullable();
            $table->string('licencia')->default('IGN')->nullable();
            $table->string('recuperada_por')->nullable();
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
        Schema::dropIfExists('guns');
    }
}
