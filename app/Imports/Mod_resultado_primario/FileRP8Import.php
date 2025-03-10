<?php

namespace App\Imports\Mod_resultado_primario;

use App\Mod_resultado_primario\EmendasComissoes;
use Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileRP8Import implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {

        $usuarioLogado = getUsuarioLogado();
        return new EmendasComissoes([
            'num_emenda' => $row['num_emenda'],
            'txt_beneficiario' => $row['txt_beneficiario'],
            'txt_cnpj' => str_pad(str_replace('/', '', str_replace('.', '', str_replace('-', '', $row['txt_cnpj']))), 14, "0", STR_PAD_LEFT),
            'txt_uf' => $row['txt_uf'],
            'cod_modalidade' => $row['cod_modalidade'],
            'txt_funcional_programatica' => $row['txt_funcional_programatica'],
            'txt_acao' => $row['txt_acao'],
            'nun_gnd' => $row['nun_gnd'],
            'vlr_emenda' => $row['vlr_emenda'],
            'txt_status' => $row['txt_status'],
            'user_id' => $usuarioLogado->id,

        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}