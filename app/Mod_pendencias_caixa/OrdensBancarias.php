<?php

namespace App\Mod_pendencias_caixa;

use Illuminate\Database\Eloquent\Model;

class OrdensBancarias extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $keyType = 'string';

  protected $table = 'pendencias_caixa.tab_ordem_bancaria';

  public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
