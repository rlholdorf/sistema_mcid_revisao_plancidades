<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\MetasIndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\MetasObjetivosEstrategicos;
use App\Mod_plancidades\MonitoramentoIndicadores;
use App\Mod_plancidades\RegionalizacaoMetaObjEstr;
use App\Mod_plancidades\RlcMetasMonitoramentoIndicadores;
use App\Mod_plancidades\RlcMetasMonitoramentoIniciativas;
use App\Mod_plancidades\ViewMonitoramentoIndicadoresObjEstrategicos;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MonitoramentoMetaIndicadorController extends Controller
{
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
    public function store(Request $request, $monitoramentoIndicadorId)
    {
        $user = Auth()->user();

        DB::beginTransaction();
        $dados_monitoramento = new RlcMetasMonitoramentoIndicadores;

        $dados_monitoramento->monitoramento_indicador_id = $monitoramentoIndicadorId;
        $dados_monitoramento->meta_indicador_id = $request->meta_indicador_id;
        $dados_monitoramento->regionalizacao_meta_indicador_id = $request->regionalizacao_meta_indicador_id;
        $dados_monitoramento->vlr_apurado = str_replace(',','.',$request->vlr_apurado);
        $dados_monitoramento->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_monitoramento->save();

        $apuracaoMeta = ViewResumoApuracaoMetaIndicador::where('monitoramento_indicador_id', $monitoramentoIndicadorId)->first();
        if ($apuracaoMeta->qtd_metas <= $apuracaoMeta->qtd_metas_apuradas) {

            $monitoramento = MonitoramentoIndicadores::find($monitoramentoIndicadorId);

            $monitoramento->bln_meta_apurada = true;

            if ($apuracaoMeta->vlr_esperado >= $apuracaoMeta->vlr_apurado) {
                $monitoramento->bln_meta_atingida =  false;
                $monitoramento->bln_restricao = true;
            } else {
                $monitoramento->bln_meta_atingida = true;
            }

            // return $monitoramento;

            $apuracaoAtualizada = $monitoramento->update();
        }

        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Meta cadastrada com sucesso!");
            return redirect("/plancidades/monitoramento/processo/indicador_obj_estrategico/edit/" . $monitoramentoIndicadorId);
            return Redirect::route('plancidades.monitoramentos.objetivoEstrategico.editar', ['monitoramentoId']);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a meta.");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados_meta_monitoramento = RlcMetasMonitoramentoIndicadores::find($id);
        $dados_meta_monitoramento->load('monitoramentoIndicadores.periodoMonitoramento.periodicidade','metaIndicador', 'regionalizacaoMetaIndicador.regionalizacao');
        $metaIndicador = MetasObjetivosEstrategicos::find($dados_meta_monitoramento->meta_indicador_id);
        
        return view(
            'modulo_plancidades.objetivo_estrategico.dados_meta_monitoramento_indicador',
            compact(
                'dados_meta_monitoramento',
                'metaIndicador'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        //return $request;
        
        $where = [];

        if ($request->monitoramentoId) {
            $where[] = ['monitoramento_indicador_id', $request->monitoramentoId];
        }

        if ($request->regionalizacao_meta_indicador_id) {
            $where[] = ['regionalizacao_meta_indicador_id', $request->regionalizacao_meta_indicador_id];
        }

        if ($request->regionalizacaoMetaId) {
            $where[] = ['id', $request->regionalizacaoMetaId];
        }
        
        $dados_monitoramento = RlcMetasMonitoramentoIndicadores::where($where)->first();
        $dados_monitoramento->vlr_apurado = $request->vlr_apurado;

        $dados_salvos = $dados_monitoramento->update();

        
        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Meta atualizada com sucesso!");
            return Redirect::route('plancidades.monitoramentos.objetivoEstrategico.editar', ['monitoramentoId' => $dados_monitoramento->monitoramento_indicador_id]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar a meta.");
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
