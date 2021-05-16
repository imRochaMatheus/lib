<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    //
    protected $table = 'exemplares';

    protected $fillable = 
    [
        'id_livro',
        'status',
        'observacao',
        
    ];

    public $timestamps = false;

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
