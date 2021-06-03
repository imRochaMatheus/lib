<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Funcionario;
use App\Estudante;
use App\Cargo;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function index()
    {
        $encrypter = app(\Illuminate\Contracts\Encryption\Encrypter::class);

        $email = (isset($_COOKIE['CookieEmail'])) ? Crypt::decryptString($_COOKIE['CookieEmail']) : '';
        $senha = (isset($_COOKIE['CookieSenha'])) ? Crypt::decryptString($_COOKIE['CookieSenha']) : '';
        $lembrete = (isset($_COOKIE['CookieLembrete'])) ? Crypt::decryptString($_COOKIE['CookieLembrete']) : '';
        $checked = ($lembrete == 'SIM') ? 'checked' : '';

        $cookies = (object) array('email' => $email,
        'senha' => $senha, 'lembrete' => $lembrete,
        'checked' =>$checked);

        return view('layouts.login', ['cookies' => $cookies]);
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
            
            if(isset($request->connected) && $request->connected == 'on'){
                Cookie::queue('CookieEmail', Crypt::encryptString($request->email), 10000);
                Cookie::queue('CookieSenha', Crypt::encryptString($request->password), 10000);
                Cookie::queue('CookieLembrete', Crypt::encryptString('SIM'), 10000);
            }else{
                Cookie::queue(Cookie::forget('CookieEmail'));
                Cookie::queue(Cookie::forget('CookieSenha'));
                Cookie::queue(Cookie::forget('CookieLembrete'));

            }
            

            session_start();

            $_SESSION['email'] = $usuario->email;
            $_SESSION['acesso'] = $usuario->nivel_de_acesso;
            
            if($usuario->foto) {
                $_SESSION['foto'] = $usuario->foto;
            } else {
                $_SESSION['foto'] = 'images/avatar.png';
            }

            

            

           
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
                    $_SESSION['cargo'] = ucfirst($cargo->nome);
                    
                break;
                case 2:
                    $usuario_id = DB::table('funcionarios')->where('email', $usuario->email)->get('id');
                    $_SESSION['id'] = $usuario_id[0]->id;
                    $fnc = new Funcionario();
                    $crg = new Cargo();
                    $funcionario = $fnc->where('email', $email)->get()->first();
                    $cargo = $crg->where('id', $funcionario->cargo)->get()->first();
                    $nome = $funcionario->nome;
                    $nome = explode(" ", $nome);
                    $_SESSION['nome'] = $nome[0];
                    $_SESSION['sobrenome'] = $nome[count($nome)-1];
                    $_SESSION['cargo'] = ucfirst($cargo->nome);
                break;
                case 3:
                    $estudante_id = DB::table('estudantes')->where('email', $usuario->email)->get('id');
                    $_SESSION['id'] = $estudante_id[0]->id;
                    $std = new Estudante();
                    $estudante = $std->where('email', $email)->get()->first();
                    $nome = $estudante->nome;
                    $nome = explode(" ", $nome);
                    $_SESSION['nome'] = $nome[0];
                    $_SESSION['sobrenome'] = ucfirst($nome[count($nome)-1]);
                    $_SESSION['cargo'] = 'Estudante';
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

    public function sair()
    {

        session_start();
        session_destroy();

        return redirect()->route('login');

    }

}
