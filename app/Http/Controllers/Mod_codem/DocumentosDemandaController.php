<?php

namespace App\Http\Controllers\Mod_codem;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mod_codem\Demanda;
use App\Mod_codem\RelacaoDemandas;
use App\Mod_codem\RlcDocumentoDemanda;
use App\Mod_codem\ViewDocumentoDemanda;
use App\Mod_codem\ViewEncaminhamentoDemanda;
use App\Mod_codem\ViewObservacoesDemanda;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DocumentosDemandaController extends Controller
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
    public function documentoNovo(Request $request){       
        
        $demandaID = $request->demanda_id;

        return view('modulo_codem.cadastrar_documento_demanda',compact('demandaID'));    
    } 

    public function salvarDocumento(Request $request){       
        
      //  return $request->all();

      $demandaID = $request->demanda_id;

        DB::beginTransaction();

        $documento = new RlcDocumentoDemanda;
        $documento->demanda_id = $request->demanda_id;
        $documento->tipo_documento_id = $request->tipoDocumento;
        $documento->num_sei = $request->num_sei;
        $documento->txt_descricao_documento = $request->txt_descricao_documento;
        $documento->txt_link_documento_sei = $request->txt_link_documento_sei;
        $documento->user_id = Auth::user()->id;
        $documento->created_at =  date("Y-m-d h:i:s");


        $salvoSucesso = $documento->save();

        if ($salvoSucesso){
            DB::commit();
            flash()->sucesso("Sucesso", "Documento adicionado com sucesso!"); 
            
            
         $ativarAba = 'documento';

         return redirect('codem/demanda/dados/'.$demandaID.'/'. $ativarAba); 
            
         } else {
            DB::rollBack();
             flash()->erro("Erro", "Não foi possível cadastrar a demanda.");   
             return back();          
         }
    
    } 


    public function excluirDocumento($documento){

        $documentoExcluido = RlcDocumentoDemanda::where('id',$documento)->get();
        

        if(count($documentoExcluido) == 0){
            flash()->erro("Erro", "Não existe este documento.");  
            return back(); 
          }

          DB::beginTransaction();

         $documentoExcluido = RlcDocumentoDemanda::find($documento);
         $demandaId = $documentoExcluido->demanda_id;

        $documentoDeletado = $documentoExcluido->delete();

      
       

      if ($documentoDeletado){
              
          DB::commit();
          flash()->sucesso("Sucesso", "Documento excluído com sucesso!"); 

          

       $ativarAba = 'documento';

       return redirect('codem/demanda/dados/'.$demandaId.'/'. $ativarAba); 
          
          
        } else {
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível excluir o documento");  
          return back();  
        }  
        
    }

    

}
