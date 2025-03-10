<?php

namespace App;

use App\StatusPermissao;
use App\TipoIndeferimento;
use App\User;

use Illuminate\Database\Eloquent\Model;

class ViewPermissoesUsuario extends Model
{
   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_sistema_se.view_permissoes_usuarios';

   
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
