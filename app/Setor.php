<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.opc_setores';

   //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function users(){
      return $this->hasMany(User::class);
    }

    public function departamento(){
      return $this->belongsTo(Departamento::class);
  }

}
