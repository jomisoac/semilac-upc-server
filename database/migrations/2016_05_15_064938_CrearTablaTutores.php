<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTutores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutores', function(Blueprint $table){
            $table->increments('id');
            $table->string('nombres');
            //$table->string('nombre2');
            $table->string('apellidos');
            //$table->string('apellido2');
            $table->string('tipo_documento');
            $table->string('identificacion');
            $table->string('sexo');
            $table->date('fecha_expedicion');
            $table->date('fecha_nacimiento');
            $table->string('direccion');
            $table->integer('celular');
            $table->string('email_personal');
            $table->string('email');
            $table->string('pass');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('activo')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tutores');
    }
}
