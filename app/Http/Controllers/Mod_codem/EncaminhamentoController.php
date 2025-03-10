<?php

namespace App\Http\Controllers\Mod_codem;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail\Mod_codem\EncaminhamentoDemanda;
use App\Mod_codem\Demanda;
use App\Mod_codem\Encaminhamento;
use App\Mod_codem\RelacaoDemandas;
use App\Mod_codem\RlcDocumentoDemanda;
use App\Mod_codem\ViewDocumentoDemanda;
use App\Mod_codem\ViewEncaminhamentoDemanda;
use App\Mod_codem\ViewObservacoesDemanda;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use App\Mail\Mod_codem\RespostaEncaminhamento;
use App\Mod_codem\RlcSituacaoDemanda;

class EncaminhamentoController extends Controller
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
    public function encaminhamentoNovo(Request $request)
    {

        $demandaID = $request->demanda_id;

        return view('modulo_codem.cadastrar_encaminhamento', compact('demandaID'));
    }

    public function salvarEncaminhamento(Request $request)
    {

        //return $request->all();

        $demandaID = $request->demanda_id;

        $encaminhamento = new Encaminhamento;
        $encaminhamento->demanda_id = $request->demanda_id;
        $encaminhamento->usuario_id_demandado = $request->usuario;
        $usuario = Auth::user();
        $encaminhamento->user_id = $usuario->id;
        $encaminhamento->dte_encaminhamento = $request->dte_encaminhamento;
        $encaminhamento->dsc_encaminhamento = $request->dsc_encaminhamento;

        $salvoSucesso = $encaminhamento->save();

        DB::beginTransaction();

        if ($salvoSucesso) {
            DB::commit();

            $demanda = Demanda::find($demandaID);

            if ($demanda->situacao_id != 5) {
                $demanda->situacao_id = 5;
                $demanda->update();

                $situacaoDemanda = new RlcSituacaoDemanda();
                $situacaoDemanda->demanda_id = $demanda->id;
                $situacaoDemanda->situacao_demanda_id = 5;
                $situacaoDemanda->dte_situacao = date("Y-m-d");
                $situacaoDemanda->user_id = Auth::user()->id;
                $situacaoDemanda->save();
            }



            $ativarAba = 'encaminhamento';
            $usuarioDemandado = User::find($request->usuario);
            Mail::to($usuarioDemandado->email)->send(new EncaminhamentoDemanda($encaminhamento, $usuarioDemandado));
            flash()->sucesso("Sucesso", "Encaminhamento adicionado com sucesso!");
            return redirect('codem/demanda/dados/' . $demandaID . '/' . $ativarAba);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível adicionar o encaminhamento.");
            return back();
        }
    }

    public function excluirEncaminhamento($encaminhamento)
    {

        $encaminhamentoExcluido = Encaminhamento::where('id', $encaminhamento)->get();


        if (count($encaminhamentoExcluido) == 0) {
            flash()->erro("Erro", "Não existe este encaminhamento.");
            return back();
        }

        DB::beginTransaction();

        $encaminhamentoExcluido = Encaminhamento::find($encaminhamento);
        $demandaId = $encaminhamentoExcluido->demanda_id;

        $encaminhamentoDeletado = $encaminhamentoExcluido->delete();




        if ($encaminhamentoDeletado) {

            $encaminhamentos = Encaminhamento::where('demanda_id', $demandaId)->get();

            if (count($encaminhamentos) == 0) {
                $demanda = Demanda::find($demandaId);
                $demanda->situacao_id = 2;
                $demanda->update();


                $where = [];
                $where[] = ['situacao_demanda_id', 5];
                $where[] = ['demanda_id', $demandaId];

                $situacaoDemanda = RlcSituacaoDemanda::where($where)->first();
                if ($situacaoDemanda) {
                    $situacaoDemanda->delete();
                }

                $novaSituacaoDemanda = new RlcSituacaoDemanda();
                $novaSituacaoDemanda->demanda_id = $demanda->id;
                $novaSituacaoDemanda->situacao_demanda_id = 5;
                $novaSituacaoDemanda->dte_situacao = date("Y-m-d");
                $novaSituacaoDemanda->user_id = Auth::user()->id;
                $novaSituacaoDemanda->save();
            }

            DB::commit();
            flash()->sucesso("Sucesso", "Encaminhamento excluído com sucesso!");



            $ativarAba = 'encaminhamento';

            return redirect('codem/demanda/dados/' . $demandaId . '/' . $ativarAba);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível excluir o encaminhamento");
            return back();
        }
    }

    public function dadosEncaminhamento($encaminhamento)
    {

        $encaminhamentoVisualizado = Encaminhamento::find($encaminhamento);

        if (!$encaminhamentoVisualizado->bln_visualizado) {

            $encaminhamentoVisualizado->bln_visualizado = true;
            $encaminhamentoVisualizado->dte_visualizacao = date("Y-m-d h:i:s");

            $encaminhamentoVisualizado->update();
        }


        $encaminhamento = ViewEncaminhamentoDemanda::where('id', $encaminhamento)->firstOrFail();

        $demanda = Demanda::find($encaminhamento->demanda_id);


        return view('modulo_codem.editar_encaminhamento', compact('encaminhamento', 'demanda'));
    }

    public function atualizarEncaminhamento(Request $request)
    {


        //return $request->all();

        DB::beginTransaction();

        $demandaID = $request->demanda_id;

        $encaminhamento = Encaminhamento::find($request->encaminhamento_id);

        if ($request->usuario != $encaminhamento->usuario_id_demandado) {
            $encaminhamento->usuario_id_demandado = $request->usuario;
        }

        if ($request->dsc_encaminhamento) {
            $encaminhamento->dsc_encaminhamento = $request->dsc_encaminhamento;
        }

        $encaminhamento->dsc_resposta_encaminhamento = $request->dsc_resposta_encaminhamento;
        $encaminhamento->bln_concluido = $request->bln_concluido;
        $encaminhamento->dte_resposta = $request->dte_resposta;

        $salvoSucesso = $encaminhamento->update();

        DB::beginTransaction();

        if ($salvoSucesso) {
            DB::commit();

            if ($encaminhamento->bln_concluido) {
                $usuario = User::find($encaminhamento->usuario_id_demandado);
                Mail::to($usuario->email)->send(new RespostaEncaminhamento($encaminhamento, $usuario));
            }
            $ativarAba = 'encaminhamento';

            flash()->sucesso("Sucesso", "Encaminhamento atualizado com sucesso!");
            return redirect('codem/demanda/dados/' . $demandaID . '/' . $ativarAba);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar o encaminhamento.");
            return back();
        }
    }
}
