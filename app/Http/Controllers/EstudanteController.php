<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Usuario;
use App\Livro;
use App\Emprestimo;
use App\Comentario;
use App\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class EstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $comentarios = DB::table('comentarios')->get();
        if($comentarios != null){
            foreach ($comentarios as $key => $coment) {
                $coment->foto = DB::table('livros')
                ->where('codigo', $coment->codigo_livro)
                ->first('foto')->foto;
            }
            $params = array_merge(['comentarios' => $comentarios], $_SESSION);
            return view('layouts.dashboardEstudante',$params);
        }
        return view('layouts.dashboardEstudante',$_SESSION);
    }
    public function searchIndex(Request $request)
    {
        if(empty($request->matricula)) {
            $estudantes = DB::table('estudantes')
            ->join('usuarios', 'estudantes.id_usuario', '=', 'usuarios.id')
            ->select('usuarios.id', 'estudantes.matricula', 'usuarios.status', 'estudantes.nome', 'usuarios.nivel_de_acesso')
            ->get();
        } else {
            $estudantes = DB::table('estudantes')
            ->join('usuarios', 'estudantes.id_usuario', '=', 'usuarios.id')
            ->where('estudantes.matricula', $request->matricula)
            ->select('usuarios.id', 'estudantes.matricula', 'usuarios.status', 'estudantes.nome', 'usuarios.nivel_de_acesso')
            ->get();            
        }

        foreach($estudantes as $estudante) {
                $estudante->nivel_de_acesso = 'Estudante';
            }
                
        $params = array_merge($_SESSION, ['estudantes' => $estudantes]);
        return view('layouts.consultarEstudante', $params); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudante  $estudante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = DB::table('usuarios')->where('id', $request->usuario_id)->first();
        $estudante = DB::table('estudantes')->where('id_usuario', $request->usuario_id)->first();
        $emprestimo = DB::table('emprestimos')->where('id_estudante', $estudante->id)
        ->join('emprestimo_contem_exemplar', 'emprestimos.id', '=', 'emprestimo_contem_exemplar.emprestimo_id')
        ->where('status', false)->first();

        if($emprestimo == null) {
            DB::table('estudantes')->where('id_usuario', $request->usuario_id)->delete();
            DB::table('usuarios')->where('id', $request->usuario_id)->delete();
            return redirect()->back()->with('message', 'Sucesso ao deletar registro');
        } else {
            return redirect()->back()->with('message', 'Não foi possível excluir o registro de estudante');
        }
    }
}
