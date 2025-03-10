<?php

namespace App\Mod_planejamento_tarefas;

use App\Secretaria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ListaVerificacao extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_planejamento_tarefas.opc_lista_verificacao';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}