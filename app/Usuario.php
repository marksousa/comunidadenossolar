<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'usuarios';
    protected $fillable = ['cpf', 'nome', 'genero_id', 'data_nascimento', 'email', 'ddd_residencial', 'telefone_residencial', 'ddd_celular', 'telefone_celular', 'termo_adesao'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function genero()
    {
        return $this->belongsTo('App\Genero');
    }

    public function endereco()
    {
        return $this->hasOne('App\Endereco', 'usuario_id','id');
    }

    public function perfil()
    {
        return $this->hasOne('App\Perfil', 'usuario_id', 'id');
    }

    public function motivos()
    {
        return $this->belongsToMany('App\Motivo', 'motivo_usuario');
    }

}
