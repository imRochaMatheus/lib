<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    /** 
    *@test 
    */
    public function apenas_usuarios_autenticados_podem_ver_o_dashboard()
    {
        $this->get('/dashboard')->assertRedirect('/');
    }
}
