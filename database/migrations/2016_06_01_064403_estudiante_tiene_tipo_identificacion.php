<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstudianteTieneTipoIdentificacion extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->enum('tipo_documento', ['C.C', 'C.E', 'T.I'])->after('usuario_id');
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
            $table->dropColumn('tipo_documento');
        });
    }
}