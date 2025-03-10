<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class ModalidadePAC extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_modalidades';

    protected $primaryKey = 'cod_modalidade';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


    public static function getSubmodalidade()
    {
        return ModalidadePAC::selectRaw('cod_modalidade_pai as cod_submodalidade, dsc_modalidade as dsc_submodalidade, cod_modalidade, cod_area')
            ->whereNotNull('cod_modalidade_pai')
            ->groupBy('cod_modalidade_pai', 'dsc_modalidade', 'cod_modalidade', 'cod_area')
            ->orderBy('dsc_modalidade')
            ->get();
    }

    public static function getSubmodalidadeModalidade($modalidade, $area)
    {

        $where = [];

        $where[] = ['cod_modalidade_pai', $modalidade];
        $where[] = ['cod_area', $area];

        return ModalidadePAC::selectRaw('cod_modalidade as cod_submodalidade, dsc_modalidade as dsc_submodalidade, cod_modalidade_pai as cod_modalidade, cod_area')
            ->where($where)
            ->groupBy('cod_modalidade_pai', 'dsc_modalidade', 'cod_modalidade', 'cod_area')
            ->orderBy('dsc_modalidade')
            ->get();
    }
}
