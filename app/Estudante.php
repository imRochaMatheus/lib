<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    //
    protected $fillable = 
    [
        'nome',
        'email',
        'matricula',
        'telefone',
        'id_usuario'
    ];

    public $timestamps = false;

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
    
}
