<?php

namespace App\Http\Controllers;

use App\Funcionario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.dashboardFuncionario', $_SESSION);
    }

    public function searchIndex(Request $request)
    {
        if(empty($request->matricula)) {
            $funcionarios = DB::table('funcionarios')
            ->join('usuarios', 'funcionarios.id_usuario', '=', 'usuarios.id')
            ->join('cargos', 'funcionarios.cargo', '=', 'cargos.id')
            ->select('usuarios.id', 'funcionarios.matricula', 'usuarios.status', 'funcionarios.nome', 'cargos.nome AS cargo', 'usuarios.nivel_de_acesso')
            ->get();
        } else {
            $funcionarios = DB::table('funcionarios')
            ->join('usuarios', 'funcionarios.id_usuario', '=', 'usuarios.id')
            ->join('cargos', 'funcionarios.cargo', '=', 'cargos.id')
            ->where('funcionarios.matricula', $request->matricula)
            ->select('usuarios.id', 'funcionarios.matricula', 'usuarios.status', 'funcionarios.nome', 'cargos.nome as cargo', 'usuarios.nivel_de_acesso')
            ->get();            
        }

        foreach($funcionarios as $funcionario) {
            if($funcionario->nivel_de_acesso == 1) {
                $funcionario->nivel_de_acesso = 'Administrador';
            } elseif($funcionario->nivel_de_acesso == 2) {
                $funcionario->nivel_de_acesso = 'Funcionário';
            } else {
                $funcionario->nivel_de_acesso = 'Estudante';
            }

            $funcionario->cargo = ucfirst($funcionario->cargo);
        }
        
        $params = array_merge($_SESSION, ['funcionarios' => $funcionarios]);
        return view('layouts.consultarFuncionario', $params); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }
}
