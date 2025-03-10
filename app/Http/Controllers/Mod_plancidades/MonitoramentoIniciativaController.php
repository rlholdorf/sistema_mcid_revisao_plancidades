<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresIniciativa;
use App\Mod_plancidades\MetasIniciativas;
use App\Mod_plancidades\MonitoramentoIndicadoresIniciativas;
use App\Mod_plancidades\MonitoramentoIniciativas;
use App\Mod_plancidades\RegionalizacaoMetaIniciativa;
use App\Mod_plancidades\RlcMetasMonitoramentoIniciativas;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoInic;
use App\Mod_plancidades\RlcSituacaoMonitoramentoIniciativas;
use App\Mod_plancidades\ViewApuracaoMetaIniciativa;
use App\Mod_plancidades\ViewIndicadoresIniciativas;
use App\Mod_plancidades\ViewMonitoramentoIniciativas;
use App\Mod_plancidades\ViewResumoApuracaoMetaIniciativa;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIniciativas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class MonitoramentoIniciativaController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        return view('modulo_plancidades.cadastrar_monitoramento_iniciativa_processo');
    }


    public function store(Request $request)
    {
        $user = Auth()->user();

        DB::beginTransaction();
        $where = [];
        $where[] = ['iniciativa_id', $request->iniciativa];
        $where[] = ['num_ano_periodo_monitoramento', $request->anoMonitoramento];
        $where[] = ['periodo_monitoramento_id', $request->periodoMonitoramento];


        $monitoramentoCadastrado = MonitoramentoIniciativas::where($where)->first();

        if (!empty($monitoramentoCadastrado)) {
            DB::rollBack();
            flash()->erro("Erro", "Já existe um monitoramento para esse período.");
            return back();
        }

        $dados_monitoramento = new MonitoramentoIniciativas;

        $dados_monitoramento->user_id = $user->id;
        $dados_monitoramento->iniciativa_id = $request->iniciativa;
        $dados_monitoramento->dsc_analise_indicador = $request->dsc_analise_indicador;
        $dados_monitoramento->periodo_monitoramento_id = $request->periodoMonitoramento;
        $dados_monitoramento->num_ano_periodo_monitoramento = $request->anoMonitoramento;

        $dados_monitoramento->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_monitoramento->save();

        $metaIniciativa = MetasIniciativas::where('iniciativa_id', $dados_monitoramento->iniciativa_id)->first();

        if ($metaIniciativa->bln_meta_regionalizada && $dados_salvos) {
            $regionalizacoes = RegionalizacaoMetaIniciativa::where('meta_iniciativa_id', $metaIniciativa->id)->get();

            foreach ($regionalizacoes as $regionalizacao) {
                $rlc_metas_monitoramento = new RlcMetasMonitoramentoIniciativas();

                $rlc_metas_monitoramento->monitoramento_iniciativa_id = $dados_monitoramento->id;
                $rlc_metas_monitoramento->meta_iniciativa_id = $metaIniciativa->id;
                $rlc_metas_monitoramento->regionalizacao_meta_iniciativa_id = $regionalizacao->id;
                $rlc_metas_monitoramento->vlr_apurado = null;
                $rlc_metas_monitoramento->created_at = date('Y-m-d H:i:s');
                $rlc_metas_monitoramento->save();
            }
        }

        $situacao_monitoramento = new RlcSituacaoMonitoramentoIniciativas();
        $situacao_monitoramento->monitoramento_iniciativa_id = $dados_monitoramento->id;
        $situacao_monitoramento->situacao_monitoramento_id = '2';
        $situacao_monitoramento->user_id = $user->id;
        $situacao_monitoramento->created_at = date('Y-m-d H:i:s');
        $situacao_monitoramento->iniciativa_id = $request->iniciativa;
        $situacao_monitoramento->save();

        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Monitoramento cadastrado com sucesso!");
            return Redirect::route("plancidades.monitoramentos.iniciativa.editar", ["monitoramentoId" => $dados_monitoramento->id]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar o monitoramento.");
            return back();
        }
    }

    public function show($id)
    {
        $dados_monitoramento = ViewMonitoramentoIniciativas::find($id);

        switch ($dados_monitoramento->unidade_medida_id) {
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

        $resumoApuracaoMeta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $id)->first();

        $metaIniciativa = MetasIniciativas::where('iniciativa_id', $dados_monitoramento->iniciativa_id)->first();


        $regionalizacaoMetas = RegionalizacaoMetaIniciativa::where('tab_regionalizacao_metas_iniciativas.meta_iniciativa_id', $metaIniciativa->id)
            ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_iniciativas', 'rlc_metas_monitoramento_iniciativas.regionalizacao_meta_iniciativa_id', '=', 'tab_regionalizacao_metas_iniciativas.id')
            ->where('rlc_metas_monitoramento_iniciativas.monitoramento_iniciativa_id', $id)
            ->orderBy('tab_regionalizacao_metas_iniciativas.id')
            ->get();
        $regionalizacaoMetas->load('regionalizacao', 'metasIniciativas.iniciativa');


        $restricoes = RlcRestricaoMetaMonitoramentoInic::where('monitoramento_iniciativa_id', $dados_monitoramento->monitoramento_iniciativa_id)->get();
        $restricoes->load('monitoramentoIniciativa', 'restricaoAtingimentoMeta');

        $situacao_monitoramento = ViewValidacaoMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $id)->first();

        return view(
            'modulo_plancidades.iniciativa.show_monitoramento_iniciativa',
            compact(
                'dados_monitoramento',
                'restricoes',
                'metaIniciativa',
                'regionalizacaoMetas',
                'resumoApuracaoMeta',
                'situacao_monitoramento'
            )
        );
    }

    public function edit($id)
    {
        $situacao_monitoramento = ViewValidacaoMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $id)->first();

        if ($situacao_monitoramento && ($situacao_monitoramento->situacao_monitoramento_id == 3 || $situacao_monitoramento->situacao_monitoramento_id == 5 || $situacao_monitoramento->situacao_monitoramento_id == 6)) {

            flash()->erro("Erro", "Não foi possível atualizar o monitoramento.");
            return Redirect::route("plancidades.monitoramentos.iniciativa.listarMonitoramentos", ['monitoramentoId' => $situacao_monitoramento->iniciativa_id]);
        } else {

            $dados_monitoramento = ViewMonitoramentoIniciativas::find($id);

            switch ($dados_monitoramento->unidade_medida_id) {
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

            $resumoApuracaoMeta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $id)->first();

            $metaIniciativa = MetasIniciativas::where('iniciativa_id', $dados_monitoramento->iniciativa_id)->first();


            $regionalizacaoMetas = RegionalizacaoMetaIniciativa::where('tab_regionalizacao_metas_iniciativas.meta_iniciativa_id', $metaIniciativa->id)
                ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_iniciativas', 'rlc_metas_monitoramento_iniciativas.regionalizacao_meta_iniciativa_id', '=', 'tab_regionalizacao_metas_iniciativas.id')
                ->where('rlc_metas_monitoramento_iniciativas.monitoramento_iniciativa_id', $id)
                ->orderBy('tab_regionalizacao_metas_iniciativas.id')
                ->get();
            $regionalizacaoMetas->load('regionalizacao', 'metasIniciativas.iniciativa');


            $restricoes = RlcRestricaoMetaMonitoramentoInic::where('monitoramento_iniciativa_id', $dados_monitoramento->monitoramento_iniciativa_id)->get();
            $restricoes->load('monitoramentoIniciativa', 'restricaoAtingimentoMeta');

            if ($dados_monitoramento->bln_restricao && count($restricoes) == 0) {
                flash()->warning("Meta não atingida", "Favor cadastrar o motivo do não atingimento da meta!");
            }

            return view(
                'modulo_plancidades.iniciativa.editar_monitoramento_iniciativa',
                compact(
                    'dados_monitoramento',
                    'restricoes',
                    'metaIniciativa',
                    'regionalizacaoMetas',
                    'resumoApuracaoMeta',
                    'situacao_monitoramento'
                )
            );
        }
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
        $user = Auth()->user();
        DB::beginTransaction();
        //return $request;

        $dados_monitoramento =  MonitoramentoIniciativas::find($id);


        $dados_monitoramento->vlr_apurado_global = $request->vlr_apurado_global;

        $dados_monitoramento->dsc_analise_indicador = $request->dsc_analise_indicador;

        $dados_meta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $dados_monitoramento->id)->first();

        $checagem = ViewMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $id)->first();


        switch ($checagem->polaridade_id) {
            case 1:
                if ($dados_monitoramento->vlr_apurado_global >= $dados_meta->vlr_esperado) {
                    $dados_monitoramento->bln_meta_atingida = true;
                } else {
                    $dados_monitoramento->bln_meta_atingida = false;
                }
                break;
            case 2:
                if ($dados_monitoramento->vlr_apurado_global <= $dados_meta->vlr_esperado) {
                    $dados_monitoramento->bln_meta_atingida = true;
                } else {
                    $dados_monitoramento->bln_meta_atingida = false;
                }
                break;
            case 3:
                if ($dados_monitoramento->vlr_apurado_global == $dados_meta->vlr_esperado) {
                    $dados_monitoramento->bln_meta_atingida = true;
                } else {
                    $dados_monitoramento->bln_meta_atingida = false;
                }
                break;
            default:
        }

        if ($dados_meta->bln_ppa && !$dados_monitoramento->bln_meta_atingida && $dados_monitoramento->vlr_apurado_global != null) {
            $dados_monitoramento->bln_restricao = true;
        } else {
            $dados_monitoramento->bln_restricao = false;
        }

        $restricoes = RlcRestricaoMetaMonitoramentoInic::where('monitoramento_iniciativa_id', $dados_monitoramento->id)->get();
        $restricoes->load('monitoramentoIniciativa', 'restricaoAtingimentoMeta');

        $regionalizacoesMonitoradas = RlcMetasMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $id)
            ->whereNotNull('rlc_metas_monitoramento_iniciativas.vlr_apurado')->get();

        if ((($dados_monitoramento->bln_restricao && count($restricoes) > 0) || !$dados_monitoramento->bln_restricao)
            && (!$dados_meta->bln_meta_regionalizada || count($regionalizacoesMonitoradas) >= $dados_meta->qtd_metas)
            && $dados_monitoramento->vlr_apurado_global != null
        ) {
            $dados_monitoramento->bln_meta_apurada = true;
        } else {
            $dados_monitoramento->bln_meta_apurada = false;
        }


        $dados_salvos = $dados_monitoramento->update();

        $checa_situacao_monitoramento = RlcSituacaoMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $dados_monitoramento->id)->orderBy('created_at', 'desc')->first();



        if ($dados_salvos) {

            if ($request->botao_salvar) {
                if (!$checa_situacao_monitoramento || $checa_situacao_monitoramento->situacao_monitoramento_id <> '2') {
                    $situacao_monitoramento_iniciativas = new RlcSituacaoMonitoramentoIniciativas();
                    $situacao_monitoramento_iniciativas->monitoramento_iniciativa_id = $id;
                    $situacao_monitoramento_iniciativas->situacao_monitoramento_id = '2';
                    $situacao_monitoramento_iniciativas->user_id = $user->id;
                    $situacao_monitoramento_iniciativas->created_at = date('Y-m-d H:i:s');
                    $situacao_monitoramento_iniciativas->iniciativa_id = $dados_meta->iniciativa_id;
                    $situacao_monitoramento_iniciativas->save();
                }
                DB::commit();
                flash()->sucesso("Sucesso", "Monitoramento atualizado com sucesso!");
                return Redirect::route("plancidades.monitoramentos.iniciativa.editar", ['monitoramentoId' => $dados_monitoramento->id]);
            } else {
                if ($request->botao_finalizar) {
                    $situacao_monitoramento_iniciativas = new RlcSituacaoMonitoramentoIniciativas();
                    $situacao_monitoramento_iniciativas->monitoramento_iniciativa_id = $id;
                    $situacao_monitoramento_iniciativas->situacao_monitoramento_id = '3';
                    $situacao_monitoramento_iniciativas->user_id = $user->id;
                    $situacao_monitoramento_iniciativas->created_at = date('Y-m-d H:i:s');
                    $situacao_monitoramento_iniciativas->iniciativa_id = $dados_meta->iniciativa_id;
                    $situacao_monitoramento_iniciativas->save();
                    //LEMBRAR DE FAZER ESSA DISTINÇÃO DEPOIS, CONSIDERANDO TODOS OS CASOS
                    DB::commit();
                    flash()->sucesso("Sucesso", "Monitoramento da Iniciativa atualizado com sucesso!");
                    return Redirect::route("plancidades.monitoramentos.iniciativa.listarMonitoramentos", ['iniciativaId' => $dados_monitoramento->iniciativa_id]);
                }
            }
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar o monitoramento.");
            return back();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function criarMonitoramento($iniciativaId)
    {
        
        $dadosIniciativa = ViewIndicadoresIniciativas::find($iniciativaId);

        $situacoes = array('5', '6', null); // 5 - Validado; 6 - Validado e registrado no SIOP; NULL - Nenhum monitoramento registrado;

        if (!in_array($dadosIniciativa->situacao_monitoramento_id, $situacoes)){
            DB::rollBack();
            flash()->erro("Erro", "Já existe um monitoramento para esse período.");
            return back();
        }

        $dadosMeta = MetasIniciativas::where('iniciativa_id', $iniciativaId)->first();

        return view('modulo_plancidades.iniciativa.iniciar_monitoramento_iniciativa', compact('dadosIniciativa', 'dadosMeta'));
    }

    public function consultarMonitoramento()
    {
        return view("modulo_plancidades.iniciativa.consultar_monitoramento_iniciativa");
    }

    public function pesquisarIniciativa(Request $request)
    {
        $where = [];

        //return $request->all();

        if ($request->orgaoResponsavel) {
            $where[] = ['orgao_pei_id', $request->orgaoResponsavel];
        }

        if ($request->objetivoEstrategico) {
            $where[] = ['objetivo_estrategico_pei_id', $request->objetivoEstrategico];
        }

        if ($request->iniciativa) {
            $where[] = ['iniciativa_id', $request->iniciativa];
        }


        $monitoramentos = ViewMonitoramentoIniciativas::where($where)->orderBy('txt_enunciado_iniciativa')->paginate(2);


        if (count($monitoramentos) > 0) {
            return view("modulo_plancidades.iniciativa.listar_monitoramentos_iniciativa", compact('monitoramentos'));
            //return $monitoramentos;
        } else {
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }

    public function listarMonitoramentos($iniciativaId)
    {
        $monitoramentos = ViewMonitoramentoIniciativas::where('view_monitoramento_iniciativa.iniciativa_id', $iniciativaId)->orderBy('monitoramento_iniciativa_id', 'desc')
            ->leftJoin('mcid_plancidades.view_validacao_monitoramento_iniciativas', 'view_validacao_monitoramento_iniciativas.monitoramento_iniciativa_id', '=', 'view_monitoramento_iniciativa.monitoramento_iniciativa_id')
            ->select('view_monitoramento_iniciativa.*', 'view_validacao_monitoramento_iniciativas.situacao_monitoramento_id', 'view_validacao_monitoramento_iniciativas.txt_situacao_monitoramento')
            ->get();

        if (count($monitoramentos) > 0) {
            return view("modulo_plancidades.iniciativa.listar_monitoramentos_iniciativa", compact('monitoramentos'));
        } else {
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }
}