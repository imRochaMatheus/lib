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
        if($request->hasFile('foto')) {
            $image = $request->file('foto');
            $destination_path = 'images/' . $request->usuario_id . '/';

            $storage_path = \Storage::disk('local')->put($destination_path, $image);
            dd($storage_path);

            try {
                DB::beginTransaction();
                $usuario = new Usuario();
                $usuario->foto = $storage_path;
                $usuario->save();
                DB::commit();
            } catch(\Exception $e) {
                echo $e->getMessage();
                DB::rollback();
            }
        }
    }
}
