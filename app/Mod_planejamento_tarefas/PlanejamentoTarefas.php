<?php

namespace App\Mod_planejamento_tarefas;

use App\Secretaria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class PlanejamentoTarefas extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_planejamento_tarefas.tab_planejamento_tarefas';


   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'txt_nome_planejamento',
      'dsc_planejamento_tarefa',
      'secretaria_id',
      'bln_ativo',
      'user_id',
   ];

   public function secretaria()
   {
      return $this->belongsTo(Secretaria::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class); //possui muitos
   }
}