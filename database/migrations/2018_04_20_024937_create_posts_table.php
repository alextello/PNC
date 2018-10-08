<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);//TITULO DEL OFICIO
            $table->string('url', 100)->unique()->nullable();
            $table->text('body')->nullable();
            $table->timestamp('published_at')->nullable();//ESTA ES LA FECHA EN QUE OCURRIO LA NOVEDAD
            $table->time('time')->nullable();//LA HORA EN QUE OCURRIO LA NOVEDAD
            $table->string('oficio', 10)->nullable()->unique();//NUMERO DE OFICIO
            $table->unsignedInteger('user_id');//USUARIO QUE CREA EL OFICIO
            $table->string('denunciante', 50)->nullable();//REGISTRO DE LA PERSONA QUE HIZO LA DENUNCIA
            $table->unsignedInteger('jefe_de_turno_id')->nullable();//REGISTRO DEL JEFE EN TURNO EN ESE MOMENTO
            $table->string('juzgado', 50)->nullable();//INDICA A QUE JUZGADO SE REMITE
            $table->string('guardia', 2)->nullable();//INDICA SI ES LA GUARDIA A O B YA QUE LOS AGENTES TIENEN TURNOS
            $table->unsignedInteger('tag_id')->nullable();//RELACIONA LA ETIQUETA A LA QUE PERTENECE EL OFICIO
            $table->unsignedInteger('modus_operandi_id')->nullable();//SE RELACIONA CON EL MODUS OPERANDI DEL CRIMEN
            $table->unsignedInteger('typology_id')->nullable();//TIPOLOGIA DEL DELITO
            $table->unsignedInteger('address_id')->nullable();//DIRECCION DEL SUCESO
            $table->unsignedInteger('vehiculo_id')->nullable();//ID DEL VEHICULO SI ES QUE HAY ALGUNO INVOLUCRADO
            $table->unsignedInteger('gun_id')->nullable();//ID DEL ARMA DE HABER ALGUNA INVOLUCRADA
            $table->unsignedInteger('incautacion_id')->nullable();//ID DEL ARMA DE HABER ALGUNA INVOLUCRADA
            $table->unsignedInteger('robo_id')->nullable();//ID DE LA TABLA DONDE SE DESCRIBE EL ROBO
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
        Schema::dropIfExists('posts');
    }
}
