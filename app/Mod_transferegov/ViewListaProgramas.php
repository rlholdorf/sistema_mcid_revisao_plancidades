<?php

namespace App\Mod_transferegov;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewListaProgramas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_paineis.view_lista_programas_2024';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
