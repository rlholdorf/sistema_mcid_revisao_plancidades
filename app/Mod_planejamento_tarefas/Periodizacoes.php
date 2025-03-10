<?php

namespace App\Mod_planejamento_tarefas;

use App\Secretaria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Periodizacoes extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_planejamento_tarefas.opc_periodizacao';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}