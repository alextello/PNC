<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();//NOMBRE ESTABLECIDO QUE JAMAS CAMBIA
            $table->string('display_name')->nullable();//NOMBRE QUE SE MUESTRA POR SI QUIEREN CAMBIARLE EL NOMBRE
            $table->string('guard_name');//ESTE CAMPO ESTA PREVEENDO QUE SE NECESITE CONSUMIR UNA API, SI SE LLEGA A REPLICAR EL PROYECTO, DE MOMENTO NO SE USA
            $table->timestamps();
        });
        //TABLA DE ROLES, SUS CAMPOS TIENEN LA MISMA LOGICA QUE LA TABLA ANTERIOR
        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('guard_name');
            $table->timestamps();
        });
        //TABLA QUE RELACIONA AL MODELO USUARIO CON LOS PERMISOS, CUANDO SE QUIERE ASIGNAR UN PERMISO EXTRA
        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id');
            $table->morphs('model');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'model_id', 'model_type']);
        });
        //TABLA QUE RELACIONA LOS ROLES CON EL MODELO USUARIO
        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('role_id');
            $table->morphs('model');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', 'model_id', 'model_type']);
        });
        //TABLA QUE INDICA QUE PERMISOS TIENE EL ROL
        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);

            app('cache')->forget('spatie.permission.cache');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
