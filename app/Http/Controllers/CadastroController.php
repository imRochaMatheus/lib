<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Funcionario;
use App\Estudante;
use App\Cargo;

class CadastroController extends Controller
{
    public function index(){

        $cargos = Cargo::orderBy('nome')->get();

        return view('layouts.cadastro',
        [
            'cargos' => $cargos,
        ]);
    }

    public function create(Request $request){
        
        $regras = 
        [
            'nome' => 'required',
            'matricula' => 'required|unique:Estudantes|numeric',
            'telefone'=> 'required|max:55',
            'email'=> 'required|email',
            'cargo' => 'required',
            'acesso' => 'required',
            'senha' => 'required|min:8',
            'confirmacao' => 'required|min:8|same:senha',
        ];

        $feedback = 
        [
            'required' => 'O campo é obrigatório',
            'unique' => ':attribute já cadastrada',
            'max' => 'O campo deve conter no máximo 55 caracteres',
            'email' => 'Informe um email válido',
            'nivel_acesso' => 'Determine o nível de acesso',
            'numeric' => 'Utilize apenas números no campo :attribute' ,  
            'same' => 'Os campos senha e confirmação devem coincidir',
            'min' => 'O campo deve conter no mínimo 8 caracteres'
        ];

        $request->validate($regras, $feedback);
            
        if($request->acesso == 1 | $request->acesso == 2){

            $usuario = new Usuario();
            
            $usuario->email = $request->email;
            $usuario->senha = $request->senha;
            $usuario->nivel_de_acesso = $request->acesso;

            $usuario->save();               
            $id = $usuario->id;         

            $funcionario = Funcionario::create(
            [
                'id_usuario' => $id,
                'nome' => $request->nome,
                'matricula' => $request->matricula,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'cargo' => $request->cargo,
            ]);     

        }else if($request->acesso == 3){
           
                $usuario = new Usuario();
                
                $usuario->email = $request->email;
                $usuario->senha = $request->senha;
                $usuario->nivel_de_acesso = $request->acesso;
    
                $usuario->save();               
                $id = $usuario->id;         
    
                $estudante = Estudante::create(
                [
                    'id_usuario' => $id,
                    'nome' => $request->nome,
                    'matricula' => $request->matricula,
                    'telefone' => $request->telefone,
                    'email' => $request->email,
                ]);
        }

        return redirect()->route('cadastro');
    }
}
