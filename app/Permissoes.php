<?php

namespace App;

use App\StatusPermissao;
use App\TipoIndeferimento;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_sistema_se.tab_permissoes';

   
    public function user()
    {
       return $this->belongsTo(User::class); //possui muitos
    }

    public function userAnalisado()
    {
       return $this->belongsTo(User::class,'usuario_id_analise'); //possui muitos
    }
    
    public function tipoIndeferimento()
    {
       return $this->belongsTo(TipoIndeferimento::class); //possui muitos
    }

    public function statusPermissao()
    {
       return $this->belongsTo(StatusPermissao::class); //possui muitos
    }
    
    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
