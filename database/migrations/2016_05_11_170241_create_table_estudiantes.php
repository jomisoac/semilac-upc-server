<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstudiantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->string('identificacion');
            $table->string('nombres');
            $table->string('apellidos');
            $table->char('sexo', '1');
            $table->date('fecha_nacimiento');
            $table->string('lugar_expedicion');
            $table->string('lugar_nacimiento');
            $table->string('estado_civil');
            $table->string('direccion');
            $table->string('telefono');
            $table->boolean('estado');
            $table->string('universidad');
            $table->integer('programa_id')->unsigned();
            $table->foreign('programa_id')->references('id')->on('programas');
            $table->integer('n_semestre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
