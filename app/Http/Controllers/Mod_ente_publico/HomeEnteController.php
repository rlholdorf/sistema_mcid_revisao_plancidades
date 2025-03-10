<?php

namespace App\Http\Controllers\Mod_ente_publico;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Propostas\CronogramaSelecao;
use App\Propostas\Propostas;
use App\Propostas\ViewPropostasCadastradas;
use App\Propostas\ViewPropostasCadastradasUf;

use App\ModuloSistema;
use App\Propostas\Selecao;
use App\RlcArquivoUser;
use App\User;
use App\ViewArquivosEnviados;
use DirectoryIterator;
use Illuminate\Support\Facades\Auth;



class HomeEnteController extends Controller
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
    public function index()
    {
        
   
       
    $usuario = Auth::user();  

       
        

    $usuario->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');


     $propostas = Propostas::where('ente_publico_id', $usuario->ente_publico_id)->get();
     
     $propostas->load('situacaoProposta');
     

       $cronogramas = CronogramaSelecao::orderBy('id')->get();

       $whereOficio = [];

       $whereOficio[] = ['user_id', $usuario->id];
       $whereOficio[] = ['tipo_arquivo_id',1];

       $dadosArquivoOficio = RlcArquivoUser::where($whereOficio)->get();

       $moduloSistema  = 1;

       //flash()->confirma("Cadastro de propostas discricionárias", "O período de envio de proposta se encerra em 20/08/2023.",'info'); 
       $selecao = Selecao::where('bln_ativa',true)->get();

       $dataAtual = date("Y-m-d");

        return view('modulo_sistema.ente_publico.home_ente_publico',compact('usuario','cronogramas','propostas','dadosArquivoOficio','moduloSistema','selecao','dataAtual'));
    }


}
