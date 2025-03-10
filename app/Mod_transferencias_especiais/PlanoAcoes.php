<?php

namespace App\Mod_transferencias_especiais;

use App\Secretaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PlanoAcoes extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'cod_plano_acao';

   protected $table = 'mcid_transferencia_especiais_novo.tab_planos_acoes';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;

   public function secretaria()
   {
      return $this->belongsTo(Secretaria::class);
   }

   public function situacaoAnalise()
   {
      return $this->belongsTo(SituacaoAnalise::class);
   }

   public function finalidadesMetas()
   {
      return $this->hasMany(FinalidadesMetasPlanoAcoes::class, 'cod_plano_acao', 'cod_plano_acao')->orderBy('txt_finalidade')->orderBy('txt_meta');
   }

   public function palavrasSecretarias()
   {
      return $this->hasMany(ViewPalavrasSecretarias::class, 'cod_plano_acao', 'cod_plano_acao');
   }
}