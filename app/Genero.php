<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'generos';
    protected $fillable = ['id', 'nome'];
    public $incrementing = true;

    public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'genero_id', 'id');
    }
}
