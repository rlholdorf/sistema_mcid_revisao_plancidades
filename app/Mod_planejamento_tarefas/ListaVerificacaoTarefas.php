<?php

namespace App\Mod_planejamento_tarefas;

use App\Secretaria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ListaVerificacaoTarefas extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_planejamento_tarefas.rlc_lista_verificacao_tarefas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'lista_verificacao_id',
      'num_fase',
      'responsavel_id',
      'dte_inicio_verificacao',
      'dte_fim_verificacao',
      'num_ordem_verificacao',
      'bln_verificado',
      'user_id',
      'tarefa_etapa_id'
   ];

   public function listaVerificacao()
   {
      return $this->belongsTo(ListaVerificacao::class);
   }

   public function responsavel()
   {
      return $this->belongsTo(Responsavel::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class); //possui muitos
   }

   public function tarefaEtapa()
   {
      return $this->belongsTo(TarefasEtapas::class); //possui muitos
   }
}