<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $primaryKey = 'usuario_id';
    protected $table = 'enderecos';
    protected $fillable = ['endereco', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'estado', 'pais', 'usuario_id'];
    public $incrementing = false;
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'usuario_id', 'id');
    }
}
