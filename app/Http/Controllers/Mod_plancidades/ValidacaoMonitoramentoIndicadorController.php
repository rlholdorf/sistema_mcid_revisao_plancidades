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
use App\User;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\ViewApuracaoMetaIndicador;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicosMetas;
use App\Mod_plancidades\ViewMonitoramentoIndicadoresObjEstrategicos;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIndicadores;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class ValidacaoMonitoramentoIndicadorController extends Controller
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
    public function edit($monitoramento_indicador_id)
    {
        $monitoramentos = ViewValidacaoMonitoramentoIndicadores::where('monitoramento_indicador_id', $monitoramento_indicador_id)->first();

        $dados_monitoramento = ViewMonitoramentoIndicadoresObjEstrategicos::find($monitoramento_indicador_id);

        switch ($dados_monitoramento->unidade_medida_id){
            case 1:
                $dados_monitoramento->unidade_medida_simbolo = '(R$)';
                break;
            case 2:
                $dados_monitoramento->unidade_medida_simbolo = '(%)';
                break;
            case 3:
                $dados_monitoramento->unidade_medida_simbolo = '(ADI)';
                break;
            case 4:
                $dados_monitoramento->unidade_medida_simbolo = '(m²)';
                break;
            case 5:
                $dados_monitoramento->unidade_medida_simbolo = '(UN)';
                break;
            default:
                $dados_monitoramento->unidade_medida_simbolo = '';
        }

        $resumoApuracaoMeta = ViewResumoApuracaoMetaIndicador::where('monitoramento_indicador_id', $monitoramento_indicador_id)->first();

        $metaIndicador = MetasObjetivosEstrategicos::where('indicador_objetivo_estrategico_id', $dados_monitoramento->indicador_objetivo_estrategico_id)->first();

        $regionalizacaoMetas = RegionalizacaoMetaObjEstr::where('meta_objetivos_estrategicos_id', $metaIndicador->id)
            ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_indicadores','rlc_metas_monitoramento_indicadores.regionalizacao_meta_indicador_id','=','tab_regionalizacao_metas_objetivos_estrategicos.id')
            ->where('rlc_metas_monitoramento_indicadores.monitoramento_indicador_id',$monitoramento_indicador_id)
            ->orderBy('tab_regionalizacao_metas_objetivos_estrategicos.id')
            ->get();
        $regionalizacaoMetas->load('regionalizacao', 'metasIndicadores.indicador');

        $restricoes = RlcRestricaoMetaMonitoramentoIndic::where('monitoramento_indicador_id', $dados_monitoramento->monitoramento_indicador_id)->get();
        $restricoes->load('monitoramentoIndicador', 'restricaoAtingimentoMeta');

        $usuarioPreenchimento = User::where('id', $monitoramentos->user_id)->first();

        return view("modulo_plancidades.validacao_monitoramento.analisar_monitoramentos_indicador", 
                    compact('monitoramentos',
                    'dados_monitoramento', 
                    'resumoApuracaoMeta', 
                    'metaIndicador', 
                    'regionalizacaoMetas', 
                    'restricoes',
                    'usuarioPreenchimento'
                )
        );
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
        //return $monitoramento_indicador_id;
        //return $request;

        $user = Auth()->user();
            DB::beginTransaction();

        $monitoramentos = ViewValidacaoMonitoramentoIndicadores::where('monitoramento_indicador_id', $monitoramento_indicador_id)->first();

        $dados_validacao = new RlcSituacaoMonitoramentoIndicadores();
        
        if($request->situacao_monitoramento_id != null && $request->txt_observacao != null){
            $dados_validacao->monitoramento_indicador_id = $monitoramento_indicador_id;
            $dados_validacao->situacao_monitoramento_id = $request->situacao_monitoramento_id;
            $dados_validacao->user_id = $user->id;
            $dados_validacao->created_at = date('Y-m-d H:i:s');
            $dados_validacao->indicador_objetivo_estrategico_id = $monitoramentos->indicador_objetivo_estrategico_id;
            $dados_validacao->txt_observacao = $request->txt_observacao;
            
        
            $dados_salvos = $dados_validacao->save();
        }
        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Situação do monitoramento do Indicador atualizada com sucesso!");
            return Redirect::route("plancidades.monitoramentos.validacao.indicadores.listar");
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar a situação do monitoramento.");
            return back();
    }
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
