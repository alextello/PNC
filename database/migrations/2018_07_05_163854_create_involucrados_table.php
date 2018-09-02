<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvolucradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('involucrados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->bigInteger('dpi')->nullable();
            $table->char('gender', 1);//PARA ALMACENAR LA LETRA DEL GENERO M MASCULINO Y F FEMENINO
            $table->string('genero', 10);//GUARDA EL GENERO DE LA PERSONA
            $table->unsignedInteger('gang_id')->defult('0');//INDICA A QUE MARA PERTENECE, DE NO PERTENECER A NINGUNA EL VALOR ES 0
            $table->string('tattoos')->nullable();
            $table->string('alias', 100)->nullable();
            $table->Integer('age')->default('1')->nullable();//EDAD DEL APREHENDIDO
            $table->boolean('aprehendido')->default('1');//1 PARA SABER SI ES APREHENDIDO Y 0 PARA SABER SI ES UN FALLECIDO O HERIDO
            $table->boolean('fallecido')->default('0');//1 PARA SABER SI ES FALLECIDO Y 0 PARA SABER SI ES HERIDO
            $table->string('heridas')->nullable();
            $table->string('motivo')->nullable();//MOTIVO DEL ATAQUE
            $table->unsignedInteger('type_id')->nullable();//INDICA A BORDO DE QUE IBA.. CARRO, A PIE, ETC..
            $table->unsignedInteger('offense_id')->nullable();//INDICA UNA FALTA MENOR
            // $table->unsignedinteger('abordo')->nullable();//INDICA A BORDO DE QUE IBAN LOS ATACANTES
            $table->string('diagnostico')->nullable();
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('involucrados');
    }
}
