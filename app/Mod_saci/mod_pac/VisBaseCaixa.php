<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class VisBaseCaixa extends Model
{
    protected $connection	= 'pgsql_corp';
    
   protected $table = 'pac.vis_base_caixa';

   protected $primaryKey = 'contrato';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    

}
