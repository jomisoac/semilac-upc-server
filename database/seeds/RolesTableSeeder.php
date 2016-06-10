<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('roles')->insert([
        ['nombre' => 'SUPER_ADMIN'],
        ['nombre' => 'TUTOR'],
        ['nombre' => 'DIRECTOR'],
        ['nombre' => 'ESTUDIANTE']
        ]);
    }
}