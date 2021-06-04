<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'email',
        'senha',
        'nivel_de_acesso',
        'status'
    ];

}
