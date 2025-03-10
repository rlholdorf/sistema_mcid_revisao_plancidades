<?php

namespace App;

use App\Mod_planejamento_tarefas\PlanejamentoTarefas;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_sistema_se.opc_secretarias';

  //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function departamento()
  {
    return $this->hasMany(Departamentos::class);
  }

  public function planejamentoTarefas()
  {
    return $this->hasMany(PlanejamentoTarefas::class);
  }
}