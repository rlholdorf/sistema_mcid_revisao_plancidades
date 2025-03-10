<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class RegistroContratosPacCadastrados extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.tab_registro_contratos_pac_cadastrados';

    protected $primaryKey = 'cod_registro_contratos_pac_cadastrados';

    protected $fillable = [
        'cod_contrato_pac',
        'bln_importado_por_arquivo',
        'created_at',
        'updated_at'
    ];



    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização



}
