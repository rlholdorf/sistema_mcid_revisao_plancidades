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
use App\Mod_plancidades\RlcMonitoramentoObjEspecificos;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoIndic;
use App\Mod_plancidades\ViewApuracaoMetaIndicador;
use App\Mod_plancidades\ViewMonitoramentoIndicadoresObjEstrategicos;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicos;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;

class IndicadorObjEstrController extends Controller
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
    public function index()
    {
        //
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

    public function listarIndicadores(Request $request)
    {
    
        $where = [];

        if ($request->orgaoResponsavel){
            $where[] = ['orgao_pei_id', $request->orgaoResponsavel];
        }

        if ($request->objetivoEstrategico){
            $where[] = ['objetivo_estrategico_pei_id', $request->objetivoEstrategico];
        }

        if ($request->bln_ppa){
            $where[] = ['bln_ppa', true];
        }

       // return $where;

        // $indicadores = IndicadoresObjetivosEstrategicos::join('mcid_plancidades.opc_unidades_responsaveis', 'opc_unidades_responsaveis.id', '=', 'unidade_responsavel_id')
        //     ->join('mcid_plancidades.opc_orgao_pei', 'opc_orgao_pei.id','=','opc_unidades_responsaveis.orgao_pei_id')
        //     ->join('mcid_plancidades.opc_objetivos_estrategicos_pei', 'opc_objetivos_estrategicos_pei.id', '=', 'objetivo_estrategico_pei_id')
        //     ->select('tab_indicadores_objetivos_estrategicos.*', 'opc_unidades_responsaveis.id as unidade_responsavel_id','opc_unidades_responsaveis.txt_unidade_responsavel','opc_orgao_pei.id as orgao_pei_id', 'opc_orgao_pei.txt_sigla_orgao', 'opc_objetivos_estrategicos_pei.id as objetivos_estrategicos_pei_id', 'opc_objetivos_estrategicos_pei.txt_titulo_objetivo_estrategico_pei')
        //     ->where($where)->orderBy('txt_titulo_objetivo_estrategico_pei')->get();

        $indicadores = ViewIndicadoresObjetivosEstrategicos::where($where)->orderBy('txt_titulo_objetivo_estrategico_pei')->get();

        // return ($indicadores);

        if(count($indicadores) > 0){
            return view("modulo_plancidades.objetivo_estrategico.listar_indicadores", compact('indicadores'));
        }else{
            flash()->erro("Erro", "Nenhum indicador encontrado...");
            return back();
        }
    }
}
