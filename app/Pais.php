<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
	protected $table = "paises";

    // Relacionamento UM pra N
    public function estados(){
        return $this->hasMany('App\Estado');
    }
}
