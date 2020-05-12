<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
	protected $table = "estados";

	public function pais(){
		return $this->belongsTo('App\pais', 'pais_id', 'id');
	}
}
