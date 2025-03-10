<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TipoInstrumento extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'cod_tipo_instrumento';

   protected $table = 'mcid_carteira_investimento.opc_tipo_instrumento';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
