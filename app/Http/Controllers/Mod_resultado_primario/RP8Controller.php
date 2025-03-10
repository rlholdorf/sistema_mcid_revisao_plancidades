<?php

namespace App\Http\Controllers\Mod_resultado_primario;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;



use Illuminate\Support\Facades\Mail;


use DB;



use Illuminate\Support\Facades\Auth;

use App\Imports\Mod_resultado_primario\FileRP8Import;
use App\Mail\Mod_rp\ValidacaoOficio;
use App\Mod_resultado_primario\EmendasComissoes;
use App\Mod_resultado_primario\OficiosEmendas;
use App\Mod_resultado_primario\UsuariosRespostas;
use App\Mod_resultado_primario\ViewCnpjsHabilitar;
use App\Mod_resultado_primario\ViewOficiosEmendas;
use App\Mod_resultado_primario\ViewValidaArquivoEmendas;
use Maatwebsite\Excel\Facades\Excel;

class RP8Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    public function importarArquivoPR8()
    {
        return view('modulo_rp.arquivos.importar_arquivo_rp8');
    }

    public function importarDadosPR8(Request $request)
    {

        // return $request->all();

        DB::beginTransaction();

        //$path = $request->formFile->getRealPath();



        Excel::import(new FileRP8Import, $request->file('formFile')->store('files'));
        //Excel::import(new FileRP8Import, $path);


        $dadosOficio = new OficiosEmendas();
        $dadosOficio->txt_num_processo_sei = $request->num_processo_sei;
        $dadosOficio->num_oficio_congresso = $request->num_oficio_congresso;
        $dadosOficio->txt_num_oficio_completo_congresso = $request->txt_num_oficio_completo_congresso;
        $dadosOficio->dte_oficio_congresso = $request->dte_oficio_congresso;
        $dadosOficio->num_documento_sei_oficio_congresso = $request->num_documento_sei_oficio_congresso;
        $dadosOficio->comissao_id = $request->comissao;
        $dadosOficio->situacao_oficio_id = 1;
        $dadosOficio->cod_programa = $request->programa;
        $dadosOficio->txt_acao = $request->acao;


        $dadosOficio->user_id = Auth::user()->id;

        $oficioSalvoSucesso = $dadosOficio->save();

        $oficioID = $dadosOficio->id;

        $dadosEmendas = EmendasComissoes::where('user_id', Auth::user()->id)->whereNull('oficio_emenda_id')->get();

        foreach ($dadosEmendas as $dados) {
            $emendas = EmendasComissoes::find($dados->id);
            $emendas->oficio_emenda_id = $dadosOficio->id;
            $emendas->cod_programa = $request->programa;
            $emendas->txt_acao = $request->acao;
            $emendas->txt_resultado_primario = 'RP8';


            $oficioEmendaSAtualizadaSucesso = $emendas->update();
        }






        !$emendaValidadaSucesso = false;

        if ($oficioSalvoSucesso && $oficioEmendaSAtualizadaSucesso) {

            $validaEmendaComissao = ViewValidaArquivoEmendas::where('oficio_emenda_id',  $oficioID)->get();
            foreach ($validaEmendaComissao  as $dados) {

                if ($dados->bln_valida_beneficiario && $dados->bln_valida_cnpj) {
                    $emendaComissao = EmendasComissoes::find($dados->emenda_comissao_id);
                    $emendaComissao->txt_beneficiario = $dados->nom_proponente;
                    $emendaComissao->bln_valida_beneficiario = true;
                    $emendaComissao->bln_valida_cnpj = true;
                    $emendaComissao->bln_registro_validado = true;
                    $emendaComissao->bln_validacao_automatica = true;
                    $emendaComissao->dte_validacao_registro = Date('Y-m-d');
                    $emendaComissao->user_id = Auth::user()->id;
                    $emendaValidadaSucesso = $emendaComissao->update();

                    if (!$emendaValidadaSucesso) {
                        DB::rollBack();
                        flash()->erro("Erro", "Não foi possível validar a emenda.");
                        return back();
                    }
                }
            }

            DB::commit();
            flash()->sucesso("Sucesso", "Ofício importado com sucesso!");
            return redirect("/rp/arquivo/validar/rp8/oficio/$dadosOficio->id");
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível importar o ofício.");
            return back();
        }
    }

    public function validarOficioRp8($oficioId)
    {

        $where = [];
        $where[] = ['bln_registro_validado', FALSE];
        $where[] = ['bln_valida_beneficiario', FALSE];
        $where[] = ['bln_valida_cnpj', true];
        $where[] = ['oficio_emenda_id', $oficioId];


        $numRegistrosValidar = ViewValidaArquivoEmendas::where($where)->whereNotNull('num_emenda')->count();



        $where = [];
        //$where[] = ['user_id', Auth::user()->id];
        $where[] = ['oficio_emenda_id', $oficioId];


        $oficioEmendas = ViewOficiosEmendas::where($where)->firstOrFail();
        $emendasComissoesValidar = ViewValidaArquivoEmendas::where($where)->get();

        return view('modulo_rp.arquivos.validar_oficio_rp8', compact('oficioEmendas', 'emendasComissoesValidar', 'numRegistrosValidar'));
    }



    public function editarnumIndicacao($emendaComissaoId)
    {
        $emendaComissao = EmendasComissoes::find($emendaComissaoId);
        $oficioEmendas = ViewOficiosEmendas::where('oficio_emenda_id', $emendaComissao->oficio_emenda_id)->firstOrFail();
        $blnIndicacao = 'true';
        return view('modulo_rp.emendas_comissao_rp8', compact('emendaComissao', 'oficioEmendas', 'blnIndicacao'));
    }

    public function editarEmendaComissao($emendaComissaoId)
    {
        $emendaComissao = EmendasComissoes::find($emendaComissaoId);
        $oficioEmendas = ViewOficiosEmendas::where('oficio_emenda_id', $emendaComissao->oficio_emenda_id)->firstOrFail();
        $blnIndicacao = 'false';
        return view('modulo_rp.emendas_comissao_rp8', compact('emendaComissao', 'oficioEmendas', 'blnIndicacao'));
    }




    public function updateEmendaComissao(Request $request)
    {
        DB::beginTransaction();
        //return $request->all();
        $emendaComissao = EmendasComissoes::find($request->emenda_comissao_id);

        if ($request->id_indicacao_congresso) {
            $emendaComissao->id_indicacao_congresso = $request->id_indicacao_congresso;
        } else {
            $emendaComissao->num_emenda = $request->num_emenda;
            $emendaComissao->txt_beneficiario = $request->txt_beneficiario;
            $emendaComissao->txt_uf = $request->txt_uf;
            $emendaComissao->txt_cnpj = $request->txt_cnpj;
            $emendaComissao->cod_modalidade = $request->cod_modalidade;
            $emendaComissao->txt_funcional_programatica = $request->txt_funcional_programatica;
            $emendaComissao->txt_acao = $request->txt_acao;
            $emendaComissao->nun_gnd = $request->nun_gnd;
            $emendaComissao->vlr_emenda = $request->vlr_emenda;
            $emendaComissao->motivo_correcao_id = $request->motivo_correcao;
        }



        $emendaAtualizada = $emendaComissao->update();

        if ($emendaAtualizada) {
            DB::commit();
            flash()->sucesso("Sucesso", "Emenda atualizada com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível Atualizar a emenda.");
            return back();
        }
    }

    public function validarEmendaComissao($emendaComissaoId)
    {

        DB::beginTransaction();
        $validaEmendaComissao = ViewValidaArquivoEmendas::where('emenda_comissao_id', $emendaComissaoId)->firstOrFail();

        $emendaComissao = EmendasComissoes::find($emendaComissaoId);
        $emendaComissao->txt_beneficiario = $validaEmendaComissao->nom_proponente;
        $emendaComissao->bln_valida_beneficiario = true;
        $emendaComissao->bln_valida_cnpj = true;
        $emendaComissao->bln_registro_validado = true;
        $emendaComissao->dte_validacao_registro = Date('Y-m-d');
        $emendaComissao->user_id = Auth::user()->id;
        $emendaValidadaSucesso = $emendaComissao->update();

        if ($emendaValidadaSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Proponente validado com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível validar o proponente.");
            return back();
        }
    }

    public function invalidarEmendaComissao($emendaComissaoId)
    {
        DB::beginTransaction();

        $validaEmendaComissao = ViewValidaArquivoEmendas::where('emenda_comissao_id', $emendaComissaoId)->firstOrFail();

        $emendaComissao = EmendasComissoes::find($emendaComissaoId);
        $emendaComissao->bln_registro_validado = false;
        $emendaComissao->dte_validacao_registro = Date('Y-m-d');
        $emendaComissao->user_id = Auth::user()->id;
        $emendaValidadaSucesso = $emendaComissao->update();

        if ($emendaValidadaSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Proponente invalidado com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível invalidar o proponente.");
            return back();
        }
    }



    public function gerarArquivoHabilitacao($oficioEmendaId)
    {
        $where = [];
        $where[] = ['oficio_emenda_id', $oficioEmendaId];
        $where[] = ['user_id', Auth::user()->id];
        $where[] = ['bln_registro_validado', true];

        return $dadosArquivoHabilitacao = EmendasComissoes::where($where)->get();
    }
}
