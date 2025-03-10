<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class ViewIndicadoresIniciativas extends Model
{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_plancidades.view_indicadores_iniciativas';
}
