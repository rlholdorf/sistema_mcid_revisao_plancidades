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
use App\Mod_plancidades\RevisaoIndicadores;
use App\Mod_plancidades\RlcMonitoramentoObjEspecificos;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoIndic;
use App\Mod_plancidades\RlcSituacaoRevisaoIndicadores;
use App\Mod_plancidades\ViewApuracaoMetaIndicador;
use App\Mod_plancidades\ViewMonitoramentoIndicadoresObjEstrategicos;
use App\Mod_plancidades\ViewIndicadoresIniciativasRevisao;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicosRevisao;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;

class RevisaoController extends Controller
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

        $indicadores = ViewIndicadoresObjetivosEstrategicosRevisao::where($where)->orderBy('txt_titulo_objetivo_estrategico_pei')->get();

        if(count($indicadores) > 0){
            return view("modulo_plancidades.revisao.objetivo_estrategico.listar_indicadores_revisao", compact('indicadores'));
        }else{
            flash()->erro("Erro", "Nenhum indicador encontrado...");
            return back();
        }
    }
    
    public function listarIniciativas(Request $request)
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

        $iniciativas = ViewIndicadoresIniciativasRevisao::where($where)->orderBy('iniciativa_id')->get();

        // return ($iniciativas);

        if(count($iniciativas)){
            return view("modulo_plancidades.revisao.iniciativa.listar_iniciativas_revisao", compact('iniciativas'));
        }else{
            flash()->erro("Erro", "Nenhuma iniciativa encontrada...");
            return back();
        }
    }

    public function listarProjetos(Request $request)
    {   
        
        //return ($request);

        $where = [];

        if($request->orgaoResponsavel){
            $where[] = ['orgao_pei_id', $request->orgaoResponsavel];
        }

        if($request->objetivoEstrategico){
            $where[] = ['objetivo_estrategico_pei_id', $request->objetivoEstrategico];
        }

        if ($request->bln_ppa){
            $where[] = ['bln_ppa', true];
        }
        
        //return ($where);

        $projetos = ViewProjetos::where($where)->orderBy('projeto_id')->get();

        //return ($projetos);

        if(count($projetos) > 0){
            return view("modulo_plancidades.revisao.projeto.listar_projetos_revisao", compact('projetos'));
        }else{
            flash()->erro("Erro", "Nenhum projeto encontrado...");
            return back();
        }
    }

}