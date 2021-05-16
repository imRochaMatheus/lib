<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    //
    protected $fillable = 
    [
        'data_devolucao'
    ];

    public $timestamps = false;
}
