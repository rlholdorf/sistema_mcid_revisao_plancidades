<?php

namespace App\Mod_transferencias_especiais;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewPalavrasSecretarias extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_transferencia_especiais_novo.view_palavras_secretarias';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}