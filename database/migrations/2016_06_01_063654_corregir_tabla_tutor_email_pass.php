<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorregirTablaTutorEmailPass extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('tutores', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('pass');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('tutores', function (Blueprint $table) {
            $table->string('email');
            $table->string('pass');
        });
    }
}