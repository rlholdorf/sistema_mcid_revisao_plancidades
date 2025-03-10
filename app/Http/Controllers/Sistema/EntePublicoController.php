<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;

use DB;

use App\Http\Requests\RegistroUsuarioAdesaoPropostas;

use App\User;
use App\EntePublico;
use App\Http\Requests\ValidarCpfCnpj;
use App\Mail\NovaSolicitacaoEntePublico;
use App\Mail\NovoUsuarioEntePublico;
use App\Permissoes;

use App\Propostas\CronogramaSelecao;
use App\Propostas\Selecao;
use App\Propostas\Propostas;
use App\Propostas\RlcItensFinanciaveisProposta;
use App\RlcArquivoUser;
use App\RlcEmailInstitucionalEnte;
use App\ViewArquivosEnviados;

class EntePublicoController extends Controller
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

    public function salvarEntePublico(RegistroUsuarioAdesaoPropostas $request)    
    {
        //return $request->all();

        DB::beginTransaction();

        $where = [];
  
        $where[] = ['ente_publico_id', $request->txt_cnpj];
        $where[] = ['status_usuario_id', '<=', 2];

        $enteUsuarios = User::where($where)->get();



        if(count($enteUsuarios) > 5){
          DB::rollBack();

          flash()->erro("Erro", "Este Ente Público já atingiu o limite de 5 usuários para acesso ao sistema.");     
          return back();  
         }


         $possuiUsuarioCPF = User::where('txt_cpf_usuario',$request->txt_cpf_usuario)->get();

         $where = [strtoupper($request->email), strtolower($request->email)];

        $possuiUsuarioEmail = User::whereIn('email',$where)->get();

        if(count($possuiUsuarioCPF) > 0){
            DB::rollBack();          
            flash()->erro("Erro", "Já existe um usuário cadastrado com esse CPF.");     
            return back();  
          
        }elseif(count($possuiUsuarioEmail) > 0){
          DB::rollBack();          
          flash()->erro("Erro", "Já existe um usuário cadastrado com esse Email.");     
          return back();  
        
       } else{
          $usuario = new User;
          $usuario->txt_cpf_usuario = $request->txt_cpf_usuario;
          $usuario->name = $request->txt_nome . ' ' . $request->txt_sobrenome;
          $usuario->txt_cargo = $request->txt_cargo;
          $usuario->email = strtolower($request->email);
          $usuario->txt_ddd_fixo = $request->txt_ddd;
          $usuario->txt_telefone_fixo = $request->txt_telefone;
        //  $usuario->txt_ddd_movel = $request->txt_ddd_movel;
        //  $usuario->txt_telefone_movel = $request->txt_celular;
          $usuario->modalidade_participacao_id = $request->modalidade_participacao;
          $usuario->tipo_usuario_id = 9;
          $usuario->modulo_sistema_id = 2;
          $usuario->ente_publico_id = $request->txt_cnpj;
          $usuario->status_usuario_id = 2;
          $usuario->password = bcrypt('123456');
        
          $salvoComSucesso = $usuario->save();
        }

       

       $entepossuiCadastro = EntePublico::where('id',$request->txt_cnpj)->get();
        
       if(count($entepossuiCadastro) == 0){
        $entePublico = new EntePublico;
        $entePublico->id = $request->txt_cnpj;
        $entePublico->txt_ente_publico = $request->txt_nome_proponente;
        $entePublico->txt_email_ente_publico = strtolower($request->txt_email_ente_publico);
        $entePublico->municipio_id = $request->municipio;
        $entePublico->txt_nome_chefe_executivo = $request->txt_nome_chefe_executivo;
        $entePublico->txt_cargo_executivo = $request->cargo_executivo;
        $entePublico->created_at = Date("Y-m-d h:i:s");
        $salvoComSucessoEnte = $entePublico->save();

       }elseif(count($entepossuiCadastro) > 5){
          DB::rollBack();

          flash()->erro("Erro", "Este Ente Público já atingiu o limite de 5 usuários para acesso ao sistema.");     
          return back();  
       }else{

        $entePublico = EntePublico::find($request->txt_cnpj);
        if($entePublico->email != $request->txt_email_ente_publico){
            $possuiEmail = RlcEmailInstitucionalEnte::where('txt_email_ente_publico',$request->txt_email_ente_publico)->get();

            if(count($possuiEmail) == 0){
              $emailEntePublico = new RlcEmailInstitucionalEnte;
              $emailEntePublico->txt_email_ente_publico = strtolower($request->txt_email_ente_publico);
              $emailEntePublico->ente_publico_id = $request->txt_cnpj;
              $emailEntePublico->user_id = $usuario->id;
              $salvoComSucessoEnte = $emailEntePublico->save();
            }else{
              $salvoComSucessoEnte = true;    
            }

          
        }else{
          $salvoComSucessoEnte = true;
        }
       }
        
        $permissoes = new Permissoes;
        $permissoes->user_id = $usuario->id;   
        $permissoes->modulo_sistema_id = 2;       
        $permissoes->status_permissao_id = 1;   
        $permissoes->bln_analisada = false;   

        $salvoComSucessoPermissoes = $permissoes->save();

      

       $entePublicoId = Crypt::encrypt($request->txt_cnpj);
       $cpfUsuario = Crypt::encrypt($usuario->txt_cpf_usuario);

        if ($salvoComSucesso || $salvoComSucessoEnte || $salvoComSucessoPermissoes){
            flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!"); 
            DB::commit();

            $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');

            Mail::to('cadastramento.mcid@mdr.gov.br')->send(new NovoUsuarioEntePublico($usuario, $permissoes));
            Mail::to($request->email)->send(new NovaSolicitacaoEntePublico($usuario));

            
            return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);
        } else {
            DB::rollBack();

            flash()->erro("Erro", "Não foi possível cadastrar os dados do usuário.");     
           return back();  

        }  
    }

    public function entePublicoPropostas($cpfUsuario, $entePublicoId){


      // $cpfUsuario;

      $entePublicoId = Crypt::decrypt($entePublicoId);
       $cpfUsuario = Crypt::decrypt($cpfUsuario);

        $where = [];
  
        $where[] = ['txt_cpf_usuario', $cpfUsuario];
        $where[] = ['ente_publico_id', $entePublicoId];
      
       // return $where;
  
  
         $usuario = User::where($where)->firstOrFail();
        $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');
  
         $cronogramas = CronogramaSelecao::orderBy('id')->get();

         $wherePropostas = [];
  
         $wherePropostas[] = ['ente_publico_id', $usuario->ente_publico_id];
         $wherePropostas[] = ['bln_propostas_recebidas_sistema', true];


           $propostas = Propostas::where($wherePropostas)->orderBy('txt_protocolo')->get();

            $propostas->load('situacaoProposta','modalidadeParticipacao','usuario','selecao');
       

          $whereOficio = [];
  
          $whereOficio[] = ['usuario_id', $usuario->id];
          $whereOficio[] = ['tipo_arquivo_id',1];

           $dadosArquivoOficio = ViewArquivosEnviados::where($whereOficio)->get();

         $selecao = Selecao::where('bln_ativa',true)->get();

          $dataAtual = date("Y-m-d");

         
  
  
        if(empty($usuario)){   
           flash()->erro("Erro", "Não existe Ente Público para os dados informados.");  
           return redirect('/');  
        }else{

          
     //  flash()->confirma("Cadastro de propostas discricionárias", "O período de envio de proposta se encerra em 20/08/2023.",'info'); 

           return view('modulo_sistema.ente_publico.EntePublicoPropostas',compact('usuario','cronogramas','propostas','dadosArquivoOficio','selecao','dataAtual'));
  
        }
  
      }

      public function consultaEntePublico(ValidarCpfCnpj $request)
      {
        # code...

        //return EntePublico::find($request->ente_publico_id);
       //return $request->all();

 
        $where = [];
  
        $where[] = ['txt_cpf_usuario', $request->txt_cpf_usuario];
        $where[] = ['ente_publico_id', $request->ente_publico_id];
        
        //return $where;

        $selecao = Selecao::where('bln_ativa',true)->get();

        $usuario = User::where($where)->get();  
  
  
      
       
  
        if(count($usuario) == 0){           
           flash()->erro("Erro", "Não existe Ente Público para os dados informados.");  
           return back();  
        }else{
          
           $usuario = User::where($where)->first();

         

           $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');
    
    
          $wherePropostas = [];
    
      $wherePropostas[] = ['ente_publico_id', $usuario->ente_publico_id];
      $wherePropostas[] = ['bln_propostas_recebidas_sistema', true];

           $propostas = Propostas::where($wherePropostas)->get();
           
           $propostas->load('situacaoProposta');
           
      
             $cronogramas = CronogramaSelecao::orderby('id')->get();

          $usuario->load('tipoUsuario', 'statusUsuario');

          $whereOficio = [];
  
          $whereOficio[] = ['usuario_id', $usuario->id];
          $whereOficio[] = ['tipo_arquivo_id',1];

           $dadosArquivoOficio = ViewArquivosEnviados::where($whereOficio)->get();
           
           $possuiOficioValido = true;

           foreach($dadosArquivoOficio as $dados)           
           {
              if($dados->bln_documento_analisado == true && $dados->bln_documento_validado  == false){
                $possuiOficioValido = false;
                
              }

           }

           $selecao = Selecao::where('bln_ativa',true)->get();

          $dataAtual = date("Y-m-d");

          // flash()->confirma("Cadastro de propostas discricionárias", "O período de envio de proposta se encerra em 20/08/2023.",'info'); 

           return view('modulo_sistema.ente_publico.EntePublicoPropostas',compact('usuario','cronogramas','propostas','dadosArquivoOficio',
           'possuiOficioValido','selecao','dataAtual'));
  
        }
      }
        public function dadosUsuarioEntePublico($usuarioId)
      {
        # code...

       //return $request->all();

 
        $where = [];
  
      $where[] = ['id', Crypt::decrypt($usuarioId)];
  
        //return $where;
  
  
      $usuario = User::where($where)->first();

    $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');

      $wherePropostas = [];
    
      $wherePropostas[] = ['ente_publico_id', $usuario->ente_publico_id];
      $wherePropostas[] = ['bln_propostas_recebidas_sistema', true];

       $propostas = Propostas::where( $wherePropostas)->get();
       
       $propostas->load('situacaoProposta');
       
  
         $cronogramas = CronogramaSelecao::get();

         $whereOficio = [];
  
         $whereOficio[] = ['usuario_id', $usuario->id];
         $whereOficio[] = ['tipo_arquivo_id',1];

         $dadosArquivoOficio = ViewArquivosEnviados::where($whereOficio)->get();
       
  
        if(!$usuario){           
           flash()->erro("Erro", "Não existe Ente Público para os dados informados.");  
           return back();  
        }else{
          //$usuario->load('tipoUsuario', 'statusUsuario');
          //return $usuario->name;
           return view('modulo_sistema.ente_publico.EntePublicoPropostas',compact('usuario','cronogramas','propostas','dadosArquivoOficio'));
  
        }
      }

      public function enviarOficioEntePublico(Request $request){

       // return $request;

      

        $entePublicoId = Crypt::decrypt($request->ente_publico_id);
        $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);

        $where = [];
  
      $where[] = ['txt_cpf_usuario', $cpfUsuario];
      $where[] = ['ente_publico_id', $entePublicoId];

      //return $where;

       $usuario = User::where($where)->firstOrFail();

      $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');

     

      $txt_caminho_oficio = "";

      if($request->file('txt_caminho_oficio')){
          $tipoAquivo = $request->file('txt_caminho_oficio')->getMimeType();
          
          if($tipoAquivo != 'application/pdf'){
            flash()->erro("Erro", "Arquivo inválido. Anexe um PDF.");  
              return back();
          }

          
          $nomeArqOficio = 'arqOficioTipo1-'.$usuario->entePublico->municipio_id.'-'.$usuario->id.'.'.$request->file('txt_caminho_oficio')->extension();
           
          $path_arquivo = public_path() . '/uploads_arquivos/modulo_propostas/propostas/oficio';
              
           
              if(!File::isDirectory($path_arquivo)){
                  File::makeDirectory($path_arquivo, 0777, true, true);
              }
          
          $txt_caminho_oficio = $request->file('txt_caminho_oficio')->storeAs('/uploads_arquivos/modulo_propostas/propostas/oficio', $nomeArqOficio, 'arquivos');  
       }

     // return $txt_caminho_oficio;

       DB::beginTransaction();

       


        $whereOficio = [];

      $whereOficio[] = ['user_id', $usuario->id];
      $whereOficio[] = ['tipo_arquivo_id', 1];
      $whereOficio[] = ['bln_documento_analisado', false];


        $dadosArquivoOficio = RlcArquivoUser::where($whereOficio)->get();

        if(count($dadosArquivoOficio) == 0){
          $arquivoOficio = new RlcArquivoUser;
          $arquivoOficio->user_id = $usuario->id;
          $arquivoOficio->tipo_arquivo_id = 1;
          $arquivoOficio->bln_documento_analisado = FALSE;
          $arquivoOficio->txt_caminho_arquivo = $txt_caminho_oficio;
          $arquivoOficio->txt_nome_arquivo = $nomeArqOficio;
          $arquivoOficio->created_at = Date("Y-m-d h:i:s");
//return $arquivoOficio;

          $dadosArquivoSalvo = $arquivoOficio->save();


        }else{
          $arquivoOficio = RlcArquivoUser::where($whereOficio)->firstOrFail();
          $arquivoOficio->updated_at = Date("Y-m-d h:i:s");
          $dadosArquivoSalvo = $arquivoOficio->update();
        }
        
        
        
        

        if(!$dadosArquivoSalvo){           

          DB::rollBack();
          flash()->erro("Erro", "Não enviar o ofício.");  
          return back();  
       }else{
        $usuario->bln_oficio = true;
        $dadosUsuarioSalvo = $usuario->save();

          DB::commit();

          $entePublicoId = Crypt::encrypt($entePublicoId);
          $cpfUsuario = Crypt::encrypt($cpfUsuario);

          flash()->sucesso("Sucesso", "Ofício enviado com sucesso"); 
          return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);

       }
    }

    public function reenviarOficioEntePublico(Request $request){

      // return $request->all();;

     

       $entePublicoId = Crypt::decrypt($request->ente_publico_id);
       $cpfUsuario = Crypt::decrypt($request->txt_cpf_usuario);

       $where = [];
 
     $where[] = ['txt_cpf_usuario', $cpfUsuario];
     $where[] = ['ente_publico_id', $entePublicoId];

     //return $where;

      $usuario = User::where($where)->firstOrFail();

     $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');

     $quantOficio = RlcArquivoUser::where('user_id', $usuario->id)->count();
     $quantOficio = $quantOficio + 1;

     $txt_caminho_oficio = "";

     if($request->file('txt_caminho_oficio')){
         $tipoAquivo = $request->file('txt_caminho_oficio')->getMimeType();
         
         if($tipoAquivo != 'application/pdf'){
           flash()->erro("Erro", "Arquivo inválido. Anexe um PDF.");  
             return back();
         }

         
         $nomeArqOficio = 'arqCorrecaoOficioTipo1-' . $quantOficio . '-' . $usuario->entePublico->municipio_id.'-'.$usuario->id.'.'.$request->file('txt_caminho_oficio')->extension();
          
           $path_arquivo = public_path() . '/uploads_arquivos/modulo_propostas/propostas/oficio';
             
          
             if(!File::isDirectory($path_arquivo)){
                 File::makeDirectory($path_arquivo, 0777, true, true);
             }
         
         $txt_caminho_oficio = $request->file('txt_caminho_oficio')->storeAs('/uploads_arquivos/modulo_propostas/propostas/oficio', $nomeArqOficio, 'arquivos');  
      }

      //return $txt_caminho_oficio;

      DB::beginTransaction();

      


       $whereOficio = [];

     $whereOficio[] = ['user_id', $usuario->id];
     $whereOficio[] = ['tipo_arquivo_id', 1];
     $whereOficio[] = ['bln_documento_analisado', false];


       $dadosArquivoOficio = RlcArquivoUser::where($whereOficio)->get();

       if(count($dadosArquivoOficio) == 0){
         $arquivoOficio = new RlcArquivoUser;
         $arquivoOficio->user_id = $usuario->id;
         $arquivoOficio->tipo_arquivo_id = 1;
         $arquivoOficio->bln_documento_analisado = FALSE;
         $arquivoOficio->txt_caminho_arquivo = $txt_caminho_oficio;
         $arquivoOficio->txt_nome_arquivo = $nomeArqOficio;
         $arquivoOficio->created_at = Date("Y-m-d h:i:s");
         $dadosArquivoSalvo = $arquivoOficio->save();


       }else{
         $arquivoOficio = RlcArquivoUser::where($whereOficio)->firstOrFail();
         $arquivoOficio->updated_at = Date("Y-m-d h:i:s");
         $dadosArquivoSalvo = $arquivoOficio->update();
       }
       
       
       
       

       if(!$dadosArquivoSalvo){           
       

         DB::rollBack();
         flash()->erro("Erro", "Não enviar o ofício.");  
         return back();  
      }else{
      
       
         DB::commit();

         $entePublicoId = Crypt::encrypt($entePublicoId);
         $cpfUsuario = Crypt::encrypt($cpfUsuario);

         flash()->sucesso("Sucesso", "Ofício corrigido enviado com sucesso"); 
         return redirect('/ente_publico/propostas/'. $cpfUsuario . '/' . $entePublicoId);

      }
   }


    public function dadosEnte(){

       $usuario = Auth::user();
        
      $entePublico = EntePublico::find($usuario->ente_publico_id);

      $entePublico->load('municipio.uf');

      return view('modulo_sistema.ente_publico.dados_ente_publico',compact('usuario','entePublico'));

    }

    public function acessoDadosPropostasUserNaoAtivo(){

      return view('modulo_sistema.ente_publico.dados_usuario_nao_ativo');
    }
}
