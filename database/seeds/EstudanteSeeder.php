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

        $estudante = new Estudante();
        $estudante->nome = 'Kaio Rian';
        $estudante->email = 'kaio@contato.com.br';
        $estudante->matricula = '40028944';
        $estudante->id_usuario = 3;
        $estudante->telefone = '71999998888';
        $estudante->save();

        $estudante = new Estudante();
        $estudante->nome = 'Gracielle Belmonte';
        $estudante->email = 'gracielle@contato.com.br';
        $estudante->matricula = '40028955';
        $estudante->id_usuario = 4;
        $estudante->telefone = '71999998888';
        $estudante->save();

        $estudante = new Estudante();
        $estudante->nome = 'Gabriel Mendes';
        $estudante->email = 'mendes@contato.com.br';
        $estudante->matricula = '40028966';
        $estudante->id_usuario = 5;
        $estudante->telefone = '71999998888';
        $estudante->save();

        $estudante = new Estudante();
        $estudante->nome = 'Emily Menezes';
        $estudante->email = 'emily@contato.com.br';
        $estudante->matricula = '40028999';
        $estudante->id_usuario = 7;
        $estudante->telefone = '71999998888';
        $estudante->save();
    }
}
