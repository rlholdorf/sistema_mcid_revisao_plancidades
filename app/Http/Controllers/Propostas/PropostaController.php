<?php

namespace App\Http\Controllers\Propostas;

use App\EntePublico;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use DB;


use App\User;
use Config\App;
use App\Http\Flash;

use App\Propostas\AcaoPrograma;

use App\Propostas\ViewItensFinanciaveis;
use App\Propostas\ItensFinanciaveis;
use App\Propostas\Propostas;
use App\Propostas\RlcItensFinanciaveisProposta;
use App\Propostas\Selecao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use PhpParser\Node\Expr\Empty_;
use Prophecy\Prophet;

class PropostaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function cadastrarProposta(Request $request,$selecaoId){

      //return $request->all();

      $where = [];

      
        $entePublicoId = Crypt::decrypt($request->ente_publico_id);
        $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);
      
  
     
      $where[] = ['ente_publico_id',$entePublicoId];
      $where[] = ['selecao_id', $selecaoId];

        $selecao = Selecao::find($selecaoId);

      

      $proposta = Propostas::where($where)->get();
      $itensFinanciveis = '';

      $moduloSistema = $request->moduloSistema;

      
      

         $dataAtual = date("Y-m-d");

        if($selecao->dte_fim_cadastro_proposta < $dataAtual){        
          flash()->info("Prazo encerrado", "Prazo para cadastramento de propostas encerrado.");  

          $entePublicoId = Crypt::encrypt($entePublicoId);
          $cpfUsuario = Crypt::encrypt($cpfUsuario);
          return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);       
        }

        if($selecao->modalidade_participacao_id == 3){           
              return view('modulo_propostas.proposta.semob.CadastrarPropostaSemob',compact('cpfUsuario','entePublicoId','selecao','itensFinanciveis','moduloSistema','dataAtual'));        
        }elseif($selecao->modalidade_participacao_id == 2){
          return view('modulo_propostas.proposta.snsa.CadastrarPropostaSnsa',compact('cpfUsuario','entePublicoId','selecao','itensFinanciveis','moduloSistema','dataAtual'));
        }elseif($selecao->modalidade_participacao_id == 1){
          return view('modulo_propostas.proposta.sndum.CadastrarPropostaSndum',compact('cpfUsuario','entePublicoId','selecao','itensFinanciveis','moduloSistema','dataAtual'));
        }elseif($selecao->modalidade_participacao_id == 4){
          return view('modulo_propostas.proposta.snsa.CadastrarPropostaSnsa2218',compact('cpfUsuario','entePublicoId','selecao','itensFinanciveis','moduloSistema','dataAtual'));
        }elseif($selecao->modalidade_participacao_id == 5){
          return view('modulo_propostas.proposta.mcmv.CadastrarPropostaMcmv',compact('cpfUsuario','entePublicoId','selecao','itensFinanciveis','moduloSistema','dataAtual'));
        }
      


    }

    

   public function dadosProposta ($usuario, $proposta){

      
      $whereProposta = [];
  
      $whereProposta[] = ['id', $proposta];
      $whereProposta[] = ['user_id', $usuario];

    //return $whereProposta;

       $proposta = Propostas::where($whereProposta)->get();

      if(count($proposta) == 0){
        flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
        return redirect('/');  

      }

      $proposta = Propostas::where($whereProposta)->firstOrFail();
       

        $where = [];
  
      $where[] = ['id', $proposta->user_id];
      $where[] = ['ente_publico_id', $proposta->ente_publico_id];

      $proposta->load('selecao','situacaoProposta','usuario');

      $usuario = User::where($where)->firstOrFail();

      $cpfUsuario = $usuario->txt_cpf_usuario;
      $entePublicoId = $usuario->ente_publico_id;

    
     $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();

     $moduloSistema = 0;
      

      if($proposta->modalidade_participacao_id == 3){
        return view('modulo_propostas.proposta.semob.DadosPropostaSemob',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }else if($proposta->modalidade_participacao_id == 2){
        return view('modulo_propostas.proposta.snsa.DadosPropostaSnsa',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }else if($proposta->modalidade_participacao_id == 1){
        return view('modulo_propostas.proposta.sndum.DadosPropostaSndum',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }else if($proposta->modalidade_participacao_id == 4){
        return view('modulo_propostas.proposta.snsa.DadosPropostaSnsa2218',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }else if($proposta->modalidade_participacao_id == 5){
        return view('modulo_propostas.proposta.mcmv.DadosPropostaMcmv',compact('usuario','cpfUsuario','entePublicoId','proposta','itensFinanciveis','moduloSistema'));
      }

    
   }

   public function excluirProposta ($userProp, $userLog,  $proposta){

    $whereProposta = [];
  
      $whereProposta[] = ['id', $proposta];
      $whereProposta[] = ['user_id', $userProp];

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

       $usuario = User::find($userLog);

        $proposta = Propostas::find($proposta->id);
         $proposta->situacao_proposta_id = 8;
       $propostaDeletada = $proposta->update();
      
      if ($propostaDeletada){
        
        DB::commit();
        flash()->sucesso("Sucesso", "Proposta excluída com sucesso!"); 

         $entePublicoId = Crypt::encrypt($usuario->ente_publico_id);
        $cpfUsuario = Crypt::encrypt($usuario->txt_cpf_usuario);

        return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
        
      } else {
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível excluir a proposta.");  
        return back();  
      }  



   }

////////////////////////////PROPOSTAS SEMOB/////////////////////////////////////////////////

   public function salvarPropostaSemob(Request $request){
      
    //return $request->all();

    $moduloSistema = false;
    if(Auth::user()){
      $moduloSistema = true;
    }

    $where = [];

    $entePublicoId = Crypt::decrypt($request->ente_publico_id);
    $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);


    $where[] = ['txt_cpf_usuario', $cpfUsuario];
    $where[] = ['ente_publico_id', $entePublicoId];

    $usuario = User::where($where)->firstOrFail();

    //$ente_publico = EntePublico::find($entePublicoId);
    $usuario->load('entePublico.municipio.uf');


    DB::beginTransaction();

    $proposta = new Propostas;
    $proposta->ente_publico_id = $entePublicoId;
    $proposta->user_id = $usuario->id;
    //$proposta->municipio_id = $request->municipio;
    //$proposta->uf_id = $request->estado;
    $proposta->selecao_id = $request->selecao_id;
    $proposta->modalidade_participacao_id = 3;
    $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
    $proposta->dsc_justificativa = $request->dsc_justificativa;
    $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $request->bln_projeto_basico;
    $proposta->bln_pb_acessibilidade = $request->bln_pb_acessibilidade;
    $proposta->bln_plano_mobilidade_aprovado = $request->bln_plano_mobilidade_aprovado;
    $proposta->situacao_proposta_id = 1;

    
   

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
      

      

      if ($salvoComSucesso && $salvouItensFinanciaveis){
        DB::commit();
        flash()->sucesso("Sucesso", "Proposta cadastrada com sucesso!"); 

        $entePublicoId = Crypt::encrypt($entePublicoId);
        $cpfUsuario = Crypt::encrypt($cpfUsuario);

          if($moduloSistema == true){
            return redirect('/selecao/ente_publico/propostas');
          }else{
            return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
          }
        
    } else {
      DB::rollBack();
      flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
      return back();  
    }  

}

   public function editarPropostaSemob(Request $request){
      
    //return $request->all();
    $moduloSistema = $request->moduloSistema;

    $where = [];

    $entePublicoId = Crypt::decrypt($request->ente_publico_id);
    $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);


    $where[] = ['txt_cpf_usuario', $cpfUsuario];
    $where[] = ['ente_publico_id', $entePublicoId];

    $usuario = User::where($where)->firstOrFail();
    

    DB::beginTransaction();

    $proposta = Propostas::find($request->proposta_id);

    

    //$proposta->municipio_id = $request->municipio;
    //$proposta->uf_id = $request->estado;
    $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
    $proposta->dsc_justificativa = $request->dsc_justificativa;
    $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $request->bln_projeto_basico;
    $proposta->bln_pb_acessibilidade = $request->bln_pb_acessibilidade;
    $proposta->bln_plano_mobilidade_aprovado = $request->bln_plano_mobilidade_aprovado;


    $salvoComSucesso = $proposta->save();
    
      $deletadoSucesso = RlcItensFinanciaveisProposta::where('proposta_id', $proposta->id)->delete();

        $salvouItensFinanciaveis = false;
        $itensFinanciveis = $request->itens_financiaveis;
        foreach($request->itens_financiaveis as $item){
          $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
        }

        $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();
    

    if ($salvoComSucesso && $salvouItensFinanciaveis && $deletadoSucesso){
       DB::commit();
       flash()->sucesso("Sucesso", "Proposta atualizada com sucesso!"); 
      
    
       $entePublicoId = Crypt::encrypt($entePublicoId);
       $cpfUsuario = Crypt::encrypt($cpfUsuario);

       if($moduloSistema){
          return redirect('/selecao/ente_publico/propostas');
        }else{
          return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
        }
       
   } else {
    DB::rollBack();
    flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
    return back();  
   }  

}
////////////////////////////PROPOSTAS SEMOB/////////////////////////////////////////////////

////////////////////////////PROPOSTAS SNDUM/////////////////////////////////////////////////
    
 

   public function salvarPropostaSndum(Request $request){
      
    //return $request->all(0);

    $moduloSistema = false;
    if(Auth::user()){
      $moduloSistema = true;
    }

    $where = [];

    $entePublicoId = Crypt::decrypt($request->ente_publico_id);
    $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);

    

    $where[] = ['txt_cpf_usuario', $cpfUsuario];
    $where[] = ['ente_publico_id', $entePublicoId];

    $usuario = User::where($where)->firstOrFail();

    DB::beginTransaction();

    $proposta = new Propostas;
    $proposta->ente_publico_id = $entePublicoId;
    $proposta->user_id = $usuario->id;
    
    //$proposta->municipio_id = $request->municipio;
    //$proposta->uf_id = $request->estado;
    $proposta->selecao_id = $request->selecao_id;
    $proposta->modalidade_participacao_id = 1;
    $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
    $proposta->dsc_justificativa = $request->dsc_justificativa;
    $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $request->bln_projeto_basico;
    $proposta->bln_criterios_pndu = $request->bln_criterios_pndu;
    $proposta->situacao_proposta_id = 1;
    
   

    $proposta->created_at = Date("Y-m-d h:i:s");


    $salvoComSucesso = $proposta->save();

    $protocolo = $proposta->id .'/'. Date("Y") .'-'. $request->selecao_id .'1';
    $proposta->txt_protocolo = str_pad($protocolo  , 20 , '0' , STR_PAD_LEFT);
    $salvoComSucesso = $proposta->save();

    $salvouItensFinanciaveis = false;
    $itensFinanciveis = $request->itens_financiaveis;
    foreach($request->itens_financiaveis as $item){
      $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
    }

    $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();


    $proposta->load('selecao','situacaoProposta');


       if ($salvoComSucesso && $salvouItensFinanciaveis){
       DB::commit();
       flash()->sucesso("Sucesso", "Proposta cadastrada com sucesso!"); 
      
       $entePublicoId = Crypt::encrypt($entePublicoId);
       $cpfUsuario = Crypt::encrypt($cpfUsuario);

       if($moduloSistema == true){
          return redirect('/selecao/ente_publico/propostas');
        }else{
          return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
        }

   } else {
    DB::rollBack();
    flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
    return back();  
   }  
  }
   public function editarPropostaSndum(Request $request){
      
    //return $request->all();

    $moduloSistema = $request->moduloSistema;

    $where = [];

    $entePublicoId = Crypt::decrypt($request->ente_publico_id);
    $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);



    $where[] = ['txt_cpf_usuario', $cpfUsuario];
    $where[] = ['ente_publico_id', $entePublicoId];

    $usuario = User::where($where)->firstOrFail();

    DB::beginTransaction();

     $proposta = Propostas::find($request->proposta_id);

     $deletadoSucesso = RlcItensFinanciaveisProposta::where('proposta_id', $proposta->id)->delete();
     
    
     $proposta->municipio_id = $request->municipio;
     $proposta->uf_id = $request->estado;
    $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
    $proposta->dsc_justificativa = $request->dsc_justificativa;
    $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $request->bln_projeto_basico;
    $proposta->bln_criterios_pndu = $request->bln_criterios_pndu;
   
    $salvoComSucesso = $proposta->save();

    $proposta->load('selecao','situacaoProposta');

    

    $salvouItensFinanciaveis = false;
    $itensFinanciveis = $request->itens_financiaveis;
    foreach($request->itens_financiaveis as $item){
      $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
    }

    $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();


       if ($salvoComSucesso && $salvouItensFinanciaveis && $deletadoSucesso){
          DB::commit();
          flash()->sucesso("Sucesso", "Proposta atualizada com sucesso!"); 

          $entePublicoId = Crypt::encrypt($entePublicoId);
          $cpfUsuario = Crypt::encrypt($cpfUsuario);

          if($moduloSistema == true){
              return redirect('/selecao/ente_publico/propostas');
            }else{
              return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
            }
      
      } else {
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
        return back();  
      }  
  }
   ////////////////////////////PROPOSTAS SNSA/////////////////////////////////////////////////
    
 

   public function salvarPropostaSnsa(Request $request){
      
    //return $request->all();

    $moduloSistema = false;
    if(Auth::user()){
      $moduloSistema = true;
    }

    $where = [];

    $entePublicoId = Crypt::decrypt($request->ente_publico_id);
    $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);

    

    $where[] = ['txt_cpf_usuario', $cpfUsuario];
    $where[] = ['ente_publico_id', $entePublicoId];

    $usuario = User::where($where)->firstOrFail();

    DB::beginTransaction();

    $proposta = new Propostas;
    $proposta->ente_publico_id = $entePublicoId;
    $proposta->user_id = $usuario->id;
    
    //$proposta->municipio_id = $request->municipio;
    //$proposta->uf_id = $request->estado;
    $proposta->selecao_id = $request->selecao_id;
    $proposta->modalidade_participacao_id = 2;
    $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
    $proposta->dsc_justificativa = $request->dsc_justificativa;
    $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $request->bln_projeto_basico;
    $proposta->bln_criterios_pnsa = $request->bln_criterios_pnsa;
    $proposta->situacao_proposta_id = 1;
    
   

    $proposta->created_at = Date("Y-m-d h:i:s");


    $salvoComSucesso = $proposta->save();

    $protocolo = $proposta->id .'/'. Date("Y") .'-'. $request->selecao_id .'2';
    $proposta->txt_protocolo = str_pad($protocolo  , 20 , '0' , STR_PAD_LEFT);
    $salvoComSucesso = $proposta->save();

    $salvouItensFinanciaveis = false;
    if($request->itens_financiaveis){
      $itensFinanciveis = $request->itens_financiaveis;
    //  return $itensFinanciveis;
  
      foreach($request->itens_financiaveis as $item){
        $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
      } 
      
    }else{

      $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, 0);
    }

    $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();


    $proposta->load('selecao','situacaoProposta');


       if ($salvoComSucesso && $salvouItensFinanciaveis){
            DB::commit();
            flash()->sucesso("Sucesso", "Proposta cadastrada com sucesso!"); 

            $entePublicoId = Crypt::encrypt($entePublicoId);
            $cpfUsuario = Crypt::encrypt($cpfUsuario);

            if($moduloSistema == true){
                return redirect('/selecao/ente_publico/propostas');
              }else{
                return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
              }
            
        } else {
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
          return back();  
        }  
  }

  public function salvarPropostaSnsa2018(Request $request){
      
    //return $request->all();
    $moduloSistema = false;
    if(Auth::user()){
      $moduloSistema = true;
    }
    

    $where = [];

    $entePublicoId = Crypt::decrypt($request->ente_publico_id);
    $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);

    

    $where[] = ['txt_cpf_usuario', $cpfUsuario];
    $where[] = ['ente_publico_id', $entePublicoId];

    $usuario = User::where($where)->firstOrFail();

    DB::beginTransaction();

    $proposta = new Propostas;
    $proposta->ente_publico_id = $entePublicoId;
    $proposta->user_id = $usuario->id;
    
    //$proposta->municipio_id = $request->municipio;
    //$proposta->uf_id = $request->estado;
    $proposta->selecao_id = $request->selecao_id;
    $proposta->modalidade_participacao_id = 4;
    $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
    $proposta->dsc_justificativa = $request->dsc_justificativa;
    $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $request->bln_projeto_basico;
    $proposta->bln_criterios_pnsa = $request->bln_criterios_pnsa;
    $proposta->situacao_proposta_id = 1;
    
   

    $proposta->created_at = Date("Y-m-d h:i:s");


    $salvoComSucesso = $proposta->save();

    $protocolo = $proposta->id .'/'. Date("Y") .'-'. $request->selecao_id .'2';
    $proposta->txt_protocolo = str_pad($protocolo  , 20 , '0' , STR_PAD_LEFT);
    $salvoComSucesso = $proposta->save();

    $salvouItensFinanciaveis = false;
    if($request->itens_financiaveis){
      $itensFinanciveis = $request->itens_financiaveis;
    //  return $itensFinanciveis;
  
      foreach($request->itens_financiaveis as $item){
        $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
      } 
      
    }else{

      $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, 0);
    }

    $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();


    $proposta->load('selecao','situacaoProposta');


       if ($salvoComSucesso && $salvouItensFinanciaveis){
            DB::commit();
            flash()->sucesso("Sucesso", "Proposta cadastrada com sucesso!"); 

            $entePublicoId = Crypt::encrypt($entePublicoId);
            $cpfUsuario = Crypt::encrypt($cpfUsuario);

            if($moduloSistema == true){
                return redirect('/selecao/ente_publico/propostas');
              }else{
                return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
              }
            
        } else {
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
          return back();  
        }  
  }

   public function editarPropostaSnsa(Request $request){
      
    //return $request->all();

    $moduloSistema = $request->moduloSistema;

    $where = [];

    $entePublicoId = Crypt::decrypt($request->ente_publico_id);
    $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);



    $where[] = ['txt_cpf_usuario', $cpfUsuario];
    $where[] = ['ente_publico_id', $entePublicoId];

    $usuario = User::where($where)->firstOrFail();

    DB::beginTransaction();

     $proposta = Propostas::find($request->proposta_id);

     $deletadoSucesso = RlcItensFinanciaveisProposta::where('proposta_id', $proposta->id)->delete();
     
    
     $proposta->municipio_id = $request->municipio;
     $proposta->uf_id = $request->estado;
    $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
    $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
    $proposta->dsc_justificativa = $request->dsc_justificativa;
    $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
    $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
    $proposta->bln_projeto_basico = $request->bln_projeto_basico;
    $proposta->bln_criterios_pnsa = $request->bln_criterios_pnsa;
   
    $salvoComSucesso = $proposta->save();

    $proposta->load('selecao','situacaoProposta');

    

    $salvouItensFinanciaveis = false;
    $itensFinanciveis = $request->itens_financiaveis;
    foreach($request->itens_financiaveis as $item){
      $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
    }

    $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();


       if ($salvoComSucesso && $salvouItensFinanciaveis && $deletadoSucesso){
       DB::commit();
       flash()->sucesso("Sucesso", "Proposta atualizada com sucesso!"); 
      
       $entePublicoId = Crypt::encrypt($entePublicoId);
       $cpfUsuario = Crypt::encrypt($cpfUsuario);

       if($moduloSistema){
                return redirect('/selecao/ente_publico/propostas');
              }else{
                return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
              }
 
        } else {
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
          return back();  
        }     
 }

 ////////////////////////////PROPOSTAS SNSA/////////////////////////////////////////////////
    
 

 public function salvarPropostaMcmv(Request $request){
      
  //return $request->all();

  $moduloSistema = false;
  if(Auth::user()){
    $moduloSistema = true;
  }

  $where = [];

  $entePublicoId = Crypt::decrypt($request->ente_publico_id);
  $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);

  

  $where[] = ['txt_cpf_usuario', $cpfUsuario];
  $where[] = ['ente_publico_id', $entePublicoId];

  $usuario = User::where($where)->firstOrFail();

  DB::beginTransaction();

  $proposta = new Propostas;
  $proposta->ente_publico_id = $entePublicoId;
  $proposta->user_id = $usuario->id;
  
  //$proposta->municipio_id = $request->municipio;
  //$proposta->uf_id = $request->estado;
  $proposta->selecao_id = $request->selecao_id;
  $proposta->modalidade_participacao_id = 5;
  $proposta->dsc_obj_intervencao = $request->dsc_obj_intervencao;
  $proposta->vlr_intervencao = floatval(str_replace("." , "" ,$request->vlr_intervencao)) ;
  $proposta->dsc_justificativa = $request->dsc_justificativa;
  $proposta->dsc_problema_resolver = $request->dsc_problema_resolver;
  $proposta->dsc_beneficios_intervencao = $request->dsc_beneficios_intervencao;
  $proposta->bln_projeto_basico = $request->bln_projeto_basico;
  $proposta->situacao_proposta_id = 1;
  
 

  $proposta->created_at = Date("Y-m-d h:i:s");


  $salvoComSucesso = $proposta->save();

  $protocolo = $proposta->id .'/'. Date("Y") .'-'. $request->selecao_id .'2';
  $proposta->txt_protocolo = str_pad($protocolo  , 20 , '0' , STR_PAD_LEFT);
  $salvoComSucesso = $proposta->save();

  $salvouItensFinanciaveis = false;
  if($request->itens_financiaveis){
    $itensFinanciveis = $request->itens_financiaveis;
  //  return $itensFinanciveis;

    foreach($request->itens_financiaveis as $item){
      $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, $item);
    } 
    
  }else{

    $salvouItensFinanciaveis = RlcItensFinanciaveisProposta::salvarItensFinanciaveis($proposta->id, 0);
  }

  $itensFinanciveis = RlcItensFinanciaveisProposta::where('proposta_id',$proposta->id)->get();


  $proposta->load('selecao','situacaoProposta');


     if ($salvoComSucesso && $salvouItensFinanciaveis){
          DB::commit();
          flash()->sucesso("Sucesso", "Proposta cadastrada com sucesso!"); 

          $entePublicoId = Crypt::encrypt($entePublicoId);
          $cpfUsuario = Crypt::encrypt($cpfUsuario);

          if($moduloSistema == true){
              return redirect('/selecao/ente_publico/propostas');
            }else{
              return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
            }
          
      } else {
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível cadastrar os dados da proposta.");  
        return back();  
      }  
}


  
}
