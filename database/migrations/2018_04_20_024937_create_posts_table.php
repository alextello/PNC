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
            $table->string('title');
            $table->string('url')->unique()->nullable();
            $table->text('body')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->time('time')->nullable();
            $table->string('oficio', 10)->nullable();
            $table->unsignedInteger('user_id');
            $table->string('denunciante', 50)->nullable();
            $table->unsignedInteger('jefe_de_turno_id')->nullable();
            $table->string('juzgado')->nullable();
            $table->string('guardia', 2)->nullable();
            $table->unsignedInteger('tag_id')->nullable();
            $table->unsignedInteger('modus_operandi_id')->nullable();
            $table->unsignedInteger('typology_id')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->unsignedInteger('vehiculo_id')->nullable();
            $table->unsignedInteger('gun_id')->nullable();
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
