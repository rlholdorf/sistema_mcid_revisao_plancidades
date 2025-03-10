<?php

namespace App\Mod_transferegov;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewProgramasCidades extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_paineis.view_programas_cidades';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;

   public function secretaria(): BelongsTo{
      return $this->belongsTo(Secretarias::class, 'id_secretaria', 'id');
   }
}
