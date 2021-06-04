<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    //

    protected $dates = ['deleted_at'];
    
    protected $table = 'exemplares';

    protected $fillable = 
    [
        'id_livro',
        'codigo',        
    ];
    
    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

}
