<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemillerosEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semilleros_estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('semillero_id')->unsigned();
            $table->foreign('semillero_id')->references('id')->on('semilleros')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('estudiante_id')->unsigned();
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->enum('estado',['pertenece', 'retirado']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('semilleros_estudiantes');
    }
}
