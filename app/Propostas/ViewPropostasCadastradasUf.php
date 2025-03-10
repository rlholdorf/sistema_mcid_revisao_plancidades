<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewPropostasCadastradasUf extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_resumo_propostas_cadastradas_por_uf';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

 

}
