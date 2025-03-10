<?php

namespace App\Http\Controllers\Mod_saci;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Propostas\CronogramaSelecao;
use App\Propostas\Propostas;
use App\Propostas\ViewPropostasCadastradas;
use App\Propostas\ViewPropostasCadastradasUf;

use App\ModuloSistema;

use App\RlcArquivoUser;
use App\User;
use App\ViewArquivosEnviados;
use DirectoryIterator;
use Illuminate\Support\Facades\Auth;



class HomeSaciController extends Controller
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
     

       $cronogramas = CronogramaSelecao::get();

       $whereOficio = [];

       $whereOficio[] = ['user_id', $usuario->id];
       $whereOficio[] = ['tipo_arquivo_id',1];

       $dadosArquivoOficio = RlcArquivoUser::where($whereOficio)->get();

       $moduloSistema  = 1;


        return view('modulo_saci.home_saci',compact('usuario','cronogramas','propostas','dadosArquivoOficio','moduloSistema'));
    }


}
