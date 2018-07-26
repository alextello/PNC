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
            $table->string('name');
            $table->bigInteger('dpi')->nullable();
            $table->char('gender', 1);
            $table->string('genero');
            $table->unsignedInteger('gang_id')->defult('0');
            $table->string('tattoos')->nullable();
            $table->string('alias')->nullable();
            $table->unsignedInteger('age')->default('1')->nullable();
            $table->boolean('aprehendido')->default('1');
            $table->string('heridas')->nullable();
            $table->string('motivo')->nullable();
            $table->unsignedInteger('movil_id')->nullable();
            $table->unsignedinteger('abordo')->nullable();
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
