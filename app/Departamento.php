<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.opc_departamentos';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function setores(){
      return $this->hasMany(Setor::class);
    }

    public function secretaria(){
      return $this->belongsTo(Secretaria::class);
  }
}
