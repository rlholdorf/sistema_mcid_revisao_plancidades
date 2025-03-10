<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class ViewEmendasValidadas extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.view_sys_emendas_validadas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function oficioEmenda()
   {
      return $this->belongsTo(ViewOficiosEmendas::class, 'oficio_emenda_id', 'oficio_emenda_id');
   }
}
