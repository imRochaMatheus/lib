<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('layouts.editarPerfil', $_SESSION);
    }

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
}
