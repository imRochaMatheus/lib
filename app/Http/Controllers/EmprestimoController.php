<?php

namespace App\Http\Controllers;

use App\Emprestimo;
use Illuminate\Http\Request;
use App\Estudante;
use App\Livro;
use App\Exemplar;
use App\Emprestimo_contem_exemplar;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

    public function getAll(Request $request)
    {
        if($request->buscar_por == 1){
            $emprestimos = DB::table('emprestimos')
            ->join('funcionarios', 'emprestimos.id_funcionario','=', 'funcionarios.id')
            ->join('estudantes', 'emprestimos.id_estudante','=', 'estudantes.id')->where('estudantes.matricula', $request->matricula)
            ->join('emprestimo_contem_exemplar', 'emprestimos.id', '=', 'emprestimo_contem_exemplar.emprestimo_id')
            ->join('exemplares', 'exemplares.codigo','=', 'emprestimo_contem_exemplar.codigo_exemplar')
            ->join('livros', 'livros.id','=', 'exemplares.id_livro')
            ->select('estudantes.matricula', 'emprestimo_contem_exemplar.codigo_exemplar','emprestimos.data_emprestimo as emprestimo',
            'estudantes.nome as estudante', 'funcionarios.nome as funcionario', 'emprestimos.multa', 'emprestimo_contem_exemplar.status',
            'emprestimo_contem_exemplar.renovacoes as qtd_renovacoes', 'livros.titulo', 'emprestimo_contem_exemplar.data_limite')
            ->get();

            foreach($emprestimos as $emprestimo) {
                $emprestimo->emprestimo = (new \DateTime($emprestimo->emprestimo))->format('d/m/Y');
                $emprestimo->data_limite = (new \DateTime($emprestimo->data_limite))->format('d/m/Y');
            }

            $params = array_merge(['emprestimos' => $emprestimos], $_SESSION);

            return view('layouts.consultarEmprestimo', $params);
        } else if($request->buscar_por == 2){
            $emprestimos = DB::table('emprestimos')
            ->join('funcionarios', 'emprestimos.id_funcionario','=', 'funcionarios.id')
            ->join('estudantes', 'emprestimos.id_estudante','=', 'estudantes.id')
            ->join('emprestimo_contem_exemplar', 'emprestimos.id', '=', 'emprestimo_contem_exemplar.emprestimo_id')
            ->join('exemplares', 'exemplares.codigo','=', 'emprestimo_contem_exemplar.codigo_exemplar')->where('exemplares.codigo', $request->codigo)
            ->join('livros', 'livros.id','=', 'exemplares.id_livro')
            ->select('estudantes.matricula', 'emprestimo_contem_exemplar.codigo_exemplar','emprestimos.data_emprestimo as emprestimo',
            'estudantes.nome as estudante', 'funcionarios.nome as funcionario', 'emprestimos.multa', 'emprestimo_contem_exemplar.status',
            'emprestimo_contem_exemplar.renovacoes as qtd_renovacoes', 'livros.titulo', 'emprestimo_contem_exemplar.data_limite')
            ->get();

            foreach($emprestimos as $emprestimo) {
                $emprestimo->emprestimo = (new \DateTime($emprestimo->emprestimo))->format('d/m/Y');
                $emprestimo->data_limite = (new \DateTime($emprestimo->data_limite))->format('d/m/Y');
            }

            $params = array_merge(['emprestimos' => $emprestimos], $_SESSION);

            return view('layouts.consultarEmprestimo', $params);
        } else{
            //página de falha
        }
       
    }

    public function gerarRelatorio(Request $request)
    {
       

        $dataInicio = \DateTime::createFromFormat('Y-m-d', $request->dataInicial);
        $dataFim = \DateTime::createFromFormat('Y-m-d', $request->dataFinal);
        
        $emprestimos = DB::table('emprestimos')->where('emprestimos.created_at', '>=', $dataInicio)
            ->where('emprestimos.created_at', '<=', $dataFim)
            ->join('estudantes', 'emprestimos.id_estudante', '=', 'estudantes.id')
            ->join('funcionarios', 'emprestimos.id_funcionario','=', 'funcionarios.id')
            ->join('emprestimo_contem_exemplar', 'emprestimos.id', '=', 'emprestimo_contem_exemplar.emprestimo_id')
            ->join('exemplares', 'emprestimo_contem_exemplar.codigo_exemplar', '=', 'exemplares.codigo')
            ->join('livros', 'exemplares.id_livro', '=', 'livros.id')
            ->select('emprestimos.data_emprestimo', 'estudantes.nome as estudante_nome', 'estudantes.matricula as estudante_matricula',
                     'funcionarios.nome as funcionario_nome', 'funcionarios.matricula as funcionario_matricula', 'emprestimo_contem_exemplar.codigo_exemplar',
                     'emprestimo_contem_exemplar.data_limite', 'emprestimo_contem_exemplar.status','livros.titulo', 'livros.autor', 'livros.editora', 'livros.edicao', 'livros.volume'
                    )
            ->get();

        foreach($emprestimos as $emprestimo) {
            $emprestimo->data_emprestimo = (new \DateTime($emprestimo->data_emprestimo))->format('d/m/Y');
            $emprestimo->data_limite = (new \DateTime($emprestimo->data_limite))->format('d/m/Y');
        }

        $pdf = \PDF::loadView('layouts.relatorios.relatorioEmprestimo', compact('emprestimos'))
                    ->setPaper('a4', 'landscape')
                    ->stream('relatorio-emprestimo.pdf', array('Attachment' => false));
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
        $flag = false;
        $volumes = [];

        $estudante = DB::table('estudantes')->where('matricula', $request->matricula)->get()->first();
        if($estudante != null){ 
            for($i = 1; $i < 6; $i++){
                $codigo = "codigo$i";
                if(!Empty($request->$codigo)){
                    $exemplar = DB::table('exemplares')->where('codigo', $request->$codigo)->get()->first();
                    if($exemplar != null && $exemplar->status != false){
                        $flag = true;
                        array_push($volumes, $exemplar->codigo);
                    }else{
                        return redirect()->back()->with('message', 'Exemplar ' . $request->$codigo . ' não encontrado e/ou disponível.');
                    }      
                }
            }
            if($flag){
                try{
                    \DB::beginTransaction();
                       $emprestimo = new Emprestimo();
                       $emprestimo->id_estudante = $estudante->id;
                       $emprestimo->id_funcionario = $_SESSION['id'];
                       $emprestimo->data_emprestimo = $request->data_emprestimo;
                       $emprestimo->save();

                       for($i = 0; $i < sizeof($volumes) ; $i++){
                            $emprestimo_exemplar = new Emprestimo_contem_exemplar();
                            $emprestimo_id = DB::table('emprestimos')->where('id_estudante', $estudante->id)
                                                ->where('id_funcionario', $_SESSION['id'])
                                                ->where('data_emprestimo', $request->data_emprestimo)
                                                ->get();
                            $emprestimo_exemplar->emprestimo_id = $emprestimo_id[0]->id;
                            $data = date('Y-m-d', strtotime($request->data_emprestimo)); 
                            $limite = date('Y-m-d', strtotime("+ 7days",strtotime($data))); 
                            $emprestimo_exemplar->data_limite = $limite;
                            $emprestimo_exemplar->codigo_exemplar = $volumes[$i];
                            $emprestimo_exemplar->save();
                            DB::table('exemplares')->where('codigo', $emprestimo_exemplar->codigo_exemplar)
                            ->update(['status' => false]);

                            $id_exemplar = DB::table('exemplares')->where('codigo', $volumes[$i])->first('id_livro');
                            $id_livro = $id_exemplar->id_livro;
                            $qtd_emprestimos = DB::table('livros')->where('id', $id_livro)->first('numero_de_emprestimos');
                            DB::table('livros')->where('id', $id_livro)->update(['numero_de_emprestimos' => $qtd_emprestimos->numero_de_emprestimos +1]);
                       }
                    \DB::commit();
                }catch(\Exception $e){
                    \DB::rollback();
                    echo $e->getMessage();

                    return redirect()->back()->with('message', 'Não foi possível realizar o empréstimo.');
                }                
            } else {
                return redirect()->back()->with('message', 'Exemplar ' . $request->$codigo . ' não encontrado.');
            }
        } else {
            return redirect()->back()->with('message', 'Estudante não cadastrado.');
        }
        return redirect()->back()->with('message', 'Empréstimo realizado com sucesso.');
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
        $emprestimos = DB::table('emprestimos')
                    ->join('funcionarios', 'emprestimos.id_funcionario','=', 'funcionarios.id')
                    ->join('estudantes', 'emprestimos.id_estudante','=', 'estudantes.id')
                    ->join('emprestimo_contem_exemplar', 'emprestimos.id', '=', 'emprestimo_contem_exemplar.emprestimo_id')
                    ->join('exemplares', 'exemplares.codigo','=', 'emprestimo_contem_exemplar.codigo_exemplar')
                    ->join('livros', 'livros.id','=', 'exemplares.id_livro')
                    ->select('estudantes.matricula', 'emprestimo_contem_exemplar.codigo_exemplar as codigo','emprestimos.data_emprestimo as emprestimo', 
                    'estudantes.nome as estudante', 'funcionarios.nome as funcionario', 'emprestimos.multa', 'emprestimo_contem_exemplar.status',
                    'emprestimo_contem_exemplar.renovacoes as qtd_renovacoes', 'livros.titulo', 'emprestimo_contem_exemplar.data_limite')
                    ->get();

        foreach($emprestimos as $emprestimo) {
            $emprestimo->emprestimo = (new \DateTime($emprestimo->emprestimo))->format('d/m/Y');
            $emprestimo->data_limite = (new \DateTime($emprestimo->data_limite))->format('d/m/Y');
        }

        $params = array_merge(['emprestimos' => $emprestimos], $_SESSION);
        return view('layouts.consultarEmprestimo', $params);
    }
    
    public function devolver(Request $request)
    {
        try {
            DB::beginTransaction();
            /* devolve o exemplar */
            $emprestimo_contem_exemplar = new Emprestimo_contem_exemplar();
            $exemplar = $emprestimo_contem_exemplar->where('codigo_exemplar', $request->codigo_exemplar)
            ->where('status', false)->first();
            $exemplar->status = 1;
            $exemplar->data_devolucao = (new \DateTime('now'))->format('Y-m-d');
            $exemplar->save();
            DB::table('exemplares')->where('codigo', $exemplar->codigo_exemplar)
            ->update(['status'=>true]);
    
            /* busca pelo empréstimo relacionado */
            $emprestimo = new Emprestimo();
            $emprestimo = $emprestimo->where('id', $exemplar->emprestimo_id)->first();
    
            /* se em atraso, calcula a multa */
            $data_limite = new \DateTime($exemplar->data_limite);
            $data_atual = new \DateTime('now');
            
            if($data_limite < $data_atual) {
                $multa = $data_limite->diff($data_atual)->days;
                $emprestimo->multa = $multa;
                $emprestimo->save();
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            echo $e->getMessage();

            return redirect()->back()->with('message', 'Não foi possível realizar a devolução do exemplar.');
        }

        return redirect()->back()->with('message', 'Exemplar devolvido com sucesso.');
    }

    public function renovar(Request $request)
    {
        try {
            DB::beginTransaction();
            $emprestimo_contem_exemplar = new Emprestimo_contem_exemplar();
            $exemplar = $emprestimo_contem_exemplar->where('codigo_exemplar', $request->codigo_exemplar)
            ->where('status', false)->first();
            $exemplar->renovacoes = $exemplar->renovacoes - 1;
            $data_atual = new \DateTime($exemplar->data_limite);
            $exemplar->data_limite = $data_atual->add(new \DateInterval('P7D'));
            $exemplar->save();
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            echo $e->getMessage();

            return redirect()->back()->with('message', 'Não foi possível realizar a renovação do exemplar.');
        }  
        
        return redirect()->back()->with('message', 'Exemplar renovado com sucesso por mais 7 dias.');
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
