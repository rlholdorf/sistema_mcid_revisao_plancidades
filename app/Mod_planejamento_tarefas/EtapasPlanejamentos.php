<?php

namespace App\Mod_planejamento_tarefas;

use App\Secretaria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class EtapasPlanejamentos extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_planejamento_tarefas.tab_etapas_planejamentos';


   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'txt_nome_etapa_planejamento',
      'bln_ativa',
      'planejamento_tarefa_id',
      'user_id',
   ];

   public function planejamentoTarefa()
   {
      return $this->belongsTo(PlanejamentoTarefas::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class); //possui muitos
   }
}