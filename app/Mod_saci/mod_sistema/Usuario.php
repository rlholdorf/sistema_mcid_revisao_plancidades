<?php

namespace App\Mod_saci\mod_sistema;

use App\Mod_saci\mod_pac\ContratosPac;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
   protected $connection	= 'pgsql_corp';
   
   protected $table = 'sistema.tab_usuarios';

   protected $primaryKey = 'cod_usuario';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function permissao()
    {
       return $this->belongsTo(Permissao::class,'cod_usuario','cod_usuario'); //possui muitos
    }

    public function contratosPacs()
    {
       return $this->hasMany(ContratosPac::class,'cod_usuario','cod_usuario'); //possui muitos
    }

}
