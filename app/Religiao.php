<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religiao extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'religioes';
    protected $fillable = ['nome'];
    protected $dates = ['created_at', 'updated_at'];
    public $incrementing = true;
    public $timestamps = true;

    public function perfil()
    {
        //return $this->hasMany('App\Perfil', 'pilar_id', 'id');
        return $this->hasMany('App\Perfil');
    }
}
