<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IndicadoresObjetivosEstrategicos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_plancidades.tab_indicadores_objetivos_estrategicos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização



   public function objetivoEstrategico(): BelongsTo
   {
      return $this->belongsTo(ObjetivosEstrategicos::class, 'objetivo_estrategico_pei_id', 'id');
   }

   public function unidadeResponsavel(): BelongsTo
   {
      return $this->belongsTo(UnidadesResponsaveis::class, 'unidade_responsavel_id');
   }

   public function unidadeMedida(): HasOne
   {
      return $this->hasOne(UnidadesMedidas::class, 'id', 'unidade_medida_id');
   }

   public function periodicidade()
   {
      return $this->hasOne(Periodicidades::class, 'id', 'periodicidades_id');
   }

   public function meta()
   {
      return $this->hasOne(ViewIndicadoresObjetivosEstrategicosMetas::class, 'id');
   }
}
