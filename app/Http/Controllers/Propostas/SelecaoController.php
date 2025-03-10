<?php

namespace App\Http\Controllers\Propostas;

use App\EntePublico;
use App\Financeiro\ViewRelatorioGeralRp2;
use App\Financeiro\ViewRelatorioGeralRp8;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DB;


use App\User;

use Config\App;
use App\Http\Flash;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;

use App\Propostas\SelecaoPropostas;
use App\Propostas\CronogramaSelecao;
use App\Propostas\DadosTransferegov;
use App\Propostas\Propostas;
use App\Propostas\RlcItensFinanciaveisProposta;
use App\Propostas\RlcListaPropostasSelecionadas;
use App\Propostas\RlcMotivoCorrecaoProposta;
use App\Propostas\Selecao;
use App\Propostas\ViewItensFinanciaveisPropostas;
use App\Propostas\ViewPropostasCadastradas;
use App\Propostas\ViewPropostasCadastradasUf;
use App\Propostas\ViewPropostasSelecionadas;
use App\Propostas\ViewResultadoSelecao;
use App\Propostas\ViewResumoEmpenhadoPorUf;
use App\Propostas\ViewResumoEmpenhadoPorUfs;
use App\Propostas\ViewSysPropostasTransferegov;
use App\Propostas\ViewSysRelatorioGeralDiscricionarioSistema;
use App\Propostas\ViewSysRelatorioGeralRps;
use App\RlcArquivoUser;
use Illuminate\Support\Facades\Auth;

