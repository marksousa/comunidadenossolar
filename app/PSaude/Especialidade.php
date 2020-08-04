<?php

namespace App\PSaude;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
  protected $table = "psaude_especialidades";
  protected $fillable = ['nome'];
}
