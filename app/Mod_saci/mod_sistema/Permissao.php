<?php

namespace App\Mod_saci\mod_sistema;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
   protected $connection	= 'pgsql_corp';
   
   protected $table = 'sistema.tab_permissoes';

   protected $primaryKey = 'cod_permissao';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    protected $fillable = [
        'cod_permissao',
        'cod_usuario',
        'cod_contrato_pac',
        'bln_altera',
        'bln_inclui',
        'bln_exclui',
        'cod_tipo_transferencia'
        ];
  
        public function usuario()
        {
           return $this->belongsTo(Usuario::class,'cod_usuario','cod_usuario'); //possui muitos
        }

}
