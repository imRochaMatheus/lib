<?php

namespace App\Http\Controllers;

use App\Livro;
use App\Exemplar;
use App\Comentario;
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
            ->join('comentarios', 'comentarios.codigo_livro', '=', 'livros.codigo')
            ->join('estudantes', 'comentarios.usuario_id', '=', 'estudantes.id')
            ->select('codigo', 'titulo', 'autor', 'editora', 'edicao', 'volume','numero_de_paginas','numero_de_emprestimos', 'descricao', 'comentario', 'foto', 'estudantes.nome')
            ->get();

            return view('layouts.consultarLivro', $_SESSION, ['livros' => $livros, 'action' => 1]); 

        }else{
            $livros = DB::table('livros')->get()->all();

            for($i = 0; $i < count($livros); $i++) {
                $comentarios = DB::table('comentarios')
                    ->join('estudantes', 'comentarios.usuario_id', '=', 'estudantes.id_usuario')
                    ->where('comentarios.codigo_livro', $livros[$i]->codigo)
                    ->select('comentarios.comentario', 'estudantes.nome')
                    ->get()
                    ->all();
                $livros[$i]->comentario = json_encode($comentarios);
            }

            return view('layouts.consultarLivro', $_SESSION, ['livros' => $livros]); 
        }
    }

    public function getAll(Request $request)
    {
        return redirect()->route('auth.on.livro.consultar', ['livros' => $request->codigo]);
    }


    public function gerarRelatorio(Request $request){

        $dataInicio = \DateTime::createFromFormat('Y-m-d', $request->dataInicial);
        $dataFim = \DateTime::createFromFormat('Y-m-d', $request->dataFinal);
        
        $livros = DB::table('livros')->where('livros.created_at', '>=', $dataInicio)
            ->where('livros.created_at', '<=', $dataFim)
            ->get();

       
        for($i = 0; $i < count($livros); $i++) {
            $livros[$i]->created_at = (new \DateTime($livros[$i]->created_at))->format('d/m/Y');
            $livros[$i]->updated_at = (new \DateTime($livros[$i]->updated_at))->format('d/m/Y');
        }

        $pdf = \PDF::loadView('layouts.relatorios.relatorioLivro', compact('livros'))
                    ->setPaper('a4', 'landscape')
                    ->stream('relatorio-livros.pdf', array('Attachment' => false));
                    //->download('relatorio-emprestimo.pdf');              
        return $pdf;
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

        if($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $extensoes_permitidas = ['png', 'jpg', 'jpeg'];
            $extensao = $request->foto->extension();

            if(!in_array($extensao, $extensoes_permitidas)) {
                return redirect()->back()->with('message', 'Formato inválido.');
            }

            $nome = "{$request->codigo}.{$extensao}";
            $storage_path = "storage/books/{$nome}";

            $upload = $request->foto->storeAs('books', $nome);
        

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
                $livro->foto = $storage_path;
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
            echo $e->getMessage();

            return redirect()->back()->with('message', 'Não foi possível cadastrar o livro.');
        }
    }else{
        return redirect()->back()->with('message', 'Problema na foto');
    }
        
        return redirect()->back()->with('message', 'Livro cadastrado com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            \DB::beginTransaction();
            DB::table('livros')->where('codigo', $request->codigo)->update([
                'titulo' => $request->titulo, 'autor' => $request->autor, 
                'editora' => $request->editora, 'edicao' => $request->edicao,
                'volume' => $request->volulme, 'numero_de_paginas' => $request->numero_de_paginas,
                'descricao' => $request->descricao, 'volume' => $request->volume
            ]);
            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();
            echo $e->getMessage();

            return redirect()->back()->with('message', 'Não foi possível editar o livro.');
        }
        
        return redirect()->back()->with('message', 'Livro editado com sucesso.');
    }
}
