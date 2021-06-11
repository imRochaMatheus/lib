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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        //
    }
}
