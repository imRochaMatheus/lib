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

table->id();
            $table->unsignedBigInteger('id_estudante');
            $table->unsignedBigInteger('id_funcionario');
            $table->datetime('data_emprestimo');
            $table->double('multa')->default(0);