<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class SituacaoArquivo extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'pac.opc_situacao_arquivo';

   protected $primaryKey = 'cod_situacao_arquivo';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function arquivoSelecaoSecretarias()
   {
      return $this->hasMany(ArquivoSelecaoSecretaria::class, 'cod_situacao_arquivo', 'cod_situacao_arquivo'); //possui muitos
   }
}
