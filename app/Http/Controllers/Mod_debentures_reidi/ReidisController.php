<?php

namespace App\Http\Controllers\Mod_debentures_reidi;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mod_debentures_reidi\Projetos;
use App\Mod_debentures_reidi\ProjetosReidis;
use App\Mod_debentures_reidi\RlcUfProjetosReidis;
use App\Mod_debentures_reidi\ViewProjetosdebenturesReidi;
use App\Mod_debentures_reidi\ViewProjetosReidis;
use App\Mod_debentures_reidi\ViewUfProjetosReidis;
use App\Mod_saci\mod_ibge\Uf;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReidisController extends Controller
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
        return view('modulo_debentures_reidi.reidi.Consultar_projeto', compact('usuario'));
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





        $projetos = ViewProjetosReidis::where($where)->orderBy('sg_uf')->get();



        if (count($projetos) == 0) {
            flash()->erro("Erro", "Não existe projeto para os parâmetros selecionados.");
            return back();
        }
        return view('modulo_debentures_reidi.reidi.Lista_projeto', compact('usuario', 'projetos'));
    }

    public function dadosProjeto(ProjetosReidis $projeto)
    {
        $projeto->load('setorProjeto');
        $estados = ViewUfProjetosReidis::where('projeto_reidi_id', $projeto->id)->orderBy('sg_uf')->get();

        return view('modulo_debentures_reidi.reidi.dados_projeto', compact('projeto', 'estados'));
    }

    public function updateProjeto(Request $request)
    {

        DB::beginTransaction();

        $projeto = ProjetosReidis::find($request->projeto_id);


        //return $request->all();

        $projeto->cod_carta_consulta = $request->cod_carta_consulta;
        $projeto->vlr_projeto_sem_reidi = $request->vlr_projeto_sem_reidi;
        $projeto->vlr_projeto_com_reidi = $request->vlr_projeto_com_reidi;
        $projeto->vlr_investimento_projeto = $request->vlr_investimento_projeto;
        $projeto->vlr_estimado_beneficio = $request->vlr_estimado_beneficio;
        $projeto->num_ano_portaria = $request->portaria;
        $projeto->dte_portaria = $request->data_portaria;
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
        $where[] = ['projeto_reidi_id', $request->projeto_id];

        $estadoAdicionado = RlcUfProjetosReidis::where($where)->get();

        if (count($estadoAdicionado) > 0) {
            flash()->erro("Erro", "Esse estado já foi adicionado a esse projeto.");
            return back();
        }

        $estado = new RlcUfProjetosReidis;
        $estado->uf_id = $request->estado;
        $estado->projeto_reidi_id = $request->projeto_id;

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

        $estado = RlcUfProjetosReidis::find($ufProjetoId);

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
        return view('modulo_debentures_reidi.reidi.Cadastrar_projeto');
    }


    public function salvarProjeto(Request $request)
    {

        DB::beginTransaction();

        //return $request->all();
        $projeto = new ProjetosReidis;

        $projeto->cod_carta_consulta = $request->cod_carta_consulta;
        $projeto->uf_id = $request->estado;

        $estado = Uf::find($request->estado);
        $projeto->sg_uf = $estado->sg_uf;


        $projeto->txt_titular_projeto = $request->titular_projeto;
        $projeto->txt_nome_projeto = $request->txt_nome_projeto;
        $projeto->setor_projeto_id = $request->setor_projeto;

        //return $request->all();

        $projeto->vlr_projeto_sem_reidi = $request->vlr_projeto_sem_reidi;
        $projeto->vlr_projeto_com_reidi = $request->vlr_projeto_com_reidi;
        $projeto->vlr_investimento_projeto = $request->vlr_investimento_projeto;
        $projeto->vlr_estimado_beneficio = $request->vlr_estimado_beneficio;
        $projeto->num_ano_portaria = $request->portaria;
        $projeto->dte_portaria = $request->data_portaria;
        $projeto->user_id = Auth::user()->id;
        $salvoSucesso = $projeto->save();

        $estadoProjeto = new RlcUfProjetosReidis;
        $estadoProjeto->uf_id = $request->estado;
        $estadoProjeto->projeto_reidi_id = $projeto->id;
        $salvoProjeto = $estadoProjeto->save();

        if ($salvoSucesso && $salvoProjeto) {
            DB::commit();

            flash()->sucesso("Sucesso", "Dados do projeto atualizados com sucesso!");
            return redirect("/debentures_reidi/projeto/reidis/" . $projeto->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar os dados do projeto.");
            return back();
        }
    }
}
