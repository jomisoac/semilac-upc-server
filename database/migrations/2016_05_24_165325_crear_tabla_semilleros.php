<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSemilleros extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('semilleros', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('programa_id')->unsigned();
            $table->integer('grupo_id')->unsigned()->nullable();
            $table->string('nombre');
            $table->string('mision');
            $table->string('vision');
            $table->string('objetivo_general');
            $table->string('objetivo_uno');
            $table->string('objetivo_dos');
            $table->string('objetivo_tres');
            $table->string('estrategia_uno');
            $table->string('estrategia_dos');
            $table->string('estrategia_tres');
            $table->integer('tutor_id')->unsigned();
            $table->boolean('activo')->default('1');
            $table->foreign('programa_id')->references('id')->on('programas');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('tutor_id')->references('id')->on('tutores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('semilleros');
    }

}
