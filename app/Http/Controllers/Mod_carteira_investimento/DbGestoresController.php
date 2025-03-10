<?php

namespace App\Http\Controllers\Mod_carteira_investimento;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DbGestoresController extends Controller
{
    public function downloadDbGestores()
    {
        // Calcula a data para o nome do arquivo
        $numeroRepresentanteDia = date('N');
        $quantidadeDiasAMenos = ($numeroRepresentanteDia != '1') ? 1 : 3;
        $date = date('d_m_Y', strtotime("-{$quantidadeDiasAMenos} day"));

        // URL base e prefixo do nome do arquivo
        $baseUrl = 'https://www.caixa.gov.br/Downloads/Orcamento-Geral-da-Uniao-Base-de-Dados/';
        $prefix = 'BD_Gestores_';
        $fileName = "{$prefix}{$date}.zip";
        $url = $baseUrl . $fileName;



        return response()->streamDownload(function () {
            echo file_get_contents('https://www.caixa.gov.br/Downloads/Orcamento-Geral-da-Uniao-Base-de-Dados/BD_Gestores_05_08_2024.zip');
        }, 'BD_Gestores.zip');
    }
}