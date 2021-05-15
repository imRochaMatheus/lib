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

    public function getAll(Request $request)
    {
        $regras = 
        [
            'codigo' => 'required|numeric'
        ];

        $feedback = 
        [
            'required' => 'O campo é obrigatório',
            'numeric' => 'Utilize apenas números',
        ];

        $request->validate($regras, $feedback);

        $livros = DB::table('livros')
                    ->join('exemplares', 'livros.id', '=', 'exemplares.id_livro')
                    ->where('livro.codigo', $request->codigo)
                    ->select('livro.codigo', 'livro.titulo', 'livro.autor', 'livro.editora', 'livro.edicao', 'livro.volume', 'exemplares.status', 'examplares.observacao')
                    ->get();

        return redirect()->route('auth.on.livro.consultar', ['livros' => $livros]);
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
        $livro->n_exemplares = $request->n_exemplares;

        $livro->save();

        $exmp = new Exemplar();
        $exmp = DB::table('livros')
                ->where('codigo', $request->codigo)->get()->first();
   

        $exemplar = new Exemplar();
        $exemplar->id_livro = $exmp->id;
        $exemplar->status = true;
        $exemplar->observacao = 'N/A';


        for($i = 0; $i < 3; $i++){
            $count[$i] = new Exemplar();
            $count[$i] = $exemplar;
            $count[$i]->save();
        }
        dd('OK');

        return redirect()->route('livro');

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
        //
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
