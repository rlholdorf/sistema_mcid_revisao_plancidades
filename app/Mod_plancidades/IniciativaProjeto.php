<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class IniciativaProjeto extends Model
{
    use Notifiable;

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_plancidades_bck.tab_iniciativas_projetos';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'txt_denominacao_iniciativa',
        'objetivo_id',
        'bln_pac',
        'bln_min_ppa',
        'dsc_iniciativa_projeto',
        'unidade_responsavel_id',
        'txt_obervacao',
        'txt_objetivo',
        'txt_justificativa',
        'txt_gerente',
        'vlr_custo',
        'user_id',

    ];

    public $timestamps = true;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
