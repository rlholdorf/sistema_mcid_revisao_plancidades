<?php

namespace App\Http\Controllers\Mod_debentures_reidi;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mod_debentures_reidi\ProjetosDebentures;
use App\Mod_debentures_reidi\RlcUfProjetosDebentures;
use App\Mod_debentures_reidi\ViewProjetosDebentures;
use App\Mod_debentures_reidi\ViewUfProjetosDebentures;
use App\Mod_saci\mod_ibge\Uf;
use App\User;
use DB;

use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class DebenturesController extends Controller
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
    public function consultarProjeto()
    {
        $usuario = Auth::user();
        return view('modulo_debentures_reidi.debentures.Consultar_projeto', compact('usuario'));
    }

    public function pesquisarProjeto(Request $request)
    {
        $usuario = Auth::user();

        // return $request->all();

        $where = [];

        if ($request->estado) {
            $where[] = ['sg_uf', $request->estado];
        }

        if ($request->setor_projeto) {
            $where[] = ['setor_projeto_id', $request->setor_projeto];
        }

        if ($request->tipo_projeto) {
            $where[] = ['tipo_projeto_id', $request->tipo_projeto];
        }
        if ($request->bln_contabilizar_valores) {
            if ($request->bln_contabilizar_valores == '0') {
                $where = ['bln_contabilizar_valores', false];
            } else {
                $where[] = ['bln_contabilizar_valores', true];
            }
        }



        $projetos = ViewProjetosDebentures::where($where)->orderBy('sg_uf')->get();



        if (count($projetos) == 0) {
            flash()->erro("Erro", "Não existe projeto para os parâmetros selecionados.");
            return back();
        }
        return view('modulo_debentures_reidi.debentures.Lista_projeto', compact('usuario', 'projetos'));
    }

    public function dadosProjeto(ProjetosDebentures $projeto)
    {
        $projeto->load('setorProjeto');
        $estados = ViewUfProjetosDebentures::where('projeto_debenture_id', $projeto->id)->orderBy('sg_uf')->get();
        return view('modulo_debentures_reidi.debentures.dados_projeto', compact('projeto', 'estados'));
    }

    public function updateProjeto(Request $request)
    {

        DB::beginTransaction();

        $projeto = ProjetosDebentures::find($request->projeto_id);


        $projeto->vlr_investimento_projeto = $request->vlr_investimento_projeto;
        $projeto->cod_carta_consulta = $request->cod_carta_consulta;

        if ($request->bln_contabilizar_valores == '0') {
            $projeto->bln_contabilizar_valores = false;
        } else {
            $projeto->bln_contabilizar_valores = true;
        }


        $projeto->num_ano_portaria = $request->portaria;
        $projeto->dte_portaria = $request->data_portaria;
        $projeto->vlr_aprovado_emissao = $request->vlr_aprovado_emissao;
        $projeto->vlr_captado = $request->vlr_captado;
        $projeto->user_id = Auth::user()->id;

        $salvoSucesso = $projeto->update();

        if ($salvoSucesso) {
            DB::commit();

            flash()->sucesso("Sucesso", "Dados do projeto atualizados com sucesso!");
            return redirect()->back();
            // return redirect("/debentures_reidi/projeto/" . $projeto->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar os dados do projeto.");
            return back();
        }
    }

    public function addEstado(Request $request)
    {

        DB::beginTransaction();

        $where = [];


        $where[] = ['uf_id', $request->estado];
        $where[] = ['projeto_debenture_id', $request->projeto_id];

        $estadoAdicionado = RlcUfProjetosDebentures::where($where)->get();

        if (count($estadoAdicionado) > 0) {
            flash()->erro("Erro", "Esse estado já foi adicionado a esse projeto.");
            return back();
        }

        $estado = new RlcUfProjetosDebentures;
        $estado->uf_id = $request->estado;
        $estado->projeto_debenture_id = $request->projeto_id;

        $salvoSucesso = $estado->save();

        if ($salvoSucesso) {
            DB::commit();

            flash()->sucesso("Sucesso", "Estado adicionado com sucesso!");
            return redirect()->back();
            // return redirect("/debentures_reidi/projeto/" . $projeto->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível adicionar o estado.");
            return back();
        }
    }

    public function excluirEstado($ufProjetoId)
    {

        DB::beginTransaction();

        $estado = RlcUfProjetosDebentures::find($ufProjetoId);

        $deleteSucesso = $estado->delete();

        if ($deleteSucesso) {
            DB::commit();

            flash()->sucesso("Sucesso", "Estado deletado com sucesso!");
            return redirect()->back();
            // return redirect("/debentures_reidi/projeto/" . $projeto->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível deletar o estado.");
            return back();
        }
    }

    public function cadastrarProjeto(Request $request)
    {
        return view('modulo_debentures_reidi.debentures.Cadastrar_projeto');
    }

    public function salvarProjeto(Request $request)
    {

        $request->all();

        DB::beginTransaction();

        $projeto = new ProjetosDebentures;

        $projeto->cod_carta_consulta = $request->cod_carta_consulta;
        $projeto->uf_id = $request->estado;

        $estado = Uf::find($request->estado);
        $projeto->sg_uf = $estado->sg_uf;


        $projeto->txt_titular_projeto = $request->titular_projeto;
        $projeto->txt_nome_projeto = $request->txt_nome_projeto;
        $projeto->setor_projeto_id = $request->setor_projeto;


        $projeto->vlr_investimento_projeto = $request->vlr_investimento_projeto;


        if ($request->bln_contabilizar_valores == '0') {
            $projeto->bln_contabilizar_valores = false;
        } else {
            $projeto->bln_contabilizar_valores = true;
        }


        $projeto->num_ano_portaria = $request->portaria;
        $projeto->dte_portaria = $request->data_portaria;
        $projeto->vlr_aprovado_emissao = $request->vlr_aprovado_emissao;
        $projeto->vlr_captado = $request->vlr_captado;
        $projeto->user_id = Auth::user()->id;

        $salvoSucesso = $projeto->save();

        $estadoProjeto = new RlcUfProjetosDebentures;
        $estadoProjeto->uf_id = $request->estado;
        $estadoProjeto->projeto_debenture_id = $projeto->id;
        $salvoProjeto = $estadoProjeto->save();

        if ($salvoSucesso && $salvoProjeto) {


            DB::commit();

            flash()->sucesso("Sucesso", "Dados do projeto salvos com sucesso!");

            return redirect("/debentures_reidi/projeto/debentures/" . $projeto->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível salvar os dados do projeto.");
            return back();
        }
    }
}
