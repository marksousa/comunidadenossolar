<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilar extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pilares';
    protected $fillable = ['id', 'nome', 'areas'];
    protected $dates = ['created_at', 'updated_at'];
    public $incrementing = true;
    public $timestamps = true;

    public function perfil()
    {
        //return $this->hasMany('App\Perfil', 'pilar_id', 'id');
        return $this->hasMany('App\Perfil');
    }
}
