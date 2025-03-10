<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class EtapasProjeto extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_plancidades.tab_etapas_projetos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização
}
