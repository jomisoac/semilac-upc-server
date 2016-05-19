<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDirectores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directores', function(Blueprint $table){
            $table->increments('id');
            $table->integer('identificacion');
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fechaIngreso');
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
        Schema::drop('directores');
    }
}
