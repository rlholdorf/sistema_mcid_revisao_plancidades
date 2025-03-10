<?php

namespace App\Corporativo\Mcid_repositorios_carga\Nova_tci;

use Illuminate\Database\Eloquent\Model;

class TabContratoUnidade extends Model
{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_repositorio_carga_nova_tci.tab_contrato_unidade';

    protected $keyType = 'string';

    protected $primaryKey = 'cod_tci';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}