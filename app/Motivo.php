<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'motivos';
    protected $fillable = ['id', 'nome'];
    public $incrementing = true;
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function perfil()
    {
        return $this->hasMany('App\Perfil');
    }
}
