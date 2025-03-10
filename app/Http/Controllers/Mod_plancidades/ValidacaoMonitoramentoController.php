<?php

namespace App\Http\Controllers\Mod_plancidades;

use App\Mod_plancidades\MetasIndicadoresObjetivosEstrategicos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\MetasObjetivosEstrategicos;
use App\Mod_plancidades\MonitoramentoIndicadores;
use App\Mod_plancidades\MonitoramentoIndicadoresObjEspecificos;
use App\Mod_plancidades\RegionalizacaoMetaObjEstr;
use App\Mod_plancidades\RlcMetasMonitoramentoIndicadores;
use App\Mod_plancidades\RlcMonitoramentoObjEspecificos;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoIndic;
use App\Mod_plancidades\RlcSituacaoMonitoramentoIndicadores;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\ViewApuracaoMetaIndicador;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicosMetas;
use App\Mod_plancidades\ViewMonitoramentoIndicadoresObjEstrategicos;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIndicadores;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIniciativas;
use App\Mod_plancidades\ViewValidacaoMonitoramentoProjetos;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class ValidacaoMonitoramentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('redirecionar'); 


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($indicadorId)
    {
      }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($indicadorId)
    {
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $monitoramento_indicador_id)
    {
        return $monitoramento_indicador_id;
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
    

    public function iniciarConsulta()
    {
        return view("modulo_plancidades.validacao_monitoramento.iniciar_consulta_validacao_monitoramento");
    }


    //Indicadores
    public function listarMonitoramentosPendentesIndicadores()
    {
        $monitoramentos = ViewValidacaoMonitoramentoIndicadores::where('situacao_monitoramento_id', '3')->get();
        return view("modulo_plancidades.validacao_monitoramento.listar_validacao_monitoramentos_indicador", compact('monitoramentos'));
    }

    public function listarMonitoramentosIndicadores()
    {

        $monitoramentos = ViewValidacaoMonitoramentoIndicadores::get();
        return view("modulo_plancidades.validacao_monitoramento.listar_validacao_monitoramentos_indicador", compact('monitoramentos'));
    }
    //---



    //Iniciativas
    public function listarMonitoramentosPendentesIniciativas()
    {
        $monitoramentos = ViewValidacaoMonitoramentoIniciativas::where('situacao_monitoramento_id', '3')->get();
        return view("modulo_plancidades.validacao_monitoramento.listar_validacao_monitoramentos_iniciativa", compact('monitoramentos'));
    }

    public function listarMonitoramentosIniciativas()
    {
        $monitoramentos = ViewValidacaoMonitoramentoIniciativas::get();
        return view("modulo_plancidades.validacao_monitoramento.listar_validacao_monitoramentos_iniciativa", compact('monitoramentos'));
    }

    //---
    

    //Projetos
    public function listarMonitoramentosPendentesProjetos()
    {
        $monitoramentos = ViewValidacaoMonitoramentoProjetos::where('situacao_monitoramento_id', '3')->get();
        return view("modulo_plancidades.validacao_monitoramento.listar_validacao_monitoramentos_projeto", compact('monitoramentos'));
    }

    public function listarMonitoramentosProjetos()
    {
        $monitoramentos = ViewValidacaoMonitoramentoProjetos::get();
        return view("modulo_plancidades.validacao_monitoramento.listar_validacao_monitoramentos_projeto", compact('monitoramentos'));
    }

    //---

}
