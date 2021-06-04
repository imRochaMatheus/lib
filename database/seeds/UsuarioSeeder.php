<?php

use Illuminate\Database\Seeder;
use App\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new Usuario();
        $usuario->email = 'im.rochamatheus@gmail.com';
        $usuario->senha = 12345678;
        $usuario->nivel_de_acesso = '1';
        $usuario->status = true;
        $usuario->save();

        $usuario = new Usuario();
        $usuario->email = 'carla@contato.com.br';
        $usuario->senha = 12345678;
        $usuario->nivel_de_acesso = '3';
        $usuario->status = true;
        $usuario->save();
    }
}
