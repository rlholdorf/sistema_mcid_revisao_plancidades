<?php

namespace App\Mod_saci\mod_pac;

use App\Mod_saci\mod_sistema\Secretaria;
use App\Mod_saci\mod_sistema\Usuario;

use Illuminate\Database\Eloquent\Model;

use DB;



class ObservacoesContratos extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'pac.tab_observacoes_contratos';

   protected $primaryKey = 'cod_historico_obs_contrato';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização



   public function contratoPac()
   {
      return $this->belongsTo(ContratosPac::class, 'cod_contrato_pac', 'cod_contrato_pac'); //possui muitos
   }
}
