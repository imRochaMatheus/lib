<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Funcionario;
use App\Estudante;
use App\Cargo;

use Illuminate\Support\Facades\DB;

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
                    $usuario_id = DB::table('funcionarios')->where('email', $usuario->email)->get('id');
                    $_SESSION['id'] = $usuario_id[0]->id;
                    $adm = new Funcionario();
                    $crg = new Cargo();
                    $admin = $adm->where('email', $email)->get()->first();
                    $cargo = $crg->where('id', $admin->cargo)->get()->first();
                    $nome = $admin->nome;
                    $nome = explode(" ", $nome);
                    $_SESSION['nome'] = $nome[0];
                    $_SESSION['sobrenome'] = $nome[count($nome)-1];
                    $_SESSION['cargo'] = $cargo->nome;
                    
                break;
                case 2:
                    $usuario_id = DB::table('funcionarios')->where('email', $usuario->email)->get('id');
                    $_SESSION['id'] = $usuario_id[0]->id;
                    $fnc = new Funcionario();
                    $crg = new Cargo();
                    $funcionario = $fnc->where('email', $email)->get()->first();
                    $cargo = $crg->where('id', $admin->cargo)->get()->first();
                    $nome = $funcionario->nome;
                    $nome = explode(" ", $nome);
                    $_SESSION['nome'] = $nome[0];
                    $_SESSION['sobrenome'] = $nome[count($nome)-1];
                    $_SESSION['cargo'] = $cargo->nome;
                break;
                case 3:
                    $estudante_id = DB::table('estudantes')->where('email', $usuario->email)->get('id');
                    $_SESSION['id'] = $estudante_id[0]->id;
                    $std = new Estudante();
                    $estudante = $std->where('email', $email)->get()->first();
                    $nome = $estudante->nome;
                    $nome = explode(" ", $nome);
                    $_SESSION['nome'] = $nome[0];
                    $_SESSION['sobrenome'] = $nome[count($nome)-1];
                   
                break;
                default:
                break;
            }

            if($_SESSION['acesso'] == 1){
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

    public function sair(){

        session_start();
        session_destroy();

        return redirect()->route('login');

    }

}
