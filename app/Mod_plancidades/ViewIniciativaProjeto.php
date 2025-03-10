<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class ViewIniciativaProjeto extends Model
{
    use Notifiable;

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_plancidades_bck.view_iniciativas_projetos';
}
