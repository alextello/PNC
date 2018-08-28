<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa')->nullable()->default('IGN');
            $table->string('linea')->nullable()->default('IGN');//EJ. RAV4, TACOMA, ETC..
            $table->year('modelo')->nullable(); 
            $table->string('color')->nullable()->default('IGN');
            $table->unsignedInteger('marca_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();//TIPO DEL MOVIL, EJ. PICKUP, CAMION, ETC.
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
        Schema::dropIfExists('vehiculos');
    }
}
