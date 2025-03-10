<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Mod_plancidades\IndicadoresIniciativa;
use App\Mod_plancidades\MetasIniciativas;
use App\Mod_plancidades\MonitoramentoIndicadoresIniciativas;
use App\Mod_plancidades\MonitoramentoIniciativas;
use App\Mod_plancidades\RegionalizacaoMetaIniciativa;
use App\Mod_plancidades\RlcMetasMonitoramentoIniciativas;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoInic;
use App\Mod_plancidades\RlcSituacaoMonitoramentoIniciativas;
use App\Mod_plancidades\ViewApuracaoMetaIniciativa;
use App\Mod_plancidades\ViewIndicadoresIniciativa;
use App\Mod_plancidades\ViewMonitoramentoIniciativas;
use App\Mod_plancidades\ViewResumoApuracaoMetaIniciativa;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIniciativas;

use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class ValidacaoMonitoramentoIniciativaController extends Controller
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
    public function edit($monitoramento_iniciativa_id)
    {
        $monitoramentos = ViewValidacaoMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $monitoramento_iniciativa_id)->first();
        
        $dados_monitoramento = ViewMonitoramentoIniciativas::find($monitoramento_iniciativa_id);

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

        $resumoApuracaoMeta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $monitoramento_iniciativa_id)->first();

        $metaIniciativa = MetasIniciativas::where('iniciativa_id', $dados_monitoramento->iniciativa_id)->first();

        
        $regionalizacaoMetas = RegionalizacaoMetaIniciativa::where('tab_regionalizacao_metas_iniciativas.meta_iniciativa_id', $metaIniciativa->id)
            ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_iniciativas','rlc_metas_monitoramento_iniciativas.regionalizacao_meta_iniciativa_id','=','tab_regionalizacao_metas_iniciativas.id')
            ->where('rlc_metas_monitoramento_iniciativas.monitoramento_iniciativa_id',$monitoramento_iniciativa_id)
            ->orderBy('tab_regionalizacao_metas_iniciativas.id')
            ->get();
        $regionalizacaoMetas->load('regionalizacao', 'metasIniciativas.iniciativa');


        $restricoes = RlcRestricaoMetaMonitoramentoInic::where('monitoramento_iniciativa_id', $dados_monitoramento->monitoramento_iniciativa_id)->get();
        $restricoes->load('monitoramentoIniciativa', 'restricaoAtingimentoMeta');

        $usuarioPreenchimento = User::where('id', $monitoramentos->user_id)->first();

        return view(
            'modulo_plancidades.validacao_monitoramento.analisar_monitoramentos_iniciativa',
            compact('monitoramentos',
                    'dados_monitoramento', 
                    'resumoApuracaoMeta', 
                    'metaIniciativa', 
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
    public function update(Request $request, $monitoramento_iniciativa_id)
    {
        //return $monitoramento_iniciativa_id;
        //return $request;

        $user = Auth()->user();
            DB::beginTransaction();

        $monitoramentos = ViewValidacaoMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $monitoramento_iniciativa_id)->first();

        $dados_validacao = new RlcSituacaoMonitoramentoIniciativas();
        
        if($request->situacao_monitoramento_id != null && $request->txt_observacao != null){
            $dados_validacao->monitoramento_iniciativa_id = $monitoramento_iniciativa_id;
            $dados_validacao->situacao_monitoramento_id = $request->situacao_monitoramento_id;
            $dados_validacao->user_id = $user->id;
            $dados_validacao->created_at = date('Y-m-d H:i:s');
            $dados_validacao->iniciativa_id = $monitoramentos->iniciativa_id;
            $dados_validacao->txt_observacao = $request->txt_observacao;
            
        
            $dados_salvos = $dados_validacao->save();
        }
        if ($dados_salvos) {
            
            DB::commit();
            flash()->sucesso("Sucesso", "Situação do monitoramento do Indicador atualizada com sucesso!");
            return Redirect::route("plancidades.monitoramentos.validacao.iniciativas.listar");
            /**Quando só tem um na lista, ao resolver, ele não está mostrando esse flash. Tentei um if contando se não tem nada e não funcionou */

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
