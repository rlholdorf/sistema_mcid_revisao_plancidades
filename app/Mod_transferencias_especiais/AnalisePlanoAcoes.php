<?php

namespace App\Mod_transferencias_especiais;

use App\Secretaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AnalisePlanoAcoes extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'cod_plano_acao';

   protected $table = 'mcid_transferencia_especiais_novo.tab_analise_plano_acoes';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}