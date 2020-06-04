<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Papel;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'cpf', 'email', 'password', 'photo_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
      'email_verified_at' => 'datetime',
    ];

    public function eAdmin()
    {
      //return $this->id == 1;
      return $this->existePapel('Admin');
    }

    public function papeis()
    {
      return $this->belongsToMany(Papel::class);
    }

    public function adicionaPapel($papel)
    {
      $papel = $this->converteParaPapel($papel);

      // Verifica se o papel que queremos adicionar, já não existe para o user
      if($this->existePapel($papel)){
        return;
      }

      // Adiciona o papel ao user
      return $this->papeis()->attach($papel);
    }

    public function converteParaPapel($papel){
      // Se o papel vier como string ele converte para objeto do tipo Papel
      if (is_string($papel)){
        $papel = Papel::where('nome','=',$papel)->firstOrFail();
      }
      return $papel;
    }

    public function existePapel($papel)
    {
      $papel = $this->converteParaPapel($papel);
      return (boolean) $this->papeis()->find($papel->id);
    }

    public function removePapel($papel)
    {
      $papel = $this->converteParaPapel($papel);
      // Remove o relacionamento do User com Papel
      return $this->papeis()->detach($papel);
    }

    /**
     * Verifica se o usuario logado possui uma lista de papeis enviada por parametro
     *
     * @param  list Papeis 
     * @return boolean
     */
    public function temUmPapelDestes($papeis)
    {
      // lista de papeis do usuario logado
      $userPapeis = $this->papeis;

      return $papeis->intersect($userPapeis)->count();
    }
}
