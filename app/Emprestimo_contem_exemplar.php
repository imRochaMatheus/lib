<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo_contem_exemplar extends Model
{
    //
    protected $fillable = ['exemplar_id', 'emprestimo_id', 'data_devolucao', 'status'];

    protected $table = 'emprestimo_contem_exemplar';

    public $timestamps = false;

}
