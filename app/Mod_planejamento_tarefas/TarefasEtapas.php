<?php

namespace App\Mod_planejamento_tarefas;

use App\Secretaria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class TarefasEtapas extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_planejamento_tarefas.tab_tarefas_etapas';

   protected $guarded = [];

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'txt_tarefa_etapa',
      'etapa_planejamento_id',
      'progresso_id',
      'prioridade_id',
      'dte_inicio_tarefa',
      'dte_conclusao_tarefa',
      'periorizacao_id',
      'dsc_anotacoes',
      'user_id'
   ];

   public function secretaria()
   {
      return $this->belongsTo(Secretaria::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class); //possui muitos
   }

   public function etapaPlanejamento()
   {
      return $this->belongsTo(EtapasPlanejamentos::class); //possui muitos
   }
}