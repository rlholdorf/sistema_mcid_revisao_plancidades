<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\MetasIniciativas;
use App\Mod_plancidades\MonitoramentoIniciativas;
use App\Mod_plancidades\RestricoesAtingimentoMetas;
use App\Mod_plancidades\RlcMetasMonitoramentoIniciativas;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoInic;
use App\Mod_plancidades\ViewApuracaoMetaIniciativa;
use App\Mod_plancidades\ViewMonitoramentoIniciativas;
use App\Mod_plancidades\ViewResumoApuracaoMetaIniciativa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MonitoramentoMetaIniciativaController extends Controller
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
    public function store(Request $request, $monitoramentoIniciativaId)
    {
        //
        //return $request->all();
        $dados_monitoramento = ViewMonitoramentoIniciativas::find($monitoramentoIniciativaId);
        $user = Auth()->user();



        DB::beginTransaction();

        $dados_monitoramento = new RlcMetasMonitoramentoIniciativas;

        $dados_monitoramento->monitoramento_iniciativa_id = $monitoramentoIniciativaId;
        $dados_monitoramento->meta_iniciativa_id = $request->meta_iniciativa_id;
        $dados_monitoramento->regionalizacao_meta_iniciativa_id = $request->regionalizacao_meta_iniciativa_id;
        $dados_monitoramento->vlr_apurado = $request->vlr_apurado;
        $dados_monitoramento->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_monitoramento->save();



        $apuracaoMeta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $monitoramentoIniciativaId)->first();


        if ($apuracaoMeta->qtd_metas == $apuracaoMeta->qtd_metas_apuradas) {

            $monitoramento = MonitoramentoIniciativas::find($monitoramentoIniciativaId);

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
            return redirect("/plancidades/monitoramento/processo/iniciativa_processos/edit/" . $monitoramentoIniciativaId);
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
    public function show($regionalizacaoMonitoramentoId)
    {
        //
        $dados_meta_monitoramento = RlcMetasMonitoramentoIniciativas::find($regionalizacaoMonitoramentoId);
        $dados_meta_monitoramento->load('monitoramentoIniciativa.periodoMonitoramento.periodicidade', 'metaIniciativa', 'regionalizacaoMetaIniciativa.regionalizacao');
        $metaIniciativa = MetasIniciativas::find($dados_meta_monitoramento->meta_iniciativa_id);

        return view('modulo_plancidades.iniciativa.dados_meta_monitoramento_iniciativa', compact('dados_meta_monitoramento','metaIniciativa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        DB::beginTransaction();

        $dados_monitoramento = RlcMetasMonitoramentoIniciativas::find($id);
        $dados_monitoramento->vlr_apurado = $request->vlr_apurado;
        
        $dados_salvos = $dados_monitoramento->update();

        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Meta atualizada com sucesso!");
            return Redirect::route("plancidades.monitoramentos.iniciativa.editar", ['monitoramentoId'=> $dados_monitoramento->monitoramento_iniciativa_id]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar a meta.");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return $request;
        
        DB::beginTransaction();

        $where = [];

        if ($request->monitoramentoId) {
            $where[] = ['monitoramento_iniciativa_id', $request->monitoramentoId];
        }

        if ($request->regionalizacao_meta_iniciativa_id) {
            $where[] = ['regionalizacao_meta_iniciativa_id', $request->regionalizacao_meta_iniciativa_id];
        }

        if ($request->regionalizacaoMetaId) {
            $where[] = ['id', $request->regionalizacaoMetaId];
        }

        $dados_monitoramento = RlcMetasMonitoramentoIniciativas::where($where)->first();
        $dados_monitoramento->vlr_apurado = $request->vlr_apurado;

        $dados_salvos = $dados_monitoramento->update();

        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Meta atualizada com sucesso!");
            return Redirect::route("plancidades.monitoramentos.iniciativa.editar", ['monitoramentoId'=> $dados_monitoramento->monitoramento_iniciativa_id]);
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