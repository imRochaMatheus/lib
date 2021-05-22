<?php

namespace App\Http\Controllers;

use App\Livro;
use App\Exemplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.cadastroLivro', $_SESSION);
    }

    public function searchIndex(Request $request)
    {
        if(!empty($request->livros)){

            $livros = DB::table('livros')
            ->where('codigo', $request->livros)
            ->select('codigo', 'titulo', 'autor', 'editora', 'edicao', 'volume','numero_de_paginas','numero_de_emprestimos', 'descricao')
            ->get();
            
            return view('layouts.consultarLivro', $_SESSION, ['livros' => $livros, 'action' => 1]); 

        }else{
            $livros = DB::table('livros')->get()->all();
            return view('layouts.consultarLivro', $_SESSION, ['livros' => $livros]); 
        }
    }

    public function getAll(Request $request)
    {
        $regras = 
        [
            'codigo' => 'required|numeric'
        ];

        $feedback = 
        [
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'Utilize apenas números',
        ];

        $request->validate($regras, $feedback);

        return redirect()->route('auth.on.livro.consultar', ['livros' => $request->codigo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $regras = 
        [
            'codigo' => 'required|unique:livros|numeric',
            'titulo' => 'required',
            'autor'=> 'required|max:55',
            'editora'=> 'required',
            'edicao' => 'required|numeric',
            'volume' => 'required|numeric',
            'descricao' => 'required|max:2000'

        ];

        $feedback = 
        [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Código já cadastrado',
            'max:55' => 'O :attribute deve conter no máximo 55 caracteres',
            'numeric' => 'Utilize apenas números no campo :attribute',
        ];

        $request->validate($regras, $feedback);
    
        try{
            \DB::beginTransaction();
                $livro = new Livro();
                $livro->codigo = $request->codigo;
                $livro->autor = $request->autor;
                $livro->titulo = $request->titulo;
                $livro->autor = $request->autor;
                $livro->editora = $request->editora;
                $livro->edicao = $request->edicao;
                $livro->volume = $request->volume;
                $livro->descricao = $request->descricao;
                $livro->numero_de_paginas = $request->numero_de_paginas;
                $livro->numero_de_exemplares = $request->n_exemplares;
                $livro->save();
                $exmp = new Exemplar();
                $exmp = DB::table('livros')->where('codigo', $request->codigo)->get()->first();

                for($i = 1; $i < $request->n_exemplares + 1; $i++){
                    $exemplar = new Exemplar();
                    $codigo_exemplar = "$request->codigo$i";
                    $exemplar->codigo = $codigo_exemplar;
                    $exemplar->id_livro = $exmp->id;
                
                    $exemplar->save();
                };
            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();
            dd($e);
        }
        return redirect()->back();
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
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livro $livro)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        //
    }
}
