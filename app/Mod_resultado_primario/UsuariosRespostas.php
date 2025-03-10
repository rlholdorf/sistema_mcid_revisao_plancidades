<?php

namespace App\Mod_resultado_primario;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UsuariosRespostas extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.tab_users_respostas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function user()
   {
      return $this->belongsTo(User::class, 'user_id'); //possui muitos
   }
}