class SelecaoController extends Controller
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

     public function listaPropostas (){

      $usuario = Auth::user();
      $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');
  
         $cronogramas = CronogramaSelecao::get();

         $wherePropostas = [];

         $wherePropostas[] = ['ente_publico_id', $usuario->ente_publico_id];
         $wherePropostas[] = ['bln_propostas_recebidas_sistema', true];


           $propostas = Propostas::where($wherePropostas)->orderBy('txt_protocolo')->get();

          $propostas->load('situacaoProposta','modalidadeParticipacao','usuario');

          $selecao = Selecao::where('bln_ativa',true)->get();

          $dataAtual = date("Y-m-d");
          
          if(count($propostas)>0){
            return view('modulo_propostas.proposta.ListaPropostasEnte',compact('usuario','cronogramas','propostas','selecao','dataAtual'));
          }else{
            flash()->erro("Erro", "Não existem propostas cadastradas");  
            return back();  
          }
           
  
       
     }
    
     
   public function selecoesAndamento(){
      
    $usuario = Auth::user();  

    $selecao = '';   
        

    $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');


     $propostas = Propostas::where('ente_publico_id', $usuario->ente_publico_id)->get();
     
     $propostas->load('situacaoProposta');
     

       $cronogramas = CronogramaSelecao::get();

       $whereOficio = [];

       $whereOficio[] = ['user_id', $usuario->id];
       $whereOficio[] = ['tipo_arquivo_id',1];

       $dadosArquivoOficio = RlcArquivoUser::where($whereOficio)->get();

       $moduloSistema  = 1;

       return view('modulo_propostas.proposta.SelecoesAndamento',compact('usuario','cronogramas','propostas','dadosArquivoOficio','moduloSistema', 'selecao' ));

   }
       

   public function dadosProposta (Propostas $proposta){

      $propostaCount = Propostas::where('id',$proposta->id)->get();

      $usuario = Auth::user();

      if(count($propostaCount) == 0){
        flash()->erro("Erro", "Essa proposta não existe.");  
        return redirect('/selecao/ente_publico/propostas');  

      }elseif($usuario->ente_publico_id != $proposta->ente_publico_id){
        flash()->erro("Erro", "Usuário sem premissão para acessar essa proposta");  
        return redirect('/selecao/ente_publico/propostas');  

      }

      $proposta->load('selecao','situacaoProposta','usuario');
  
      
    
      $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();
      $cpfUsuario = $usuario->txt_cpf_usuario;
      $entePublicoId = $usuario->ente_publico_id;

      $moduloSistema = 1;
      

      if($proposta->modalidade_participacao_id == 3){
        return view('modulo_propostas.proposta.semob.DadosPropostaSemob',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }else if($proposta->modalidade_participacao_id == 2){
        return view('modulo_propostas.proposta.snsa.DadosPropostaSnsa',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }else if($proposta->modalidade_participacao_id == 1){
        return view('modulo_propostas.proposta.sndum.DadosPropostaSndum',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }else if($proposta->modalidade_participacao_id == 5){
        return view('modulo_propostas.proposta.mcmv.DadosPropostaMcmv',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }

    
   }


   public function consultarPropostas(){

    return view('modulo_propostas.proposta.ConsultarPropostas');

   }

   

   public function pesquisarPropostas(Request $request){
    
    
    //return $request->all();

    if($request->numPropostaTransf){
      $proposta = DadosTransferegov::where('num_proposta_transferegov',$request->numPropostaTransf)->first();

        if(empty($proposta)){
          flash()->erro("Erro", "Essa proposta não existe.");  
          return back();  

        }else{
          return redirect('/admin/selecao/proposta/'.$proposta->proposta_id);  
        }

    }else if($request->txt_protocolo){
        $proposta = Propostas::where('id',$request->txt_protocolo)->first();

      if(empty($proposta)){
        flash()->erro("Erro", "Essa proposta não existe.");  
        return back();  
  
      }else{
        return redirect('/admin/selecao/proposta/'.$proposta->id);  
      }

      }else{
          $where = [];

          //return $request->all();


          if($request->estado){
              $where[] = ['id_uf', $request->estado];        
          }

          if($request->municipio){
              $where[] = ['municipio_id', $request->municipio];        
          }

          if($request->selecao){
            $where[] = ['selecao_id', $request->selecao];        
          }

          if($request->situacaoProposta){
            $where[] = ['situacao_proposta_id', $request->situacaoProposta];        
          }

          if($request->recebidasSistema){
            $where[] = ['bln_propostas_recebidas_sistema', $request->recebidasSistema];        
          }

         
          if($request->entepublico){
            $where[] = ['ente_publico_id', str_pad($request->entepublico, 14, "0", STR_PAD_LEFT)];        
          }

            $propostas = ViewPropostasCadastradas::where($where)->get();

          if(count($propostas) == 0){
            flash()->erro("Erro", "Não existem propostas para os parâmetros selecionados.");  
            return back();  
      
          }


          return view('modulo_propostas.proposta.ListaPropostasApresentadas',compact('propostas'));

    }

    

   }

   
   public function dadosPropostaAdmin (Propostas $proposta){

     $propostaCount = Propostas::where('id',$proposta->id)->get();

    


    $usuario = Auth::user();

    if(count($propostaCount) == 0){
      flash()->erro("Erro", "Essa proposta não existe.");  
      return redirect('/selecao/ente_publico/propostas');  

    }

     $propostaSelecionada = ViewPropostasSelecionadas::where('proposta_id', $proposta->id)->first();

    $dadosTransfereGov = DadosTransferegov::where('proposta_id', $proposta->id)->get();

    $totalValorTransferegov = 0;
    if(count($dadosTransfereGov)>0){
      foreach($dadosTransfereGov as $dados){
        $totalValorTransferegov += $dados->vlr_proposta_transferegov;
      }
    }
    
    

    $propostaAntiga = '';
    $propostaCancelada = '';
    $itensFinanciveisCancelados = '';
    $motivoCorrecao = '';

    if($proposta->situacao_proposta_id == 10){

      $motivoCorrecao = RlcMotivoCorrecaoProposta::where('proposta_id_nova', $proposta->id)->firstOrFail();
      $motivoCorrecao->load('motivoCorrecao');
      $propostaCancelada = ViewPropostasCadastradas::where('proposta_id',$motivoCorrecao->proposta_id_corrigida)->firstOrFail();
      $itensFinanciveisCancelados = ViewItensFinanciaveisPropostas::where('proposta_id',$propostaCancelada->proposta_id)->get();
    }

      $proposta->load('selecao','situacaoProposta','usuario','entePublico.municipio.uf');

    
  
     $itensFinanciveis = ViewItensFinanciaveisPropostas::where('proposta_id',$proposta->id)->get();

    return view('modulo_propostas.proposta.DadosProposta',compact('usuario','proposta','itensFinanciveis','motivoCorrecao','propostaCancelada',
                                                                  'itensFinanciveisCancelados','dadosTransfereGov','totalValorTransferegov','propostaSelecionada'));

  }

   
  public function excluirProposta ($proposta){

     $usuario = Auth::user();
    $userLog = $usuario->id;
    $whereProposta = [];
  
      $whereProposta[] = ['id', $proposta];
      $whereProposta[] = ['user_id', $userLog];

    //return $whereProposta;

      $proposta = Propostas::where($whereProposta)->get();

      if(count($proposta) == 0){
        flash()->erro("Erro", "Não existe proposta.");  
        return back(); 
      }


      $proposta = Propostas::where($whereProposta)->firstOrFail();

      
      if($proposta->user_id != $userLog){
        flash()->erro("Erro", "O usuário não tem permissão de excluir a proposta.");  
        return back(); 
      }
      DB::beginTransaction();

      
      $proposta = Propostas::find($proposta->id);
      $proposta->situacao_proposta_id = 8;
    $propostaDeletada = $proposta->update();


      if ($propostaDeletada){
        /*
        $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id', $proposta->id)->get();
        foreach($itensFinanciveis as $item){
          $itensdeletar = RlcItensFinanciaveisProposta::find($item->id);
          $itensdeletar->delete();
        }
        */

        DB::commit();
        flash()->sucesso("Sucesso", "Proposta excluída com sucesso!"); 

        $proposta = Propostas::where($whereProposta)->get();
        if(count($proposta) > 0){
            return back(); 
        }else{
          return redirect('/home_ente_publico');
        }
      } else {
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível excluir a proposta.");  
        return back();  
      }  


    }

    public function consultarResultados(){

      $selecaoProposta = SelecaoPropostas::orderBy('dte_resultado')->get();
 
    return view('modulo_propostas.proposta.ConsultarResultado',compact('selecaoProposta'));


    }

    
    public function listaResultado($arquivo){

       $listaResultado = ViewResultadoSelecao::where('selecao_proposta',$arquivo)->orderBy('dte_resultado')->get();
      $selecaoPropostas = SelecaoPropostas::find($arquivo);


     return view('modulo_propostas.proposta.ListaPropostasResultado',compact('listaResultado','selecaoPropostas'));


    }


    public function pesquisarResultado(Request $request){

            $where = [];
  
           // return $request->all();
  
  
            if($request->estado){
                $where[] = ['id_uf', $request->estado];        
            }
  
            if($request->municipio){
                $where[] = ['municipio_id', $request->municipio];        
            }
  
            if($request->selecao){
              $where[] = ['selecao_id', $request->selecao];        
            }

            if($request->acaoPrograma){
              $where[] = ['acao_programa_id', $request->acaoPrograma];        
            }
  
  
            $propostas = ViewResultadoSelecao::where($where)->get();

  
            if(count($propostas) == 0){
              flash()->erro("Erro", "Não existem propostas para os parâmetros selecionados.");  
              return back();  
        
            }
  
  
            return view('modulo_propostas.proposta.ListaPropostasSelecionadas',compact('propostas'));
      
  
     }

     public function consultarPropostasSelecionadas(){

      return view('modulo_propostas.proposta.admin.ConsultarPropostasSelecionadas');
  }


  public function pesquisarPropostasSelecionadas(Request $request){

      $where = [];

      $where[] = ['situacao_proposta_id', 5];  

            //return $request->all();
  
  
            if($request->estado){
                $where[] = ['id_uf', $request->estado];        
            }
  
            if($request->municipio){
                $where[] = ['municipio_id', $request->municipio];        
            }
           
            if($request->entepublico){
              $where[] = ['ente_publico_id', str_pad($request->entepublico, 14, "0", STR_PAD_LEFT)];        
            }
  
               $propostas = ViewPropostasSelecionadas::where($where)->get();
  
            if(count($propostas) == 0){
              flash()->erro("Erro", "Não existem propostas para os parâmetros selecionados.");  
              return back();  
        
            }
  
  
            return view('modulo_propostas.proposta.admin.ListaPropostasSelecionadas',compact('propostas'));
  
          }


     public function SelecionarPropostas (){

       $selecaoProposta = SelecaoPropostas::orderBy('id')->get();

       $numSelecaoAndamento = 0;

       foreach($selecaoProposta as $dados){
          if(!$dados->bln_selecao_concluida){
            $numSelecaoAndamento += 1;
          }
       }
       

       $selecaoProposta->load('user');

      return view('modulo_propostas.proposta.admin.SelecionarProposta',compact('selecaoProposta','numSelecaoAndamento'));
  
    }

    public function listaPropostasSelecionadas($selecaoPropostas){

      //return $selecaoPropostas;
       $selecaoProposta = SelecaoPropostas::where('id',$selecaoPropostas)->firstOrFail();
      $selecaoProposta->load('user');

      $propostas = ViewPropostasSelecionadas::where('selecao_proposta_id', $selecaoProposta->id)->get();

     return view('modulo_propostas.proposta.admin.DadosSelecaoPropostas',compact('selecaoProposta','propostas'));
 
   }

   public function novaSelecaoPropostas(){
    
    DB::beginTransaction();

    $usuario = Auth::user();

     $selecaoProposta = SelecaoPropostas::where('bln_selecao_concluida',false)->get();
   // return count($selecaoProposta);

    if(count($selecaoProposta) > 0){
      flash()->erro("Erro", "Já existe uma seleção em andamento. Favor concluir a seleção antes de iniciar uma nova seleção");  
      return back();  

    }

    $selecaoProposta = new SelecaoPropostas;
    $selecaoProposta->user_id = $usuario->id;
    $selecaoProposta->num_propostas = 0;
    
    $selecaoProposta->created_at = Date("Y-m-d h:i:s");
               
    $salvoComSucesso = $selecaoProposta->save();
    
    
     $selecaoProposta->load('user');

    

    if (!$salvoComSucesso){            
      DB::rollBack();
      flash()->erro("Erro", "Não foi possível criar uma seleção.");            
      return back(); 
  } else {
      DB::commit();
      flash()->sucesso("Sucesso", "Seleção criada com sucesso!"); 
      return redirect('/admin/propostas/selecionadas/lista/'.$selecaoProposta->id);
  }  
  

   
   
  }


  public function adicionarProposta(Request $request){

   // return $request->all();

    DB::beginTransaction();

   $proposta = RlcListaPropostasSelecionadas::where('proposta_id',$request->proposta_id)->get();
    if(count($proposta)>0){            
      DB::rollBack();
      flash()->erro("Erro", "Proposta já foi selecionada. Escolha outra proposta.");            
      return back(); 
    }

     $usuario = Auth::user();

     $proposta = Propostas::find($request->proposta_id);

     $listaSelecaoProposta = new RlcListaPropostasSelecionadas;
     $listaSelecaoProposta->proposta_id = $request->proposta_id;
     $listaSelecaoProposta->selecao_proposta_id = $request->selecao_proposta_id;
     $listaSelecaoProposta->acao_programa_id = $request->acao;
     $listaSelecaoProposta->txt_cnpj = $proposta->ente_publico_id;

     $vlr_repasse = floatval(str_replace("." , "" ,$request->vlr_repasse)) ;
     $vlr_tarifa = 0 ;
     $vlr_final_transferegov = 0 ;

     if(($vlr_repasse > 238856) && ($vlr_repasse < 777450)){
          $vlr_tarifa = (($vlr_repasse-3500)* 0.03100775) + 3500;
      }else  if(($vlr_repasse >= 777450) && ($vlr_repasse < 1560500)){
          $vlr_tarifa = (($vlr_repasse-3500)* 0.03660886) + 3500;
      }else  if(($vlr_repasse >= 1569500) && ($vlr_repasse < 83523500)){
          $vlr_tarifa = (($vlr_repasse-3500)* 0.042145594) + 3500;
      }else  if($vlr_repasse >= 83523500){
          $vlr_tarifa = (($vlr_repasse-3500)* 0.0421455939) + 3500;
      }else{
          $vlr_tarifa = 0;
      }
      
     
     $listaSelecaoProposta->vlr_repasse = floatval($vlr_repasse);
     $listaSelecaoProposta->vlr_tarifa = floatval(ceil($vlr_tarifa));
     $listaSelecaoProposta->vlr_final_transferegov = floatval($vlr_repasse-ceil($vlr_tarifa));

     $listaSelecaoProposta->created_at = Date("Y-m-d h:i:s");
               
     $salvoComSucesso = $listaSelecaoProposta->save();
     
     if (!$salvoComSucesso){            
       DB::rollBack();
       flash()->erro("Erro", "Não foi possível adicionar a proposta.");            
       return back(); 
   } else {

    $numProposta = RlcListaPropostasSelecionadas::where('selecao_proposta_id',$request->selecao_proposta_id)->count();
    $propostaAtualizada = SelecaoPropostas::where('id',$request->selecao_proposta_id)->update(['num_propostas' => $numProposta]);

       DB::commit();
       flash()->sucesso("Sucesso", "Proposta adicionada com sucesso!"); 
       return redirect('/admin/propostas/selecionadas/lista/'.$request->selecao_proposta_id);
   }  

  }

  public function excluirPropostaSelecionada ($proposta){

    $whereProposta = [];
  
      $whereProposta[] = ['id', $proposta];

    //return $whereProposta;

      $proposta = RlcListaPropostasSelecionadas::where($whereProposta)->get();

      if(count($proposta) == 0){
        flash()->erro("Erro", "Não existe proposta.");  
        return back(); 
      }


      DB::beginTransaction();

        $proposta = RlcListaPropostasSelecionadas::where($whereProposta)->firstOrFail();
         $numProposta = RlcListaPropostasSelecionadas::where('selecao_proposta_id',$proposta->selecao_proposta_id)->count();

      $propostaDeletada = $proposta->delete();

      if ($propostaDeletada){

        
        $propostaAtualizada = SelecaoPropostas::where('id',$proposta->selecao_proposta_id)->update(['num_propostas' => $numProposta-1]);

        DB::commit();
        flash()->sucesso("Sucesso", "Proposta excluída com sucesso!"); 
        return back(); 
      } else {
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível excluir a proposta.");  
        return back();  
      }  

   }

   public function concluirSelecao(Request $request){

   // return $request->all();

    DB::beginTransaction();

     $selecaoProposta = SelecaoPropostas::find($request->selecao_proposta_id);

     if($selecaoProposta->bln_concluida){
      flash()->erro("Erro: Seleçäo já Concluída", "Não foi possível concluir a seleçäo.");  
      return back(); 
     }
     $proposta = RlcListaPropostasSelecionadas::where('selecao_proposta_id', $request->selecao_proposta_id )->get();

    $selecaoProposta->bln_selecao_concluida = true;
    $selecaoProposta->dte_resultado = Date("Y-m-d h:i:s");
    $selecaoProposta->num_propostas = count($proposta);

    $atualizadaComSucesso = $selecaoProposta->update();

    foreach($proposta as $dados){

      $propostaAtualizada = Propostas::where('id',$dados->proposta_id)->update(['situacao_proposta_id' => 5]);
      if(!$propostaAtualizada){
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível concluir a seleção.");  
        return back();  
      }
    }

    if($atualizadaComSucesso){
      DB::commit();
      flash()->sucesso("Sucesso", "Seleção concluída com sucesso!"); 
      return back(); 
    } else {
      DB::rollBack();
      flash()->erro("Erro", "Não foi possível concluir a seleção.");  
      return back();  
    }  

   }


   

   public function excluirSelecaoProposta ($selecao){

    $whereProposta = [];
  
       $whereProposta[] = ['selecao_proposta_id', $selecao];

    //return $whereProposta;

       $selecao = SelecaoPropostas::find($selecao);

      if(!$selecao){
        flash()->erro("Erro", "Não existe proposta.");  
        return back(); 
      }


      DB::beginTransaction();

         $propostas = RlcListaPropostasSelecionadas::where($whereProposta)->get();

        if(count($propostas)>0){
          foreach($propostas as $dados){

            $propostaDeletada = RlcListaPropostasSelecionadas::where('proposta_id',$dados->proposta_id)->delete();
            if(!$propostaDeletada){
              DB::rollBack();
              flash()->erro("Erro", "Não foi possível excluir a seleção.");  
              return back();  
            }
          }
        }

        $propostas = RlcListaPropostasSelecionadas::where($whereProposta)->get();

        if(count($propostas) == 0){

          $selecaoExcluidaSucesso = $selecao->delete();

        }
    
        if($selecaoExcluidaSucesso){
          DB::commit();
          flash()->sucesso("Sucesso", "Seleção excluída com sucesso!"); 
          return back(); 
        } else {
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível exclui a seleção.");  
          return back();  
        }  
        
    }


    
    public function cancelarPropostaAdmin ($proposta){

      $whereProposta = [];
    
       $whereProposta[] = ['proposta_id', $proposta];

         $proposta = Propostas::find($proposta);
           $itensFinanciveis = ViewItensFinanciaveisPropostas::where('proposta_id',$proposta->id)->get();

         $usuario = Auth::user();
         
         return view('modulo_propostas.proposta.admin.CorrecaoProposta',compact('proposta','itensFinanciveis','usuario'));


    }

    public function corrigirProposta (Request $request){

    //return $request->all();

    $propostaCorrigida = Propostas::find($request->proposta_id_corrigida);
     $selecao = Selecao::find($request->selecao);

    $usuario = Auth::user();

    DB::beginTransaction();

    $proposta = new Propostas;
    $proposta->ente_publico_id = $propostaCorrigida->ente_publico_id;
    $proposta->user_id = $usuario->id;
    //$proposta->municipio_id = $request->municipio;
    //$proposta->uf_id = $request->estado;
    $proposta->selecao_id = $selecao->id;
    $proposta->modalidade_participacao_id = $selecao->modalidade_participacao_id;
    $proposta->dsc_obj_intervencao = $propostaCorrigida->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval($propostaCorrigida->vlr_intervencao) ;
    $proposta->dsc_justificativa = $propostaCorrigida->dsc_justificativa;
    $proposta->dsc_problema_resolver = $propostaCorrigida->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $propostaCorrigida->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $propostaCorrigida->bln_projeto_basico;
    $proposta->situacao_proposta_id = 10;  
    $proposta->created_at = Date("Y-m-d h:i:s");


    $salvoComSucesso = $proposta->save();

    $protocolo = $proposta->id .'/'. Date("Y") .'-'. $request->selecao_id .'3';
    $proposta->txt_protocolo = str_pad($protocolo  , 20 , '0' , STR_PAD_LEFT);
    $salvoComSucesso = $proposta->save();


       
        $salvouItensFinanciaveis = false;
        $itensFinanciveis = $request->itens_financiaveis;
        foreach($request->itens_financiaveis as $item){
          $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
        }

        $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();
      

        $motivoCorrecao = new RlcMotivoCorrecaoProposta;
        $motivoCorrecao->motivo_correcao_id = $request->motivoCorrecao;
        $motivoCorrecao->proposta_id_corrigida = $request->proposta_id_corrigida;
        $motivoCorrecao->proposta_id_nova = $proposta->id;
        $motivoCorrecao->dte_cancelamento = Date("Y-m-d h:i:s");
        $motivoCorrecao->user_id = $usuario->id;

        $salvoMotivo = $motivoCorrecao->save();
        


      if ($salvoComSucesso && $salvouItensFinanciaveis &&  $salvoMotivo){
        DB::commit();
        flash()->sucesso("Sucesso", "Proposta cadastrada com sucesso!"); 
      
      return redirect('/admin/selecao/proposta/'.$proposta->id);
         
        
    } else {
      DB::rollBack();
      flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
      return back();  
    }  


    
    }

    public function salvarDadosTransferegov (Request $request){

      //return $request->all();
      $whereProposta = [];
    
      $whereProposta[] = ['txt_rp','=' ,'RP2'];
      $whereProposta[] = ['prop_num_proposta', trim($request->num_proposta_transferegov)];
      
     $propostaTransf = ViewSysPropostasTransferegov::where($whereProposta)->get();

      if(count($propostaTransf) == 0){
        flash()->erro("Erro", "Proposta inexistente ou não pertence ao RP2.");  
          return back();  
        
      }

      $propostaSelecionada = DadosTransferegov::where('num_proposta_transferegov', $request->num_proposta_transferegov)->get();

      /*
      if(count($propostaSelecionada) > 0){
        flash()->erro("Erro", "Já existe uma proposta cadastrada com esse número.");  
          return back();  
        
      }
*/
      DB::beginTransaction();

      $dadosTransferegov = new DadosTransferegov;
      $dadosTransferegov->proposta_id =  $request->proposta_id;
      $dadosTransferegov->num_proposta_transferegov =  trim($request->num_proposta_transferegov);
      $dadosTransferegov->vlr_proposta_transferegov = $request->vlr_proposta_transferegov;

      $salvoDadosTransferegov = $dadosTransferegov->save();
        


        if ($salvoDadosTransferegov){
            DB::commit();
            flash()->sucesso("Sucesso", "Proposta cadastrada com sucesso!");       
            return redirect('/admin/selecao/proposta/'.$request->proposta_id);         
            
        } else {
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
          return back();  
        }  
  }

  public function excluirPropostaTransferegov ($propostaTransf){

    

       $proposta = DadosTransferegov::where('id', $propostaTransf)->get();

     if(count($proposta) == 0){
       flash()->erro("Erro", "Não existe proposta.");  
       return back(); 
     }

     DB::beginTransaction();

     
      $proposta = DadosTransferegov::where('id', $propostaTransf)->first();
     
      $propostaId = $proposta->proposta_id;

   $propostaDeletada = $proposta->delete();

      if ($propostaDeletada){
              
          DB::commit();
          flash()->sucesso("Sucesso", "Proposta excluída com sucesso!"); 

        

          return redirect('/admin/selecao/proposta/'.$propostaId);
          
        } else {
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível excluir a proposta.");  
          return back();  
        }  


   }

   public function consultarPropostasTransferegov(){

        return view('modulo_propostas.proposta.admin.ConsultarPropostasTransferegov');

   }

   public function pesquisarPropostasTransferegov(Request $request){

        //return $request->all();

      $where = [];
      $whereOr = [];
      
        if($request->estado){
            $where[] = ['id_uf', $request->estado];      
             $estado = Uf::where('id', $request->estado)->firstOrFail();
            $whereOr[] = ['uf_transferegov', $estado->txt_sigla_uf];      

            
        }

        if($request->municipio){
            $where[] = ['municipio_id', $request->municipio];        
        }
        
        if($request->entepublico){
          $where[] = ['identif_proponente_transferegov', str_pad($request->entepublico, 14, "0", STR_PAD_LEFT)];        
        }

        if($request->acaoPrograma){
            $where[] = ['acao_orcamentaria', $request->acaoPrograma];        
        }

        if($request->modalidadeParticipacao){
          $where[] = ['modalidade_participacao_id', $request->modalidadeParticipacao];        
        }

        if($request->situacaoProposta){
          $where[] = ['situacao_proposta_id', $request->situacaoProposta];        
        }

        if($request->programaSiconv){
          $where[] = ['programa_sistema', $request->programaSiconv];        
        }

        if($request->situacaoPropostaAjustada){
          $where[] = ['situacao_ajustada', $request->situacaoPropostaAjustada];        
        }

        $validaCnpj = 'Nào';
        if($request->sistemaVsTransferegov){
          $where[] = ['sistema_x_transferegov', $request->sistemaVsTransferegov];  
          if($request->validaCnpj == 'Verificar' || $request->sistemaVsTransferegov == 'Proposta Não Selecionada e Cadastrada no TransfereGOV')
              $validaCnpj = 'Sim';      
        }

       
        if($request->validaCnpj){
          $where[] = ['valida_cnpj', $request->validaCnpj];        
          if($request->validaCnpj == 'Verificar' || $request->sistemaVsTransferegov == 'Proposta Não Selecionada e Cadastrada no TransfereGOV')
              $validaCnpj = 'Sim';
        }

       // return $where;

        $propostasTransferegov = ViewSysRelatorioGeralDiscricionarioSistema::where($where)
                      ->get();

        if(count($propostasTransferegov) == 0){
          flash()->erro("Erro", "Não existem propostas para os parâmetros selecionados.");  
          return back(); 
        }

        return view('modulo_propostas.proposta.admin.ListaPropostasTransferegov',compact('propostasTransferegov','validaCnpj'));

}
    


public function pesquisarProponenteTransferegov(Request $request){

  //return $request->all();

     $propostaTransferegov = ViewSysRelatorioGeralDiscricionarioSistema::where('num_proposta_transferegov',$request->num_proposta_transferegov)->first();
    $cnpjProponente = $propostaTransferegov->identif_proponente_transferegov;

     $numPropTransferegov = $propostaTransferegov->num_proposta_transferegov;

    $propostas = ViewPropostasCadastradas::where('ente_publico_id',$cnpjProponente)->orderBy('situacao_proposta_id')->get();

     $entePublico = EntePublico::find($cnpjProponente);

       $selecaoProposta = SelecaoPropostas::where('bln_selecao_concluida',false)->first();
      
      $selecaoPropostaID = 0;
      if(!empty($selecaoProposta)){
        $selecaoPropostaID = $selecaoProposta->id;
        $selecaoProposta->load('user');
      }

    //  return $selecaoProposta;

      return view('modulo_propostas.proposta.admin.DadosPropostaTransferegovVerificar', compact('propostas','selecaoPropostaID','propostaTransferegov','entePublico','selecaoProposta','numPropTransferegov'));
    }

    public function adicionarPropostaTrasferegov(Request $request){

      return  'teste';
        return $request->all();

    }

    public function consultarExecucaoTransferegov(){

      return view('modulo_propostas.proposta.admin.ConsultarExecucaoTransferegov');
    }
    
    public function pesquisarExecucaoTransferegov(Request $request){

//return $request->all();

      
      $where = [];
     // $where[] = ['num_proposta_transferegov', 'IS NOT NULL'];      
      
     $acaoSelecionada = 'false';
        if($request->estado){
           
              $estado = Uf::where('id', $request->estado)->firstOrFail(); 
             $where[] = ['uf_transferegov', $estado->txt_sigla_uf];     
             $acaoSelecionada = 'false'; 
        }

        if($request->municipio){
          $municipio = Municipio::where('id',$request->municipio)->first();
            $where[] = ['cod_municipio_ibge_transferegov', $municipio->cod_ibge_7_dig];  
            $acaoSelecionada = 'false';      
        }
        

        if($request->entepublico){
          $where[] = ['identif_proponente_transferegov', str_pad($request->entepublico, 14, "0", STR_PAD_LEFT)];        
          $acaoSelecionada = 'false';
        }

        

        if($request->acaoPrograma){
            $where[] = ['acao_orcamentaria', $request->acaoPrograma];        
            $acaoSelecionada = 'true';
        }
      
        if($request->programaSiconv){
          $where[] = ['programa_transferegov', $request->programaSiconv];   
          $acaoSelecionada = 'true';     
        }

        if($request->situacaoPropostaAjustada){
          $where[] = ['situacao_ajustada', $request->situacaoPropostaAjustada];  
          $acaoSelecionada = 'true';      
        }

     // return $where;
        $titulo = 'Execução Transferegov';
        $subtitulo1 = '';

        $totalPropostaTransferegov = [
          'total_propostas'=> 0, 
          'total_vlr_intervencao'=> 0,                            
          'total_vlr_intervencao_ac'=> 0,
          'total_vlr_intervencao_al'=> 0,
          'total_vlr_intervencao_am'=> 0,
          'total_vlr_intervencao_ap'=> 0,
          'total_vlr_intervencao_ba'=> 0,
          'total_vlr_intervencao_ce'=> 0,
          'total_vlr_intervencao_df'=> 0,
          'total_vlr_intervencao_es'=> 0,
          'total_vlr_intervencao_go'=> 0,
          'total_vlr_intervencao_ma'=> 0,
          'total_vlr_intervencao_mg'=> 0,
          'total_vlr_intervencao_ms'=> 0,
          'total_vlr_intervencao_mt'=> 0,
          'total_vlr_intervencao_ms'=> 0,
          'total_vlr_intervencao_pa'=> 0,
          'total_vlr_intervencao_pb'=> 0,
          'total_vlr_intervencao_pe'=> 0,
          'total_vlr_intervencao_pi'=> 0,
          'total_vlr_intervencao_pr'=> 0,
          'total_vlr_intervencao_rj'=> 0,
          'total_vlr_intervencao_rn'=> 0,
          'total_vlr_intervencao_ro'=> 0,
          'total_vlr_intervencao_rr'=> 0,
          'total_vlr_intervencao_rs'=> 0,
          'total_vlr_intervencao_sc'=> 0,
          'total_vlr_intervencao_se'=> 0,
          'total_vlr_intervencao_sp'=> 0,
          'total_vlr_intervencao_to'=> 0,

         ];

         //return $acaoSelecionada;

        if($acaoSelecionada == 'false'){
          $propostasTransferegov = ViewSysRelatorioGeralDiscricionarioSistema::selectRaw('uf_transferegov,municipio_transferegov, COUNT(DISTINCT num_proposta_transferegov) AS qtd_propostas, count(DISTINCT identif_proponente_transferegov) as qtd_cpnj,acao_orcamentaria, programa_transferegov, situacao_ajustada, SUM(vlr_repasse_transferegov) AS vlr_repasse_transferegov' )
                          ->where($where)                        
                          ->groupBy('uf_transferegov','municipio_transferegov','acao_orcamentaria','programa_transferegov', 'situacao_ajustada')
                          ->orderBy('uf_transferegov','ASC')
                          ->orderBy('municipio_transferegov','ASC')
                          ->orderBy('acao_orcamentaria','ASC')
                          ->get();
          
        }else{
              $propostasTransferegov = ViewResumoEmpenhadoPorUfs::where($where)
                        ->orderBy('acao_orcamentaria','ASC')
                        ->get();

                       
          foreach($propostasTransferegov as $valor){
               
            $totalPropostaTransferegov['total_propostas'] += $valor->num_propostas;
            $totalPropostaTransferegov['total_vlr_intervencao'] += $valor->vlr_total;
            $totalPropostaTransferegov['total_vlr_intervencao_ac'] += $valor->vlr_intervencao_ac;
            $totalPropostaTransferegov['total_vlr_intervencao_al'] += $valor->vlr_intervencao_al;
            $totalPropostaTransferegov['total_vlr_intervencao_am'] += $valor->vlr_intervencao_am;
            $totalPropostaTransferegov['total_vlr_intervencao_ap'] += $valor->vlr_intervencao_ap;
            $totalPropostaTransferegov['total_vlr_intervencao_ba'] += $valor->vlr_intervencao_ba;
            $totalPropostaTransferegov['total_vlr_intervencao_ce'] += $valor->vlr_intervencao_ce;
            $totalPropostaTransferegov['total_vlr_intervencao_df'] += $valor->vlr_intervencao_df;
            $totalPropostaTransferegov['total_vlr_intervencao_es'] += $valor->vlr_intervencao_es;
            $totalPropostaTransferegov['total_vlr_intervencao_go'] += $valor->vlr_intervencao_go;
            $totalPropostaTransferegov['total_vlr_intervencao_ma'] += $valor->vlr_intervencao_ma;
            $totalPropostaTransferegov['total_vlr_intervencao_mg'] += $valor->vlr_intervencao_mg;
            $totalPropostaTransferegov['total_vlr_intervencao_ms'] += $valor->vlr_intervencao_ms;
            $totalPropostaTransferegov['total_vlr_intervencao_mt'] += $valor->vlr_intervencao_mt;                            
            $totalPropostaTransferegov['total_vlr_intervencao_pa'] += $valor->vlr_intervencao_pa;
            $totalPropostaTransferegov['total_vlr_intervencao_pb'] += $valor->vlr_intervencao_pb;
            $totalPropostaTransferegov['total_vlr_intervencao_pe'] += $valor->vlr_intervencao_pe;
            $totalPropostaTransferegov['total_vlr_intervencao_pi'] += $valor->vlr_intervencao_pi;
            $totalPropostaTransferegov['total_vlr_intervencao_pr'] += $valor->vlr_intervencao_pr;
            $totalPropostaTransferegov['total_vlr_intervencao_rj'] += $valor->vlr_intervencao_rj;
            $totalPropostaTransferegov['total_vlr_intervencao_rn'] += $valor->vlr_intervencao_rn;
            $totalPropostaTransferegov['total_vlr_intervencao_ro'] += $valor->vlr_intervencao_ro;
            $totalPropostaTransferegov['total_vlr_intervencao_rr'] += $valor->vlr_intervencao_rr;
            $totalPropostaTransferegov['total_vlr_intervencao_rs'] += $valor->vlr_intervencao_rs;
            $totalPropostaTransferegov['total_vlr_intervencao_sc'] += $valor->vlr_intervencao_sc;
            $totalPropostaTransferegov['total_vlr_intervencao_se'] += $valor->vlr_intervencao_se;
            $totalPropostaTransferegov['total_vlr_intervencao_sp'] += $valor->vlr_intervencao_sp;
            $totalPropostaTransferegov['total_vlr_intervencao_to'] += $valor->vlr_intervencao_to;
          }

           
          
        }

        if($request->entepublico){
          $ententePublico = EntePublico::find(str_pad($request->entepublico, 14, "0", STR_PAD_LEFT));        
          $titulo = $ententePublico->txt_ente_publico;
          $subtitulo1 = trim($municipio->ds_municipio) . '-' . $estado->txt_sigla_uf;
        }elseif($request->municipio){
          $titulo = trim($municipio->ds_municipio) . '-' . $estado->txt_sigla_uf;
        }elseif($request->estado){
          $titulo = $estado->txt_uf;
        }

         
        if(count($propostasTransferegov) == 0){
          flash()->erro("Erro", "Não existem dados para os parâmetros selecionados.");  
          return back(); 
        }

        return view('modulo_propostas.proposta.admin.ListaExecucaoTransferegov',
                compact('propostasTransferegov','acaoSelecionada','titulo','subtitulo1','totalPropostaTransferegov'));

    }

    public function consultarPropostasRps(){
      return view('modulo_propostas.proposta.admin.ConsultarSituacaoPropostasRps');
    }

    public function pesquisarPropostasRps(Request $request){

     // return $request->all();

      $where = [];

      if($request->situacaoProposta){
        $where[] = ['situacao_ajustada', $request->situacaoProposta];  
      }

      if($request->estado){
        $where[] = ['prop_sgl_uf_proponente', $request->estado];  
      }

     

      if($request->txt_rp == 'RP2'){
        $dadosRP2 = ViewRelatorioGeralRp2::where($where)->get();
        $dadosRP8 = '';
      }elseif($request->txt_rp == 'RP8'){
        $dadosRP2 = '';
        $dadosRP8  = ViewRelatorioGeralRp8::where($where)->get();
      }else{
       $dadosRP2 = ViewRelatorioGeralRp2::where($where)->get();
        $dadosRP8  = ViewRelatorioGeralRp8::where($where)->get();
      }

      return $dadosRP2;

      return view('modulo_propostas.proposta.admin.RelatorioSituacaoPropostasRps');
    }

    public function relPropostasUf(){

      $propostasCadastradas = ViewPropostasCadastradasUf::get();

      $totalProposta = ['total_propostas'=> 0, 
                        'total_intervencao'=> 0,
                        'total_propostas_sistema'=> 0, 
                        'total_intervencao_sistema'=> 0,
                        'total_propostas_forms'=> 0, 
                        'total_intervencao_forms'=> 0,
                        'total_num_propostas_ac'=> 0,
                        'total_num_propostas_al'=> 0,
                        'total_num_propostas_am'=> 0,
                        'total_num_propostas_ap'=> 0,
                        'total_num_propostas_ba'=> 0,
                        'total_num_propostas_ce'=> 0,
                        'total_num_propostas_df'=> 0,
                        'total_num_propostas_es'=> 0,
                        'total_num_propostas_go'=> 0,
                        'total_num_propostas_ma'=> 0,
                        'total_num_propostas_mg'=> 0,
                        'total_num_propostas_ms'=> 0,
                        'total_num_propostas_mt'=> 0,
                        'total_num_propostas_ms'=> 0,
                        'total_num_propostas_pa'=> 0,
                        'total_num_propostas_pb'=> 0,
                        'total_num_propostas_pe'=> 0,
                        'total_num_propostas_pi'=> 0,
                        'total_num_propostas_pr'=> 0,
                        'total_num_propostas_rj'=> 0,
                        'total_num_propostas_rn'=> 0,
                        'total_num_propostas_ro'=> 0,
                        'total_num_propostas_rr'=> 0,
                        'total_num_propostas_rs'=> 0,
                        'total_num_propostas_sc'=> 0,
                        'total_num_propostas_se'=> 0,
                        'total_num_propostas_sp'=> 0,
                        'total_num_propostas_to'=> 0,

                       ];
      foreach($propostasCadastradas as $valor){
           
        $totalProposta['total_propostas'] += $valor->num_propostas;
        $totalProposta['total_intervencao'] += $valor->vlr_total;
        $totalProposta['total_propostas_sistema'] += $valor->num_propostas_enviadas_sistema;
        $totalProposta['total_intervencao_sistema'] += $valor->vlr_intervencao_enviadas_sistema;
        $totalProposta['total_propostas_forms'] += $valor->num_propostas_enviadas_forms;
        $totalProposta['total_intervencao_forms'] += $valor->vlr_intervencao_enviadas_forms;
        $totalProposta['total_num_propostas_ac'] += $valor->num_propostas_ac;
        $totalProposta['total_num_propostas_al'] += $valor->num_propostas_al;
        $totalProposta['total_num_propostas_am'] += $valor->num_propostas_am;
        $totalProposta['total_num_propostas_ap'] += $valor->num_propostas_ap;
        $totalProposta['total_num_propostas_ba'] += $valor->num_propostas_ba;
        $totalProposta['total_num_propostas_ce'] += $valor->num_propostas_ce;
        $totalProposta['total_num_propostas_df'] += $valor->num_propostas_df;
        $totalProposta['total_num_propostas_es'] += $valor->num_propostas_es;
        $totalProposta['total_num_propostas_go'] += $valor->num_propostas_go;
        $totalProposta['total_num_propostas_ma'] += $valor->num_propostas_ma;
        $totalProposta['total_num_propostas_mg'] += $valor->num_propostas_mg;
        $totalProposta['total_num_propostas_ms'] += $valor->num_propostas_ms;
        $totalProposta['total_num_propostas_mt'] += $valor->num_propostas_mt;                            
        $totalProposta['total_num_propostas_pa'] += $valor->num_propostas_pa;
        $totalProposta['total_num_propostas_pb'] += $valor->num_propostas_pb;
        $totalProposta['total_num_propostas_pe'] += $valor->num_propostas_pe;
        $totalProposta['total_num_propostas_pi'] += $valor->num_propostas_pi;
        $totalProposta['total_num_propostas_pr'] += $valor->num_propostas_pr;
        $totalProposta['total_num_propostas_rj'] += $valor->num_propostas_rj;
        $totalProposta['total_num_propostas_rn'] += $valor->num_propostas_rn;
        $totalProposta['total_num_propostas_ro'] += $valor->num_propostas_ro;
        $totalProposta['total_num_propostas_rr'] += $valor->num_propostas_rr;
        $totalProposta['total_num_propostas_rs'] += $valor->num_propostas_rs;
        $totalProposta['total_num_propostas_sc'] += $valor->num_propostas_sc;
        $totalProposta['total_num_propostas_se'] += $valor->num_propostas_se;
        $totalProposta['total_num_propostas_sp'] += $valor->num_propostas_sp;
        $totalProposta['total_num_propostas_to'] += $valor->num_propostas_to;
      }

        return view('modulo_propostas.proposta.admin.RelatorioPropostasUf',compact('propostasCadastradas','totalProposta'));
    }
}
