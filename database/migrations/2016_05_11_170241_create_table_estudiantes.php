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
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('identificacion');
            $table->string('nombres');
            $table->string('apellidos');
            $table->char('sexo', '1');
            $table->date('fecha_nacimiento');
            $table->string('fecha_expedicion');
            $table->string('lugar_nacimiento');
            $table->string('lugar_expedicion');
            $table->string('estado_civil');
            $table->string('direccion');
            $table->string('telefono');
            $table->boolean('activo')->default('1');
            $table->string('universidad')->default('Universidad Popular del Cesar');
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
        Schema::drop('estudiantes');
    }
}
