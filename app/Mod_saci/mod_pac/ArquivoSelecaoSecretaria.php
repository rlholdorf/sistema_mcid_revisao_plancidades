<?php

namespace App\Mod_saci\mod_pac;

use App\Mod_saci\mod_sistema\Secretaria;

use Illuminate\Database\Eloquent\Model;

class ArquivoSelecaoSecretaria extends Model
{
   protected $connection	= 'pgsql_corp';
   
   protected $table = 'tab_arquivos_selecao_secretaria';

   protected $primaryKey = 'cod_arquivos_selecao_secretaria';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function secretaria()
    {
       return $this->belongsTo(Secretaria::class,'cod_secretaria','cod_secretaria'); //possui muitos
    }

    public function situacaoArquivo()
    {
       return $this->belongsTo(SituacaoArquivo::class,'cod_situacao_arquivo','cod_situacao_arquivo'); //possui muitos
    }

}
