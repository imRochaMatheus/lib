<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('layouts.login');
    }

    public function validar(){

        $regras = [
            'login' => 'email, required',
            'senha' => 'required|min:8',
        ];

        $mensagem = [
            'email' => 'Informe um :attribute válido',
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'Sua senha precisa ter pelo menos 8 caracteres',
        ];

        $request->validate($regras, $mensagem);

        $email = $request->email;
        $senha = $request->senha;

        $user = new Usuario();

        $usuario = $user->where('email', $email)->where('senha', $senha)->get()->first();

        if(isset($usuario->nome) && $usuario->nome != ''){
            
            $nome = explode(" ", $usuario->nome);
            $nome = $nome[0].' '.$nome[1];

            session_start();

            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['acesso'] = $usuario->nivel_acesso;

            if( $_SESSION['acesso'] == 1){
                return redirect()->route('auth.admin', $_SESSION['nome']);

            }else if($_SESSION['acesso'] == 2){

                return redirect()->route('funcionario', $_SESSION['nome']);
            }else if($_SESSION['acesso'] == 3){
                
                return redirect()->route('estudante', $_SESSION['nome']);
            }else{
                //erro
            }
        }else{
            return redirect()->route('login');
        }
    }

}
