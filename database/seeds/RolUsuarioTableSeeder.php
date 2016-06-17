php<?php

use Illuminate\Database\Seeder;

class RolUsuarioTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('rol_usuario')->insert([
        'usuario_id' => DB::table('usuarios')->select('id')->where('email', 'semilac-upc@unicesar.edu.co')->first()->id,
        'rol_id' => DB::table('roles')->select('id')->where('nombre', 'SUPER_ADMIN')->first()->id
        ]);
    }
}