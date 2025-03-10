<?php

namespace App\Http\Controllers\Mod_resultado_primario;

use App\Exports\Mod_resultado_primario\ArquivoLoteRp8Export;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Mod_rp\ValidacaoOficio;
use App\Mod_resultado_primario\ArquivosLote;
use App\Mod_resultado_primario\EmendasComissoes;
use App\Mod_resultado_primario\OficiosEmendas;
use App\Mod_resultado_primario\SituacoesOficios;
use App\Mod_resultado_primario\UsuariosRespostas;
use App\Mod_resultado_primario\ViewCnpjsHabilitar;
use App\Mod_resultado_primario\ViewEmendasValidadas;
use App\Mod_resultado_primario\ViewOficiosEmendas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class OficioEmendasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultarOficio()
    {
        return view('modulo_rp.consultar_oficio_emendas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisarOficio(Request $request)
    {

        //return $request->all();

        $where = [];

        if ($request->txt_cnpj) {
            $emendasCnpj =  ViewEmendasValidadas::where('txt_cnpj', $request->txt_cnpj)->get();

            $emendasCnpj->load('oficioEmenda');

            if (count($emendasCnpj) == 0) {
                flash()->erro("Erro", "Não existe ofício para os parâmetros escolhidos.");
                return back();
            }


            return view('modulo_rp.lista_emendas_cnpj', compact('emendasCnpj'));
        }

        if ($request->oficio) {
            $dadosOficio = ViewOficiosEmendas::where('oficio_emenda_id', $request->oficio)->first();
            if ($dadosOficio->situacao_oficio_id == 1) {
                return redirect("/rp/arquivo/validar/rp8/oficio//$request->oficio");
            } else {
                return redirect("/rp/rp8/validado/oficio/$request->oficio");
            }
        }

        if ($request->situacao_oficio) {
            $where[] = ['situacao_oficio_id', $request->situacao_oficio];
        }


        if ($request->casa_legislativa) {
            $where[] = ['casa_legislativa_id', $request->casa_legislativa];
        }

        if ($request->comissao) {
            $where[] = ['comissao_id', $request->comissao];
        }

        if ($request->programa) {
            $where[] = ['cod_programa', $request->programa];
        }

        if ($request->acao) {
            $where[] = ['cod_acao_governo', $request->acao];
        }

        $dadosOficio = ViewOficiosEmendas::where($where)->get();

        if (count($dadosOficio) == 0) {
            flash()->erro("Erro", "Não existe ofício para os parâmetros escolhidos.");
            return back();
        }



        return view('modulo_rp.lista_oficios_emendas', compact('dadosOficio'));
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

    public function validarOficioEmenda($oficioEmendaId)
    {
        DB::beginTransaction();
        $oficioEmenda = OficiosEmendas::find($oficioEmendaId);
        $oficioEmenda->situacao_oficio_id = 2;
        $oficioEmenda->dte_analise = Date('Y-m-d');
        $oficioEmenda->user_id = Auth::user()->id;
        $oficioValidadoSucesso = $oficioEmenda->update();

        $dadosArquivoHabilitacao = ViewCnpjsHabilitar::where('oficio_emenda_id', $oficioEmendaId)->get();

        foreach ($dadosArquivoHabilitacao as $dados) {

            $emenda = EmendasComissoes::find($dados->emenda_comissao_id);
            $emenda->tipo_habilitacao_cnpj_id =  $dados->tipo_habilitacao_cnpj_id;
            $emenda->vlr_transferegov =  floatval($dados->vlr_transferegov);
            $emenda->vlr_tarifa =  floatval($dados->vlr_tarifa);

            $emendaSalva = $emenda->update();

            if (!$emendaSalva) {
                DB::rollBack();
                flash()->erro("Erro", "Não foi possível validar o Ofício.");
                return back();
            }
        }

        $destinatarios = UsuariosRespostas::where('bln_ativo', true)->get();
        $destinatarios->load('user');

        $emails = [];

        foreach ($destinatarios as $dados) {
            array_push($emails, $dados->user->email);
        }



        if ($oficioValidadoSucesso) {
            DB::commit();
            //Mail::to($emails)->send(new ValidacaoOficio($oficioEmenda, $dadosArquivoHabilitacao));
            flash()->sucesso("Sucesso", "Ofício validado com sucesso!");
            return redirect("/rp/rp8/validado/oficio/$oficioEmendaId");
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível validar o Ofício.");
            return back();
        }
    }

    public function visualizarOficio($id)
    {
        $dadosOficio = ViewOficiosEmendas::where('oficio_emenda_id', $id)->firstOrFail();
        $dadosEmenda = ViewCnpjsHabilitar::where('oficio_emenda_id', $id)->get();
    }

    public function oficioValidadoRP8($oficioId)
    {
        $oficioEmendas  = ViewOficiosEmendas::where('oficio_emenda_id', $oficioId)->firstOrFail();

        $dadosArquivoHabilitacao = ViewEmendasValidadas::where('oficio_emenda_id', $oficioId)->get();

        $dadosHabManual = [];
        $dadosHabLote = [];
        $dadosHabInvalidada = [];

        $totalDadosHabManual = ['vlr_emenda' => 0, 'vlr_tarifa' => 0, 'vlr_transferegov' => 0];
        $totalDadosHabLote = ['vlr_emenda' => 0, 'vlr_tarifa' => 0, 'vlr_transferegov' => 0];
        $totalDadosHabInvalidada = ['vlr_emenda' => 0, 'vlr_tarifa' => 0, 'vlr_transferegov' => 0];


        foreach ($dadosArquivoHabilitacao as $dados) {
            if ($dados->tipo_habilitacao_cnpj_id == 1) {
                $totalDadosHabManual['vlr_emenda'] += $dados->vlr_emenda;
                $totalDadosHabManual['vlr_tarifa'] += $dados->vlr_tarifa;
                $totalDadosHabManual['vlr_transferegov'] += $dados->vlr_transferegov;
                array_push($dadosHabManual, $dados);
            } else if ($dados->tipo_habilitacao_cnpj_id == 2) {
                $totalDadosHabLote['vlr_emenda'] += $dados->vlr_emenda;
                $totalDadosHabLote['vlr_tarifa'] += $dados->vlr_tarifa;
                $totalDadosHabLote['vlr_transferegov'] += $dados->vlr_transferegov;
                array_push($dadosHabLote, $dados);
            } else {
                $totalDadosHabInvalidada['vlr_emenda'] += $dados->vlr_emenda;
                $totalDadosHabInvalidada['vlr_tarifa'] += $dados->vlr_tarifa;
                $totalDadosHabInvalidada['vlr_transferegov'] += $dados->vlr_transferegov;
                array_push($dadosHabInvalidada, $dados);
            }
        }

        $situacaoOficio = SituacoesOficios::select('id', 'txt_situacao_oficio AS nome')->orderBy('txt_situacao_oficio')->get();

        return view(
            'modulo_rp.oficio_validado',
            compact('situacaoOficio', 'oficioEmendas', 'dadosArquivoHabilitacao', 'dadosHabManual', 'dadosHabLote', 'dadosHabInvalidada', 'totalDadosHabManual', 'totalDadosHabLote', 'totalDadosHabInvalidada')
        );
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
    public function update(Request $request)
    {
        //
        DB::beginTransaction();
        //return  $request->all();

        $oficio = OficiosEmendas::find($request->oficio_emenda_id);
        $oficio->situacao_oficio_id = $request->situacao_oficio_id;
        $oficio->dsc_observacao = $request->dsc_observacao;

        $oficioAtualizadoSucesso = $oficio->update();


        if ($oficioAtualizadoSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Ofício atualizado com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar o Ofício.");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportarArquivoLoteRp8($oficioEmendaId)
    {
        //
        $where = [];
        $where[] = ['oficio_emenda_id', $oficioEmendaId];
        $where[] = ['tipo_habilitacao_cnpj_id', 2];
        $emendasOficio = EmendasComissoes::where($where)->get();

        $arquivoLote = ArquivosLote::where('oficio_emenda_id', $oficioEmendaId)->first();
        $num_arquivo_lote = 0;

        if (empty($arquivoLote)) {
            DB::beginTransaction();
            $arquivoLote = new ArquivosLote;
            $arquivoLote->oficio_emenda_id = $oficioEmendaId;
            $arquivoLote->num_registros = $oficioEmendaId;
            $arquivoLote->created_at = Date('Y-m-d');
            $salvoSucesso = $arquivoLote->save();


            if (!$salvoSucesso) {
                DB::rollBack();
                flash()->erro("Erro", "Não foi salvar dados do download.");
                return back();
            } else {
                DB::commit();
            }
        }
        $num_arquivo_lote = $arquivoLote->id;



        return Excel::download(new ArquivoLoteRp8Export($oficioEmendaId), 'ARQ_IMP_EMENDA_PARLAMENTAR_' . $num_arquivo_lote . '.xlsx');
    }
}
