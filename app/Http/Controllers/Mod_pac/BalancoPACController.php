<?php

namespace App\Http\Controllers\Mod_pac;

use App\Corporativo\Mcid_carteira_investimento\Fonte;
use App\Corporativo\Mcid_carteira_investimento\Subfonte;
use App\Corporativo\Mcid_transferegov\MetaCronoFisico;
use App\Corporativo\Mcid_transferegov\Propostas;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mod_pac\AnaliseExecucaoPac;
use App\Mod_saci\mod_ibge\Uf;
use App\Mod_pac\ViewBalancoPac;
use App\Mod_pac\ViewEtapaPac;
use App\Mod_pac\ViewMetasEtapaPac;
use App\Mod_pac\ViewMunicipiosBalancoPac;
use App\Mod_pac\ViewObrasParalisadasPac;
use App\Mod_pac\ViewResumoBalancoPac;
use App\Mod_pendencias_caixa\DadosFinanceiros;
use App\Mod_pendencias_caixa\OrdensBancarias;
use App\Mod_saci\mod_pac\ContratosPac;
use Illuminate\Support\Facades\Auth;


class BalancoPACController extends Controller
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

    public function consultarBalancoPac()
    {
        $resumoPac = ViewResumoBalancoPac::get();

        return view('modulo_pac.consultar_contratos_pac', compact('resumoPac'));
    }

    public function pesquisarBalancoPac(Request $request)
    {
        //return $request->all();


        $where = [];

        if ($request->cod_uf) {
            $estado = Uf::where('id_uf', $request->cod_uf)->firstOrFail();
            $where[] = ['uf', $estado->sg_uf];
        }



        if ($request->municipio) {
            $where[] = ['ibge', $request->municipio];
        }





        if ($request->fase_novo_pac) {
            $where[] = ['cod_fase_pac', $request->fase_novo_pac];
        }

        if ($request->cod_secretaria) {
            $where[] = ['secretaria', $request->cod_secretaria];
        }



        if ($request->fonte) {
            $fonte = Fonte::find($request->fonte);
            $where[] = ['txt_fonte', $fonte->txt_fonte];
        }

        if ($request->sub_fonte) {
            $sub_fonte = Subfonte::find($request->sub_fonte);

            $where[] = ['txt_sub_fonte', $sub_fonte->dsc_sub_fonte];
        }

        if ($request->origem) {
            $where[] = ['cod_origem', $request->origem];
        }

        $balancoPac =  ViewBalancoPac::where($where)->orderBy('uf')->orderBy('municipio')->get();

        if (count($balancoPac) > 0) {
            return view('modulo_pac.lista_contratos_balanco', compact('balancoPac'));
        } else {

            flash()->erro("Erro", "Não existe contrato para os parâmetros escolhidos.");
            return back();
        }
    }

    public function dadosContrato($cod_contrato)
    {

        $dadosContrato = ViewBalancoPac::where('cod_contrato', $cod_contrato)->first();
        $contratoPac = '';
        $metas = '';
        if ($dadosContrato->cod_fase_pac == 9) {
            $dadosContrato->load('municipios', 'etapasPacs.metasPacs');

            $contratoPac = ContratosPac::where('cod_contrato', trim($dadosContrato->cod_contrato))->first();
            $contratoPac->load('observacoesContratos');
        } else {

            $metas = MetaCronoFisico::where('num_convenio', $dadosContrato->num_convenio)->orderBy('num_meta')->get();
            $metas->load('etapas');
        }

        $proposta = Propostas::find($dadosContrato->cod_proposta);
        $obrasParalisada = ViewObrasParalisadasPac::where('cod_contrato_ajustado', $cod_contrato)->first();
        $dadosFinanceiros = DadosFinanceiros::where('cod_projeto', $dadosContrato->cod_contrato)->first();
        $ordensBancarias = OrdensBancarias::where('cod_operacao', trim($dadosContrato->cod_contrato))->get();

        return view(
            'modulo_pac.dados_contrato_balanco',
            compact(
                'dadosContrato',
                'obrasParalisada',
                'dadosFinanceiros',
                'ordensBancarias',
                'contratoPac',
                'proposta',
                'metas'
            )
        );
    }

    public function consultarAnaliseExecPac()
    {



        return view(
            'modulo_pac.consultar_analise_exec_pac'
        );
    }

    public function pesquisarAnaliseExecPac(Request $request)
    {


        // return $request->all();

        $where = [];

        if ($request->cod_uf) {
            $where[] = ['uf', $request->cod_uf];
        }

        if ($request->municipio) {
            $where[] = ['municipio', $request->municipio];
        }

        if ($request->fase_novo_pac) {
            $where[] = ['txt_pac_migrado', $request->fase_novo_pac];
        }

        $analise = AnaliseExecucaoPac::where($where)->get();
        $analise03Meses = AnaliseExecucaoPac::SelectRaw(
            "'03 meses'::text AS periodo,
                    avg(tab_tmp_analise_execucao.prc_exec_03_meses)::numeric(15,2) AS media,
                    (avg(tab_tmp_analise_execucao.prc_exec_03_meses) / 3::double precision)::numeric(15,2) AS media_mensal,
                    ((avg(tab_tmp_analise_execucao.prc_exec_03_meses) / 3) * 12::double precision)::numeric(15,2) AS media_anual,
                    max(tab_tmp_analise_execucao.prc_exec_03_meses) AS maxima,
                    min(tab_tmp_analise_execucao.prc_exec_03_meses) AS minima"
        )->where($where)->first();

        $analise12Meses = AnaliseExecucaoPac::SelectRaw(
            "'12 meses'::text AS periodo,
                    avg(tab_tmp_analise_execucao.prc_exec_12_meses)::numeric(15,2) AS media,
                    (avg(tab_tmp_analise_execucao.prc_exec_12_meses) / 3::double precision)::numeric(15,2) AS media_mensal,
                    ((avg(tab_tmp_analise_execucao.prc_exec_12_meses) / 3) * 12::double precision)::numeric(15,2) AS media_anual,
                    max(tab_tmp_analise_execucao.prc_exec_12_meses) AS maxima,
                    min(tab_tmp_analise_execucao.prc_exec_12_meses) AS minima"
        )->where($where)->first();

        $analise36Meses = AnaliseExecucaoPac::SelectRaw(
            "'36 meses'::text AS periodo,
                        avg(tab_tmp_analise_execucao.prc_exec_36_meses)::numeric(15,2) AS media,
                        (avg(tab_tmp_analise_execucao.prc_exec_36_meses) * 3::double precision)::numeric(15,2) AS media_mensal,
                        ((avg(tab_tmp_analise_execucao.prc_exec_36_meses) / 3) * 12::double precision)::numeric(15,2) AS media_anual,
                        max(tab_tmp_analise_execucao.prc_exec_36_meses) AS maxima,
                        min(tab_tmp_analise_execucao.prc_exec_36_meses) AS minima"
        )->where($where)->first();



        if (count($analise) > 0) {
            return view('modulo_pac.lista_contratos_analise_execucao', compact('analise', 'analise03Meses', 'analise12Meses', 'analise36Meses'));
        } else {

            flash()->erro("Erro", "Não existe contrato para os parâmetros escolhidos.");
            return back();
        }
    }
}