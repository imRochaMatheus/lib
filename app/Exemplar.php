<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    //
    protected $table = 'exemplares';

    protected $fillable = 
    [
        'status',
        'observacao'
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
