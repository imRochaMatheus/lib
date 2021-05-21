<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    //
    protected $fillable = 
    [
        'data_emprestimo',
        'multa',
        'id_funcionario',
        'id_estudante',
    ];

    public $timestamps = false;
}
