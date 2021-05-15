<?php

namespace App\Http\Controllers;

use App\Emprestimo;
use Illuminate\Http\Request;
use App\Estudante;
use App\Livro;
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

        $estudante = new Estudante();

        $livro = new Livro();
        
        $qtd = [];
        $flag = false;
        $estudante = $estudante->where('matricula', $request->matricula)->get()->first();
        
        for($i = 1; $i < 6; $i++){
            $codigo = "codigo$i";
            $book = $livro->where('codigo', $request->$codigo)->get()->first();
            if($book != null){ 
                array_push($qtd, $i);
                $flag = true;
            }else{
                array_push($qtd, null);
            }
        }

        if(isset($estudante->nome) && $flag){

            $data = date('Y-m-d', strtotime($request->data_emprestimo)); 
            $limite = date('Y-m-d', strtotime("+15 days",strtotime($data))); 
            $emprestimo = new Emprestimo();
            $emprestimo->matricula = $request->matricula;
            $estudante = DB::table('estudantes')
                    ->where('matricula', $emprestimo->matricula)->get('id');
            $emprestimo->id_estudante = $estudante[0]->id;
            $emprestimo->id_funcionario = $_SESSION['id'];
            $emprestimo->data_emprestimo = $request->data_emprestimo;
            $emprestimo->data_limite = $limite;

            //$emprestimo->save();
            
        }else{	
            return redirect()->route('auth.on.emprestimo', ['erro' => '404']);
        };

        for($i = 1; $i < sizeof($qtd + 1); $i++){
            $emp = new Emprestimo_contem_exemplar();
           
        }
   
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
        $student = new Estudante();


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
