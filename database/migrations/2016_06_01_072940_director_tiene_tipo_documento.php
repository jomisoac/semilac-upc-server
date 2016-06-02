<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DirectorTieneTipoDocumento extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('directores', function (Blueprint $table) {
            $table->enum('tipo_documento', ['C.C', 'C.E'])->after('id');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('directores', function (Blueprint $table) {
            $table->dropColumn('tipo_documento');
        });
    }
}