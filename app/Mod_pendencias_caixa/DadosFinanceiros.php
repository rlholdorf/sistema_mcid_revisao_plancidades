<?php

namespace App\Mod_pendencias_caixa;

use Illuminate\Database\Eloquent\Model;

class DadosFinanceiros extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $keyType = 'string';

  protected $table = 'pendencias_caixa.tab_dados_financeiros';

  public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
