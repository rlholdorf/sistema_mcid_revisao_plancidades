<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class SituacoesEtapasProjetos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_situacao_etapas_projetos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
