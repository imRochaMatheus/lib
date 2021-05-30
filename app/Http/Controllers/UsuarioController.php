<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Mail\EsqueciSenhaEmail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    public function alterarPermissao(Request $request)
    {
        try {
            DB::beginTransaction();
            $usuario = new Usuario();
            $usr = $usuario->where('id', $request->usuario_id)->first();
            $usr->nivel_de_acesso = $request->acesso;
            $usr->save();
            DB::commit();
        } catch(\Exception $e) {
            echo $e->getMessage();
            DB::rollback();
        }

        return redirect()->back();
    }

    public function editarPerfil()
    {
        return view('layouts.editarPerfil', $_SESSION);
    }

    public function editarFoto(Request $request)
    {
        if($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $extensao = $request->foto->extension();
            $nome = "{$request->usuario_id}.{$extensao}";
            $storage_path = "storage/profile_photos/{$nome}";

            $upload = $request->foto->storeAs('profile_photos', $nome);

            try {
                DB::beginTransaction();
                $usuario = new Usuario();
                $usr = $usuario->where('id', $request->usuario_id)->first();
                $usr->foto = $storage_path;
                $usr->save();
                DB::commit();

                $_SESSION['foto'] = $storage_path;
            } catch(\Exception $e) {
                echo $e->getMessage();
                DB::rollback();
            }

            return redirect()->back();
        }
    }

    public function recuperarSenhaIndex()
    {
        return view('layouts.recuperarSenha');
    }

    public function recuperarSenha(Request $request)
    {
        $email = $request->email;

        $usuario = new Usuario();
        $usr = $usuario->where('email', $email)->first();

        if ($usr === NULL) {
            return redirect()->back()->withErrors(['message', 'E-mail não cadastrado. Tente novamente.']);
        }

        try {
            DB::beginTransaction();
            $usr->senha = $this->gerarSenha(9);
            $usr->save();
            DB::commit();
        } catch(\Exception $e) {
            echo $e->getMessage();
            DB::rollback();

            return redirect()->back()->withErrors(['message', 'Não foi possível completar a operação.']);
        }

        try {
            Mail::to($usr->email)->send(new EsqueciSenhaEmail($usr));
        } catch(\Exception $e) {
            echo $e->getMessage();

            return redirect()->back()->withErrors(['message', 'E-mail de recuperação de senha não enviado']);
        }

        return redirect()->back()->with('message', 'Senha resetada. Por favor, verifique seu e-mail');
    }

    private function gerarSenha($tamanho, $maiusculas = true, $minusculas = true, $numeros = true, $simbolos = true)
    {
        $ma = 'ABCDEFGHIJKLMNOPQRSTUVYXWZ';
        $mi = 'abcdefghijklmnopqrstuvyxwz';
        $nu = '0123456789';
        $si = '!@#$%&*()_+=';

        $senha = '';

        if ($maiusculas) $senha .= str_shuffle($ma);
        if ($minusculas) $senha .= str_shuffle($mi);
        if ($numeros) $senha .= str_shuffle($nu);
        if ($simbolos) $senha .= str_shuffle($si);

        return substr(str_shuffle($senha), 0, $tamanho);
    }
}
