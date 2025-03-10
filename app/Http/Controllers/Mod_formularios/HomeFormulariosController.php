<?php

namespace App\Http\Controllers\Mod_formularios;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Propostas\CronogramaSelecao;
use App\Propostas\Propostas;
use App\Propostas\ViewPropostasCadastradas;
use App\Propostas\ViewPropostasCadastradasUf;

use App\ModuloSistema;
use App\Propostas\Selecao;
use App\RlcArquivoUser;
use App\RlcModuloSistemaTipoUsuario;
use App\User;
use App\ViewArquivosEnviados;
use DirectoryIterator;
use Illuminate\Support\Facades\Auth;



class HomeFormulariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');        
        $this->middleware('moduloUsuario');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $usuario = Auth::user();    
      /** 
        $tabCarteiraInvestimentoMdr = TabCarteiraInvestimentoMdr::select(db::raw("sgl_unidade_responsavel_agrupada"))
			->whereNotNull('sgl_unidade_responsavel_agrupada')
			->where('txt_controle_fonte_dados','!=','tfw')
			->where('bln_carteira_mdr_ativo','=','SIM')
			->groupBy('sgl_unidade_responsavel_agrupada');

         */ 
           
   

       
        return view('modulo_formulario.home_formulario',compact('usuario'));
    }


}
