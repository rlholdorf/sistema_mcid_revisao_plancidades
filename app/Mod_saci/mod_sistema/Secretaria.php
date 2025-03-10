<?php

namespace App\Mod_saci\mod_sistema;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'sistema.opc_secretarias';

   protected $primaryKey = 'cod_secretaria';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function areas()
   {
      return $this->hasMany(Area::class, 'cod_secretaria', 'cod_secretaria'); //possui muitos
   }

   public function contratoPac()
   {
      return $this->belongsTo(ContratosPac::class, 'cod_secretaria', 'cod_secretaria'); //possui muitos
   }

   public function arquivoSelecaoSecretarias()
   {
      return $this->belongsTo(ArquivoSelecaoSecretaria::class, 'cod_secretaria', 'cod_secretaria'); //possui muitos
   }
}
