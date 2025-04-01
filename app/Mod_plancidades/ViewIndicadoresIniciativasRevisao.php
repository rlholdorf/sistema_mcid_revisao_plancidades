<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class ViewIndicadoresIniciativasRevisao extends Model
{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_hom_plancidades.view_indicadores_iniciativas_revisao';
}
