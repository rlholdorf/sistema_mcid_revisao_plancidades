<?php

namespace App\Mod_saci\mod_sistema;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
   protected $connection	= 'pgsql_corp';
   
   protected $table = 'opc_areas';

   protected $primaryKey = 'cod_area';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function secretaria()
    {
       return $this->belongsTo(Secretaria::class,'cod_secretaria','cod_secretaria'); //possui muitos
    }

}
