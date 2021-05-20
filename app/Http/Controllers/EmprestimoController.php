<?php

namespace App\Http\Controllers;

use App\Emprestimo;
use Illuminate\Http\Request;
use App\Estudante;
use App\Livro;
use App\Exemplar;
use App\Emprestimo_contem_exemplar;

use Illuminate\Support\Facades\DB;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->erro))
        {
            $erro = $request->erro;
            $params = array_merge(['$erro' => '$erro'], $_SESSION);
        }
        else
        {
            $params = array_merge(['$erro' => ''], $_SESSION);
        }

        return view('layouts.emprestimo', $params);

    }

    public function searchIndex()
    {
        return view('layouts.consultarEmprestimo', $_SESSION);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
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
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */


    public function show(Request $request)
    {
        //
        if($request->codigo != null){
            $id_livro = DB::table('livros')->where('codigo', $request->codigo)->get('id');
            if(isset($id_livro[0]->id)){
                $emprestimos = DB::table('emprestimos')
                            ->join('livros', 'emprestimos.id_livro', '=', 'livros.id')
                            ->join('funcionarios', 'emprestimos.id_funcionario','=', 'funcionarios.id')
                            ->join('estudantes', 'emprestimos.id_estudante','=', 'estudantes.id')
                            ->join('emprestimo_contem_exemplar', 'emprestimo_contem_exemplar.emprestimo_id', '=', 'emprestimos.id')
                            ->join('exemplares', 'emprestimo_contem_exemplar.exemplar_id','=','exemplares.id')
                            ->select('livros.codigo as codigo_livro', 'livros.titulo','emprestimos.id as id_emprestimo','emprestimos.data_emprestimo', 'emprestimos.data_limite' , 'emprestimo_contem_exemplar.exemplar_id as id_exemplar',
                            'estudantes.nome as nome_estudante','estudantes.matricula as matricula_estudante', 'funcionarios.nome as nome_funcionario','exemplares.status')
                            ->where('livros.id',$id_livro[0]->id )
                            ->get();
                $params = array_merge(['emprestimos' => $emprestimos], $_SESSION);
                return view('layouts.consultarEmprestimo', $params);
            }else{
                return redirect()->back();
            }
           

        }else if($request->matricula != null){
            $id_estudante = DB::table('estudantes')->where('matricula', $request->matricula)->get('id');
            if(isset($id_estudante[0]->id)){
                $emprestimos = DB::table('emprestimos')
                    ->join('estudantes', 'emprestimos.id_estudante','=', 'estudantes.id')
                    ->join('funcionarios', 'emprestimos.id_funcionario','=', 'funcionarios.id')
                    ->join('emprestimo_contem_exemplar', 'emprestimo_contem_exemplar.emprestimo_id', '=', 'emprestimos.id')         
                    ->join('exemplares', 'emprestimo_contem_exemplar.exemplar_id','=','exemplares.id')
                    ->join('livros', 'exemplares.id_livro', '=', 'livros.id')
                    ->select('livros.codigo as codigo_livro', 'livros.titulo','emprestimos.id as id_emprestimo','emprestimos.data_emprestimo', 'emprestimos.data_limite' , 'emprestimo_contem_exemplar.exemplar_id as id_exemplar',
                    'estudantes.nome as nome_estudante','estudantes.matricula as matricula_estudante', 'funcionarios.nome as nome_funcionario','exemplares.status')
                    ->where('estudantes.id', $id_estudante[0]->id )
                    ->get();
                $params = array_merge(['emprestimos' => $emprestimos], $_SESSION);
                return view('layouts.consultarEmprestimo', $params);
            }else{
                return redirect()->back();
            }
        }else{
            $emprestimos = DB::table('emprestimos')
                    ->join('funcionarios', 'emprestimos.id_funcionario','=', 'funcionarios.id')
                    ->join('estudantes', 'emprestimos.id_estudante','=', 'estudantes.id')
                    ->join('emprestimo_contem_exemplar', 'emprestimo_contem_exemplar.emprestimo_id', '=', 'emprestimos.id')
                    ->join('exemplares', 'emprestimo_contem_exemplar.exemplar_id','=','exemplares.id')
                    ->join('livros', 'exemplares.id_livro', '=', 'livros.id')
                    ->select('livros.codigo as codigo_livro', 'livros.titulo','emprestimos.id as id_emprestimo','emprestimos.data_emprestimo', 'emprestimos.data_limite' , 'emprestimo_contem_exemplar.exemplar_id as id_exemplar',
                    'estudantes.nome as nome_estudante','estudantes.matricula as matricula_estudante', 'funcionarios.nome as nome_funcionario','exemplares.status')
                    ->get();

            $params = array_merge(['emprestimos' => $emprestimos], $_SESSION);
            return view('layouts.consultarEmprestimo', $params);
        }

        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprestimo $emprestimo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprestimo $emprestimo)
    {
        //
    }
}
