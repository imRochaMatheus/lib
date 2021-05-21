<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LoginController@index')->name('login');
Route::post('/', 'LoginController@autenticar')->name('login');
Route::get('/logout', 'LoginController@sair')->name('logout');
Route::get('/recuperar-senha', function() {
    return view('layouts.recuperarSenha');
})->name('recuperarSenha');

Route::prefix('auth')->middleware('autenticacao')->group(function(){

    Route::prefix('on')->middleware('autenticacao')->group(function(){

        Route::get('/dashboard', 'FuncionarioController@index')->name('auth.on.dashboard');

        Route::get('/cadastro', 'CadastroController@index')->name('auth.on.cadastro');
        Route::post('/cadastro', 'CadastroController@create')->name('auth.on.cadastro');

        Route::get('/consultar-livro/{livro?}', 'LivroController@searchIndex')->name('auth.on.livro.consultar');
        Route::post('/consultar-livro', 'LivroController@getAll')->name('auth.on.livro.consultar');

        Route::get('/cadastro-livro', 'LivroController@index')->name('auth.on.livro.cadastrar');
        Route::post('/cadastro-livro', 'LivroController@create')->name('auth.on.livro.cadastrar');

        Route::get('/buscar-emprestimo', 'EmprestimoController@show')->name('auth.on.emprestimo.consultar');
        Route::get('/emprestimo/{erro?}', 'EmprestimoController@index')->name('auth.on.emprestimo.realizar');
        Route::post('/buscar-emprestimo', 'EmprestimoController@getAll')->name('auth.on.emprestimo.consultar');
        Route::post('/emprestimo', 'EmprestimoController@create')->name('auth.on.emprestimo.realizar');
        Route::post('/devolucao', 'EmprestimoController@devolver')->name('auth.on.emprestimo.devolver');
        Route::post('/renovar', 'EmprestimoController@renovar')->name('auth.on.emprestimo.renovar');

        Route::get('/consultar-funcionario', 'FuncionarioController@searchIndex')->name('auth.on.funcionario.consultar');
        Route::post('/consultar-funcionario', 'FuncionarioController@searchIndex')->name('auth.on.funcionario.consultar');

        Route::get('/editar-perfil', function() {
            return view('layouts.editarPerfil', $_SESSION);
        })->name('auth.on.cadastro.editar');

        Route::get('/gerar-relatorio/{tipo}', function($tipo) {
            $params = array_merge($_SESSION, ['tipo' => $tipo]);
            return view('layouts.gerarRelatorio', $params);
        })->name('auth.on.relatorio.gerar');
    });
    Route::prefix('estudante')/*->middleware('')*/->group(function(){
        Route::get('/painel', 'EstudanteController@index')->name('auth.estudante.painel');
    });
});
