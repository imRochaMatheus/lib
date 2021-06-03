<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Emprestimo_contem_exemplar extends Model
{
   
    protected $fillable = ['codigo_exemplar', 'emprestimo_id', 'data_devolucao', 'data_limite', 'renovacoes', 'status'];
    protected $table = 'emprestimo_contem_exemplar';
    

}
