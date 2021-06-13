<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Livro;
use App\Estudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            \DB::beginTransaction();
    
                $registroComentario = DB::table('comentarios')
                ->where('usuario_id', $_SESSION['id'])
                ->where('codigo_livro', $request->codigo)
                ->first();

                $comentario = new Comentario();
                $comentario->codigo_livro = $request->codigo;
                $comentario->usuario_id = $_SESSION['id'];
                $comentario->comentario = $request->comentario;
            
            if($registroComentario == null){    
                $comentario->save();
            }else{
                DB::table('comentarios')
                ->where('usuario_id', $_SESSION['id'])
                ->where('codigo_livro', $request->codigo)
                ->update(['comentario' => $comentario->comentario]);
            }
            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();
            echo $e->getMessage();

            return redirect()->back()->with('message', 'Não foi possível salvar o comentário');
        }
        return redirect()->back()->with('message', 'Obrigado por comentar !');
    }
}
