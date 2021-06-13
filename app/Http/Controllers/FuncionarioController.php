<?php

namespace App\Http\Controllers;

use App\Funcionario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meses = [
            '01' => 'Jan',
            '02' => 'Fev',
            '03' => 'Mar',
            '04' => 'Abr',
            '05' => 'Maio',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ago',
            '09' => 'Set',
            '10' => 'Out',
            '11' => 'Nov',
            '12' => 'Dez'
        ];

        $data_atual = new \DateTime('now');
        $mes_atual = $data_atual->format('m');

        $labels = [];
        $numero_de_emprestimos_por_mes = [];
        foreach ($meses as $key => $value) {
            if ($key > $mes_atual) break;
            
            array_push($labels, $meses[$key]);
            $numero_de_emprestimos = DB::table('emprestimos')->whereMonth('data_emprestimo', $key)->count();
            array_push($numero_de_emprestimos_por_mes, $numero_de_emprestimos);
        }

        $devolucoes = DB::table('emprestimo_contem_exemplar')->where('status', 1)->count();
        $atrasados = DB::table('emprestimo_contem_exemplar')
            ->where('status', 0)
            ->whereDate('data_limite', '<', $data_atual->format('Y-m-d'))
            ->whereDate('data_devolucao', NULL)
            ->count();
        $emprestados = DB::table('emprestimo_contem_exemplar')
            ->where('status', 0)
            ->whereDate('data_limite', '>=', $data_atual->format('Y-m-d'))
            ->whereDate('data_devolucao', NULL)
            ->count();

        $bar = app()->chartjs
            ->name('emprestimosPorMes')
            ->type('bar')
            ->size(['width' => 300, 'height' => 170])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Número de Empréstimos",
                    'backgroundColor' => ['#FFD666'],
                    'data' => $numero_de_emprestimos_por_mes
                ]
            ])
            ->options([]);

        $pie = app()->chartjs
            ->name('emprestimos')
            ->type('pie')
            ->size(['width' => 400, 'height' => 170])
            ->labels(['Devolvido ', 'Em Atraso ', 'Emprestado'])
            ->datasets([
                [
                    'backgroundColor' => ['#15C3D6', '#17D6EB', '#96FEFF'],
                    'hoverBackgroundColor' => ['#15C3D6', '#17D6EB', '#96FEFF'],
                    'data' => [$devolucoes, $atrasados, $emprestados]
                ]
            ])
            ->options([]);
        
        $params = array_merge($_SESSION, compact('bar'), compact('pie'));

        return view('layouts.dashboardFuncionario', $params);
    }

    public function searchIndex(Request $request)
    {
        if(empty($request->matricula)) {
            $funcionarios = DB::table('funcionarios')
            ->join('usuarios', 'funcionarios.id_usuario', '=', 'usuarios.id')
            ->join('cargos', 'funcionarios.cargo', '=', 'cargos.id')
            ->select('usuarios.id', 'funcionarios.matricula', 'usuarios.status', 'funcionarios.nome', 'cargos.nome AS cargo', 'usuarios.nivel_de_acesso')
            ->get();
        } else {
            $funcionarios = DB::table('funcionarios')
            ->join('usuarios', 'funcionarios.id_usuario', '=', 'usuarios.id')
            ->join('cargos', 'funcionarios.cargo', '=', 'cargos.id')
            ->where('funcionarios.matricula', $request->matricula)
            ->select('usuarios.id', 'funcionarios.matricula', 'usuarios.status', 'funcionarios.nome', 'cargos.nome as cargo', 'usuarios.nivel_de_acesso')
            ->get();            
        }

        foreach($funcionarios as $funcionario) {
            if($funcionario->nivel_de_acesso == 1) {
                $funcionario->nivel_de_acesso = 'Administrador';
            } elseif($funcionario->nivel_de_acesso == 2) {
                $funcionario->nivel_de_acesso = 'Funcionário';
            } else {
                $funcionario->nivel_de_acesso = 'Estudante';
            }

            $funcionario->cargo = ucfirst($funcionario->cargo);
        }
        
        $params = array_merge($_SESSION, ['funcionarios' => $funcionarios]);
        return view('layouts.consultarFuncionario', $params); 
    }
}
