<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ObjetivosEstrategicos extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_plancidades.opc_objetivos_estrategicos_pei';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function indicador(){
      return $this->hasOne(IndicadoresObjetivosEstrategicos::class, 'objetivo_estrategico_pei_id', 'id'); 
   }
}