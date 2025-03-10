<?php

namespace App\Mod_planejamento_tarefas;

use Illuminate\Database\Eloquent\Model;

class ViewTarefasEtapas extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_planejamento_tarefas.view_tarefas_etapas';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

}