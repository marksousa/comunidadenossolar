<?php

namespace App\Saude;

use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'saude_prontuarios';
    protected $fillable = ['usuario_id', 'numero_sus', 'nome_mae', 'nome_pai', 'municipio_nascimento', 'profissao', 'estado_civil', 'raca', 'religiao', 'tipo_sanguineo'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;
}
