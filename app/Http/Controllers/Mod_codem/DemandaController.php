<?php

namespace App\Http\Controllers\Mod_codem;

use Illuminate\Http\Request;



use App\Http\Controllers\Controller;
use App\Mail\Mod_codem\NovaDemanda;
use App\Mod_codem\Demanda;
use App\Mod_codem\Encaminhamento;
use App\Mod_codem\RelacaoDemandas;
use App\Mod_codem\ResponsabilidadeDemanda;
use App\Mod_codem\RlcDocumentoDemanda;
use App\Mod_codem\RlcSituacaoDemanda;
use App\Mod_codem\ViewDocumentoDemanda;
use App\Mod_codem\ViewEncaminhamentoDemanda;
use App\Mod_codem\ViewObservacoesDemanda;
use App\Mod_codem\ViewResumoDemandasDemandado;
use App\Mod_codem\ViewResumoDemandasDemandante;
use App\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DemandaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('redirecionar'); 


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastrarDemanda()
    {

        return view('modulo_codem.cadastrar_demanda');
    }

    public function salvarDemanda(Request $request)
    {

        //return $request->all();

        DB::beginTransaction();

        // return implode("-",array_reverse(explode("/",$request->dte_solicitacao)));
        $dte_previsao_conclusao =  adicionarDiasData(implode("-", array_reverse(explode("/", $request->dte_solicitacao))), $request->qtd_dias_conclusao);

        $demanda = new Demanda;
        $demanda->dte_solicitacao = implode("-", array_reverse(explode("/", $request->dte_solicitacao)));
        $demanda->tipo_demanda_id = $request->tipo_demanda;
        $demanda->tipo_atendimento_id = $request->tipo_atendimento;
        $demanda->subtema_id = $request->subTema;
        $demanda->prioridade_id = $request->prioridade;
        $demanda->qtd_dias_conclusao = $request->qtd_dias_conclusao;
        $demanda->bln_documento_sei = $request->bln_documento_sei;
        $demanda->dte_previsao_conclusao = $dte_previsao_conclusao;
        $demanda->dte_conclusao = $request->dte_conclusao;
        $demanda->txt_descricao_demanda = $request->txt_descricao_demanda;
        $demanda->dsc_resposta_demanda = $request->dsc_resposta_demanda;
        $demanda->situacao_id = 1;
        $demanda->setor_id = $request->setor;
        $demanda->user_id = Auth::user()->id;
        $demanda->user_id_demandado = $request->usuario;

        if ($request->tipo_demanda == 2) {
            $demanda->tipo_interessado_id = $request->tipoInteressado;
            $demanda->txt_nome_interessado = $request->txt_nome_interessado;
            $demanda->uf_id = $request->estado;
            $demanda->municipio_id = $request->municipio;
        }

        $demanda->created_at = date("Y-m-d h:i:s");

        $salvoSucesso = $demanda->save();

        $situacaoDemanda = new RlcSituacaoDemanda;
        $situacaoDemanda->demanda_id = $demanda->id;
        $situacaoDemanda->situacao_demanda_id = 1;
        $situacaoDemanda->dte_situacao = date("Y-m-d");
        $situacaoDemanda->user_id = Auth::user()->id;
        $salvoSituacao = $situacaoDemanda->save();



        if ($salvoSucesso && $salvoSituacao) {
            DB::commit();
            $usuario = Auth::user();
            Mail::to($usuario->email)->send(new NovaDemanda($demanda, $usuario));
            flash()->sucesso("Sucesso", "Demanda cadastrada com sucesso!");
            return redirect("/codem/demanda/minhas_demandas");
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a demanda.");
            return back();
        }
    }

    public function abrirDemanda($demandaID, $ativarAba)
    {


        // return $demandaID;

        $demandaVisualizada = Demanda::find($demandaID);

        if (!$demandaVisualizada->bln_visualizada) {
            $demandaVisualizada->bln_visualizada = true;
            $demandaVisualizada->dte_visualizacao = date("Y-m-d h:i:s");
            $demandaVisualizada->update();
        }

        $demanda = RelacaoDemandas::where('demanda_id', $demandaID)->firstOrFail();

        $documentosDemanda = ViewDocumentoDemanda::where('demanda_id', $demandaID)->get();

        $encaminhamentoDemanda = ViewEncaminhamentoDemanda::where('demanda_id', $demandaID)->orderBy('dte_encaminhamento', 'DESC')->get();

        $observacoesDemanda = ViewObservacoesDemanda::where('demanda_id', $demandaID)->get();





        return view('modulo_codem.dados_demanda', compact('demanda', 'ativarAba', 'documentosDemanda', 'encaminhamentoDemanda', 'observacoesDemanda'));
    }


    public function minhasDemandas()
    {


        $usuarioID = Auth::user()->id;

        $whereDemandado[] = ['user_id_demandado', $usuarioID];
        $whereDemandado[] = ['situacao_id', '!=', 7];

        $demandasUsuarioDemandado = RelacaoDemandas::where($whereDemandado)
            ->orderBy('dte_solicitacao', 'desc')
            ->get();


        $where[] = ['user_id', $usuarioID];
        $where[] = ['situacao_id', '!=', 7];

        $demandasUsuario = RelacaoDemandas::where($where)
            ->orderBy('dte_solicitacao', 'desc')
            ->get();





        $resumoDemandasUsuario = ViewResumoDemandasDemandante::where('user_id_demandante', $usuarioID)->first();





        $whereSetor[] = ['setor_id', Auth::user()->setor_id];
        $whereSetor[] = ['situacao_id', '!=', 7];
        $demandasSetorUsuario = RelacaoDemandas::where($whereSetor)
            ->orderBy('dte_solicitacao', 'desc')
            ->get();


        $whereEncaminhamento[] = ['usuario_id_demandado', $usuarioID];
        $whereEncaminhamento[] = ['bln_concluido', false];
        $encaminhamentoDemanda = ViewEncaminhamentoDemanda::where($whereEncaminhamento)->get();

        if (count($demandasUsuario) == 0 && count($encaminhamentoDemanda) == 0) {

            flash()->info("Informação", "Não existem demandas ou encaminhamentos para este usuário.");
            return back();
        }


        return view('modulo_codem.minhas_demandas', compact('demandasUsuario', 'encaminhamentoDemanda', 'demandasSetorUsuario', 'demandasUsuarioDemandado'));
    }

    public function atualizarDemanda(Request $request)
    {
        DB::beginTransaction();
        // $request->all();

        $demanda = Demanda::find($request->demanda_id);
        $demanda->situacao_id = $request->situacao;
        $demanda->bln_documento_sei = $request->bln_documento_sei;
        $demanda->setor_id = $request->setor;
        $demanda->txt_descricao_demanda = $request->txt_descricao_demanda;
        $demanda->dte_conclusao = $request->dte_conclusao;
        $demanda->dsc_resposta_demanda = $request->dsc_resposta_demanda;

        if ($request->tipo_demanda == 2) {
            $demanda->tipo_interessado_id = $request->tipoInteressado;
            $demanda->txt_nome_interessado = $request->txt_nome_interessado;
            $demanda->uf_id = $request->estado;
            $demanda->municipio_id = $request->municipio;
        }

        if ($request->usuario != $demanda->user_id_demandado) {
            $demanda->user_id_demandado = $request->usuario;
        }

        $salvoSucesso = $demanda->update();



        if ($salvoSucesso) {
            if ($request->situacao != $demanda->situacao_id) {
                $situacaoDemanda = new RlcSituacaoDemanda;
                $situacaoDemanda->demanda_id = $demanda->id;
                $situacaoDemanda->situacao_demanda_id = $request->situacao;
                $situacaoDemanda->dte_situacao = date("Y-m-d");
                $situacaoDemanda->user_id = Auth::user()->id;
                $salvoSituacao = $situacaoDemanda->save();

                if (!$salvoSituacao) {
                    DB::rollBack();
                    flash()->erro("Erro", "Não foi possível cadastrar a demanda.");
                    return back();
                }
            }
            DB::commit();
            flash()->sucesso("Sucesso", "Demanda cadastrada com sucesso!");
            return redirect("/codem/demanda/dados/$demanda->id/demanda");
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a demanda.");
            return back();
        }
    }

    public function consultarDemanda()
    {

        return view('modulo_codem.consultar_demanda');
    }

    public function pesquisarDemanda(Request $request)
    {

        //return $request->all();

        $where = [];

        if ($request->situacao) {
            $where[] = ['situacao_id', $request->situacao];
        }

        if ($request->tipo_demanda) {
            $where[] = ['tipo_demanda_id', $request->tipo_demanda];
        }

        if ($request->tipo_atendimento) {
            $where[] = ['tipo_atendimento_id', $request->tipo_atendimento];
        }

        if ($request->bln_documento_sei) {
            $where[] = ['bln_documento_sei', $request->bln_documento_sei];
        }

        if ($request->setor) {
            $where[] = ['setor_id', $request->setor];
        }

        if ($request->tema) {
            $where[] = ['tema_id', $request->tema];
        }

        if ($request->prioridade) {
            $where[] = ['prioridade_id', $request->prioridade];
        }

        if ($request->estado) {
            $where[] = ['uf_id', $request->estado];
        }

        if ($request->municipio) {
            $where[] = ['municipio_id', $request->municipio];
        }

        if ($request->tipoInteressado) {
            $where[] = ['tipo_interessado_id', $request->tipoInteressado];
        }
        if (Auth::user()->tipo_usuario_id != 1) {

            $where[] = ['user_id', Auth::user()->id];
        }

        $demandas = RelacaoDemandas::where($where)->orderBy('txt_prioridade')->get();

        if (count($demandas) > 0) {
            return view('modulo_codem.lista_demandas', compact('demandas'));
        } else {
            flash()->erro("Erro", "Não existe demanda para os parâmetros escolhidos.");
            return back();
        }
    }
}
