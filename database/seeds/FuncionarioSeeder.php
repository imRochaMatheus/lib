<?php

use Illuminate\Database\Seeder;
use App\Funcionario;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $funcionario = new Funcionario();
        $funcionario->nome = 'Matheus Almeida da Rocha';
        $funcionario->email = 'im.rochamatheus@gmail.com';
        $funcionario->matricula = '40028922';
        $funcionario->id_usuario = '1';
        $funcionario->telefone = '71999998888';
        $funcionario->cargo = '1';
        $funcionario->save();

        $funcionario = new Funcionario();
        $funcionario->nome = 'Cristiana Pereira Bispo';
        $funcionario->email = 'cristiana@contato.com.br';
        $funcionario->matricula = '40028977';
        $funcionario->id_usuario = '6';
        $funcionario->telefone = '71999998888';
        $funcionario->cargo = '1';
        $funcionario->save();
    }
}
