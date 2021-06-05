<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Funcionario;

class FuncionariosTest extends TestCase
{
    /**
    *@test
    */
    public function checar_tabela_funcionario()
    {
        $funcionario = new Funcionario;

        $esperado = [
            'nome',
            'email',
            'matricula',
            'id_usuario',
            'telefone',
            'cargo',
            'usuario_id' 
        ];

        $comparar = array_diff($esperado, $funcionario->getFillable());
        $this->assertEquals(0, count($comparar));
    }
}
