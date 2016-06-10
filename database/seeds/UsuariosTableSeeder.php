<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('usuarios')->insert([
        'email' => 'semilac-upc@unicesar.edu.co',
        'password' => password_hash('1234', PASSWORD_DEFAULT),
        'estado' => '1'
        ]);
    }
}