<?php

namespace App\PSaude;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
  protected $table = "psaude_consultorios";
  protected $fillable = ['nome'];
}
