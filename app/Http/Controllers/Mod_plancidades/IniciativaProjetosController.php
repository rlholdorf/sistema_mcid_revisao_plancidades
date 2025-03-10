<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IniciativaProjeto;
use App\Mod_plancidades\ViewIniciativaProjeto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IniciativaProjetosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('redirecionar'); 


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulo_plancidades.consultar_iniciativa_projeto');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulo_plancidades.cadastrar_iniciativa_projeto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        //return $request->all();

        $iniciativaProjeto = new IniciativaProjeto;
        $iniciativaProjeto->txt_denominacao_iniciativa = $request->txt_denominacao;
        $iniciativaProjeto->objetivo_ppa_id = $request->objetivoPPA;

        if ($request->bln_pac == 1) {
            $iniciativaProjeto->bln_pac = true;
        } else {
            $iniciativaProjeto->bln_pac = false;
        }

        if ($request->bln_min_ppa == 1) {
            $iniciativaProjeto->bln_min_ppa = true;
        } else {
            $iniciativaProjeto->bln_min_ppa = false;
        }

        $iniciativaProjeto->dsc_iniciativa_projeto = $request->dsc_iniciativa_projeto;
        $iniciativaProjeto->unidade_responsavel_id = $request->unidade_responsavel;
        $iniciativaProjeto->txt_obervacao = $request->txt_obervacao;
        $iniciativaProjeto->txt_objetivo = $request->txt_objetivo;
        $iniciativaProjeto->txt_justificativa = $request->txt_justificativa;
        $iniciativaProjeto->vlr_custo = $request->vlr_custo;
        $iniciativaProjeto->user_id = Auth::user()->id;

        $iniciativaProjeto->created_at = date("Y-m-d h:i:s");

        $salvoSucesso = $iniciativaProjeto->save();

        if ($salvoSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Iniciativa cadastrada com sucesso!");
            return redirect("/plancidades/iniciativa/projeto/show/" . $iniciativaProjeto->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a iniciativa do projeto.");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($iniciativaProjetoId)
    {
        $iniciativaProjeto = ViewIniciativaProjeto::find($iniciativaProjetoId);

        return view('modulo_plancidades.dados_iniciativa_projeto', compact('iniciativaProjeto'));
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
    public function update(Request $request, $id)
    {
        //
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

    public function pesquisarIniciativasProjetos()
    {
        $iniciativasProjetos = ViewIniciativaProjeto::get();

        return view('modulo_plancidades.lista_iniciativa_projeto', compact('iniciativasProjetos'));
    }

    
}
