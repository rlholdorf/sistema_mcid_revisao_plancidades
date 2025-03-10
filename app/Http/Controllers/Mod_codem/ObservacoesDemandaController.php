<?php

namespace App\Http\Controllers\Mod_codem;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mod_codem\Demanda;
use App\Mod_codem\ObservacaoDemanda;
use App\Mod_codem\RelacaoDemandas;
use App\Mod_codem\RlcDocumentoDemanda;
use App\Mod_codem\ViewDocumentoDemanda;
use App\Mod_codem\ViewEncaminhamentoDemanda;
use App\Mod_codem\ViewObservacoesDemanda;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ObservacoesDemandaController extends Controller
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
    public function observacaoNova(Request $request){       
        
        $demandaID = $request->demanda_id;

        return view('modulo_codem.cadastrar_observacao_demanda',compact('demandaID'));    
    } 

    public function salvarObservacao(Request $request){

      //return $request->all();

      $demandaID = $request->demanda_id;

      $observacao = new ObservacaoDemanda;
      $observacao->demanda_id = $request->demanda_id; 
      $observacao->user_id = Auth::user()->id; 
      $observacao->dte_observacao = date("Y-m-d"); 
      $observacao->txt_observacao = $request->txt_observacao; 

      $salvoSucesso = $observacao->save();

      DB::beginTransaction();

      if ($salvoSucesso){
          DB::commit();

          
       $ativarAba = 'observacoes';

          flash()->sucesso("Sucesso", "Observação adicionada com sucesso!"); 
          return redirect('codem/demanda/dados/'.$demandaID.'/'. $ativarAba); 
          
      } else {
         DB::rollBack();
          flash()->erro("Erro", "Não foi possível adicionar o observação.");   
          return back();          
      }
  }

  public function excluirobservacao($observacao){

      $observacaoExcluido = ObservacaoDemanda::where('id',$observacao)->get();
      

      if(count($observacaoExcluido) == 0){
          flash()->erro("Erro", "Não existe este observação.");  
          return back(); 
        }

        DB::beginTransaction();

       $observacaoExcluido = ObservacaoDemanda::find($observacao);
       $demandaId = $observacaoExcluido->demanda_id;

      $observacaoDeletado = $observacaoExcluido->delete();

    
     

    if ($observacaoDeletado){
            
        DB::commit();
        flash()->sucesso("Sucesso", "Observação excluído com sucesso!"); 

        

     $ativarAba = 'observacoes';

     return redirect('codem/demanda/dados/'.$demandaId.'/'. $ativarAba); 
        
        
      } else {
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível excluir o observação.");  
        return back();  
      }  
      
  }
}
