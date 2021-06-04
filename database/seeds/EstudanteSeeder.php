<?php

use Illuminate\Database\Seeder;
use App\Estudante;

class EstudanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estudante = new Estudante();
        $estudante->nome = 'Carla Brito Almeida';
        $estudante->email = 'carla@contato.com.br';
        $estudante->matricula = '40028933';
        $estudante->id_usuario = 2;
        $estudante->telefone = '71999998888';
        $estudante->save();
    }
}
