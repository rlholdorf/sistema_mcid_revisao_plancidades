<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DbGestoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}