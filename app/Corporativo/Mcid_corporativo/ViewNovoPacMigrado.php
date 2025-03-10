<?php

namespace App\Corporativo\Mcid_corporativo;

use Illuminate\Database\Eloquent\Model;

class ViewNovoPacMigrado extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_corporativo.view_novopac_migrado';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}