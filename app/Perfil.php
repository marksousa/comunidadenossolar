<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $primaryKey = 'usuario_id';
    protected $table = 'perfis';
    protected $fillable = ['motivo_id', 'data_inicio_nl', 'pilar_id', 'foto_path', 'usuario_id'];
    protected $dates = ['created_at', 'updated_at'];
    public $incrementing = false;
    public $timestamps = true;

    public function pilar()
    {
        //return $this->belongsTo('App\Pilar', 'pilar_id', 'id');
        return $this->belongsTo('App\Pilar');
    }


}
