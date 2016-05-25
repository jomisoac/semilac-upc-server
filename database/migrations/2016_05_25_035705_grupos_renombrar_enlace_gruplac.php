<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GruposRenombrarEnlaceGruplac extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropColumn('enlace');
            $table->string('gruplac');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropColumn('gruplac');
            $table->string('enlace');
        });
    }
}