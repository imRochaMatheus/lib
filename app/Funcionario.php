<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'matricula',
        'id_usuario',
        'telefone',
        'cargo',
        'usuario_id'
    ];
    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
