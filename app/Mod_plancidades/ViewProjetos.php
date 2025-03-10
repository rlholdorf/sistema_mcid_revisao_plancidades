<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class ViewProjetos extends Model
{
    use Notifiable;

    protected $connection = 'pgsql_corp';

    protected $table = 'mcid_plancidades.view_projetos';
}
