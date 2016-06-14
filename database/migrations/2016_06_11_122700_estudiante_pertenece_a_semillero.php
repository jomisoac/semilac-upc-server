<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstudiantePerteneceASemillero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->integer('semillero_id')->nullable()->unsigned();
            $table->foreign('semillero_id')->references('id')->on('semilleros')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropForeign('estudiantes_semillero_id_foreign');
            $table->dropColumn('semillero_id');
        });
    }
}
