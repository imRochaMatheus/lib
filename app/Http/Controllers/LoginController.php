<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Funcionario;
use App\Estudante;

class LoginController extends Controller
{
    //
    public function index(){
        return view('layouts.login');
    }

    public function autenticar(Request $request){
    
        
        $regras = [
            'email' => 'email',
            'password' => 'required',
        ];

        $mensagem = [
            'email' => 'Informe um :attribute válido',
            'required' => 'O campo :attribute é obrigatório',
        ];
        
        $request->validate($regras, $mensagem);

        $email = $request->email;
        $senha = $request->password;

        $user = new Usuario();

        $usuario = $user->where('email', $email)->where('senha', $senha)->get()->first();

        if(isset($usuario->email) && $usuario->email != ''){
            
            session_start();

            $_SESSION['email'] = $usuario->email;
            $_SESSION['acesso'] = $usuario->nivel_de_acesso;

            switch ($usuario->nivel_de_acesso){
                case 1:
                    $adm = new Funcionario();
                    $admin = $adm->where('email', $email)->get()->first();
                    $nome = $admin->nome;
                    $nome = explode(" ", $nome);
                    $nome = $nome[0].' '.$nome[1];
                    $_SESSION['nome'] = $nome;
                    $_SESSION['cargo'] = $admin->cargo;
                break;
                case 2:
                    $fnc = new Funcionario();
                    $funcionario = $fnc->where('email', $email)->get()->first();
                    $nome = $funcionario->nome;
                    $nome = explode(" ", $nome);
                    $nome = $nome[0].' '.$nome[1];
                    $_SESSION['nome'] = $nome;
                    $_SESSION['cargo'] = $funcionario->cargo;
                break;
                case 3:
                    $std = new Estudante();
                    $estudante = $std->where('email', $email)->get()->first();
                    $nome = $estudante->nome;
                    $nome = explode(" ", $nome);
                    $nome = $nome[0].' '.$nome[1];
                    $_SESSION['nome'] = $nome;
                break;
                default:
                break;
            }

            if( $_SESSION['acesso'] == 1){
                return redirect()->route('auth.on.dashboard');

            }else if($_SESSION['acesso'] == 2){

                return redirect()->route('auth.on.dashboard');
            }else if($_SESSION['acesso'] == 3){
    
                return redirect()->route('auth.estudante.painel');
            }else{
                //erro
            }
        }else{
            return redirect()->route('login');
        }
    }

}
