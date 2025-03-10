<?php

namespace App\Http\Controllers\Mod_transferegov;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_transferegov\Programa;
use App\Mod_transferegov\ViewListaProgramas;
use App\Mod_transferegov\ViewProgramasCidades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProgramaController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     //$this->middleware('redirecionar'); 


    // }


    public function index()
    {
        if (auth()->check()){
            $programasTransferegov = ViewListaProgramas::leftJoin('mcid_paineis.tab_programas_cidades','view_lista_programas_2024.cod_programa','=','tab_programas_cidades.cod_programa')
            ->select('view_lista_programas_2024.*', 'tab_programas_cidades.cod_programa as cod_programa_cidades')
            ->orderby('cod_programa','desc')->get();
            return view("modulo_transferegov.listar_programas", compact("programasTransferegov"));
        }else{
            return redirect('/login');
        }
    }

    public function create($cod_programa)
    {
        $programaTransferegov  = ViewListaProgramas::where('cod_programa', $cod_programa)->first();
        return view("modulo_transferegov.registrar_programa", compact("programaTransferegov"));
    }

    public function store(Request $request)
    {
        //return $request;

        DB::beginTransaction();

        $programaTransferegov = ViewListaProgramas::where('cod_programa', $request->cod_programa)->first();

        $programaCidades = new Programa();


        $programaCidades->cod_programa = $request->cod_programa;
        $programaCidades->nom_programa = $programaTransferegov->nom_programa;
        $programaCidades->cod_orgao_sup_programa = $programaTransferegov->cod_orgao_sup_programa;
        $programaCidades->num_ano_disponibilizacao = $programaTransferegov->num_ano_disponiblizacao;
        $programaCidades->dsc_sit_programa = $programaTransferegov->dsc_sit_programa;
        $programaCidades->num_acao_orcamentaria = $programaTransferegov->num_acao_orcamentaria;
        $programaCidades->cod_acao = strtoupper($request->cod_acao);
        $programaCidades->cod_eixo = $request->eixo;
        $programaCidades->cod_subeixo = $request->subeixo;
        $programaCidades->cod_modalidade = $request->modalidade;
        $programaCidades->cod_grupo_modalidade = $request->grupo;
        $programaCidades->id_secretaria = $request->secretaria;
        $programaCidades->cod_resultado_primario = $request->rp;
        $programaCidades->bln_novo_pac = $request->bln_novo_pac;
        $programaCidades->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $programaCidades->save();

        
        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Programa registrado com sucesso!");
            return Redirect::route("transferegov.listarProgramas");
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Houve um erro ao registrar o programa.");
            return back();
        }
        
    }

    public function show($cod_programa)
    {
        if (auth()->check()){
            $programaCidades = ViewProgramasCidades::with('secretaria')->where('cod_programa', $cod_programa)->first();
            return view('modulo_transferegov.show_programa', compact('programaCidades'));
        }else{
            return redirect('/login');
        }
    }

    public function edit($cod_programa)
    {   
        if (auth()->check()){
            $programaTransferegov = ViewListaProgramas::where('cod_programa', $cod_programa)->first();
            $programaCidades = Programa::where('cod_programa', $cod_programa)->first();
            return view('modulo_transferegov.editar_programa', compact('programaTransferegov', 'programaCidades'));
        }else{
            return redirect('/login');
        }
    }

    public function update(Request $request, $id)
    {
        //return $request;
        DB::beginTransaction();

        //return $id;
        $programaCidades = Programa::find($id);

        $programaCidades->cod_acao = $request->cod_acao;
        $programaCidades->cod_eixo = $request->eixo;
        $programaCidades->cod_subeixo = $request->subeixo;
        $programaCidades->cod_modalidade = $request->modalidade;
        $programaCidades->cod_grupo_modalidade = $request->grupo;
        $programaCidades->id_secretaria = $request->secretaria;
        $programaCidades->cod_resultado_primario = $request->rp;
        $programaCidades->bln_novo_pac = $request->bln_novo_pac;


        $dados_salvos = $programaCidades->update();

        if($dados_salvos){
            DB::commit();

            flash()->sucesso("Sucesso", "Programa atualizado com sucesso!");
            return Redirect::route("transferegov.listarProgramas");
        }else{
            DB::rollBack();
            flash()->erro("Erro", "Houve um erro ao atualizar o programa.");
            return back();
        }
    }

    public function destroy()
    {
        
    }

    public function listarProgramas()
    {
        // if (auth()->check()){
        //     return view("modulo_transferegov.listar_programas");
        // }else{
        //     return redirect('/login');
        // }
    }

}
