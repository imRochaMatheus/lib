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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cadastro', 'CadastroController@index')->name('cadastro');
Route::post('/cadastro', 'CadastroController@create')->name('cadastro');

Route::get('/cadastroLivro', 'LivroController@index')->name('livro');
Route::post('/cadastroLivro', 'LivroController@create')->name('livro');

Route::get('/emprestimo', 'EmprestimoController@index')->name('emprestimo');
Route::post('/emprestimo', 'EmprestimoController@create')->name('emprestimo');

