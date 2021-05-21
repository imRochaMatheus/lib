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

        $estudante = new Estudante();

        $livro = new Livro();
        
        $qtd = [];
        $flag = false;
        $estudante = $estudante->where('matricula', $request->matricula)->get()->first();
        
        for($i = 1; $i < 6; $i++){
            $codigo = "codigo$i";
            $book = $livro->where('codigo', $request->$codigo)->get()->first();
            if($book != null){ 
                $exemplar = DB::table('exemplares')->where('id_livro', $book)->where('status', true)->first();
                if($exemplar == null){
                    return redirect()->back();
                }
                array_push($qtd, $i);
                $flag = true;
            }else{
                array_push($qtd, null);
            }
        }

        $dados_emprestimo = new Emprestimo();
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
            $dados_emprestimo = $emprestimo;
            $emprestimo->save();
            $flag = false;
            
        }else{	
            $flag = false;
            return redirect()->route('auth.on.emprestimo', ['erro' => '404']);
            
        };

        for($i = 1; $i < sizeof($qtd); $i++){

            $emp = new Emprestimo_contem_exemplar();
            $codigo = "codigo$i";
            $book = DB::table('livros')->where('codigo', $request->$codigo)->get()->first();
            if($book != null){
                $id_livro = $book->id; 
                $exemplar = DB::table('exemplares')->where('id_livro', $id_livro)->where('status', true)->get()->first();
                if($exemplar != null){
                    $id_exemplar = $exemplar->id;
                    $emp->exemplar_id = $id_exemplar;
                    $emprest_id = DB::table('emprestimos')->where('id_estudante',$dados_emprestimo->id_estudante)
                                ->where('id_funcionario',$dados_emprestimo->id_funcionario)
                                ->where('matricula', $request->matricula)
                                ->where('data_emprestimo', $request->data_emprestimo)->get()->first();
                    $emprestimo_id = $emprest_id->id;
                    $emp->emprestimo_id = $emprestimo_id;
                    $emp->status = false;
                    $emp->data_devolucao = $request->data_emprestimo;
                    DB::table('exemplares')->where('id', $id_exemplar)->update(['status' => false]);                
                    $emp->save();
                }
                else{
                    echo 'Não há mais exemplares disponíveis';
                    return redirect()->back();
                    
                }
            }else{
                echo 'Sucesso';
                return redirect()->back();
            }
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

    public function devolver(Request $request)
    {
        try {
            DB::beginTransaction();
            /* devolve o exemplar */
            $emprestimo_contem_exemplar = new Emprestimo_contem_exemplar();
            $exemplar = $emprestimo_contem_exemplar->where('codigo_exemplar', $request->codigo_exemplar)->first();
            $exemplar->status = 1;
            $exemplar->data_devolucao = (new DateTime('now'))->format('Y-m-d');
            $exemplar->save();
    
            /* busca pelo empréstimo relacionado */
            $emprestimo = new Emprestimo();
            $emprestimo = $emprestimo->where('id', $exemplar->id_emprestimo)->first();
    
            /* se em atraso, calcula a multa */
            $data_limite = $exemplar->data_limite;
            $data_atual = new DateTime('now');
            
            if($data_limite < $data_atual) {
                $multa = $data_limite->diff($data_atual)->days;
                $emprestimo->multa = $multa;
                $emprestimo->save();
            }
            DB::commit();
        } catch(Exception $e) {
            echo $e->getMessage();
            DB::rollback();
        }

        return redirect()->back();
    }

    public function renovar(Request $request)
    {
        DB::transaction(function() {
            $emprestimo_contem_exemplar = new Emprestimo_contem_exemplar();
            $exemplar = $emprestimo_contem_exemplar->where('codigo_exemplar', $request->codigo_exemplar)->first();
            $exemplar->qtd_renovacoes = $exemplar->qtd_renovacoes - 1;
            $exemplar->data_limite = $exemplar->data_limite->add(new DateInterval('P7D'));
            $exemplar->save();
        });    
        
        return redirect()->back();
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
