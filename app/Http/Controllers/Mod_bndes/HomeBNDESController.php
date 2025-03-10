<?php

namespace App\Http\Controllers\Mod_bndes;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mod_bndes\ViewDadosBndes;
use App\Mod_bndes\ViewResumoAndamentoBndes;
use App\Mod_bndes\ViewResumoSituacaoContratoBndes;
use App\Mod_bndes\ViewResumoSituacaoObraBndes;
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



class HomeBndesController extends Controller
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

        $resumoAndamentoBndes = ViewResumoAndamentoBndes::get();
        $totalAndamento= ['total_empreendimentos'=> 0, 
                            'total_num_empreendimentos_ac'=> 0,'total_num_empreendimentos_al'=> 0,'total_num_empreendimentos_am'=> 0,'total_num_empreendimentos_ap'=> 0,
                            'total_num_empreendimentos_ba'=> 0,'total_num_empreendimentos_ce'=> 0,'total_num_empreendimentos_df'=> 0,'total_num_empreendimentos_es'=> 0,
                            'total_num_empreendimentos_go'=> 0,'total_num_empreendimentos_ma'=> 0,'total_num_empreendimentos_mg'=> 0,'total_num_empreendimentos_ms'=> 0,
                            'total_num_empreendimentos_mt'=> 0,'total_num_empreendimentos_ms'=> 0,'total_num_empreendimentos_pa'=> 0,'total_num_empreendimentos_pb'=> 0,
                            'total_num_empreendimentos_pe'=> 0,'total_num_empreendimentos_pi'=> 0,'total_num_empreendimentos_pr'=> 0,'total_num_empreendimentos_rj'=> 0,
                            'total_num_empreendimentos_rn'=> 0,'total_num_empreendimentos_ro'=> 0,'total_num_empreendimentos_rr'=> 0,'total_num_empreendimentos_rs'=> 0,
                            'total_num_empreendimentos_sc'=> 0,'total_num_empreendimentos_se'=> 0,'total_num_empreendimentos_sp'=> 0,'total_num_empreendimentos_to'=> 0,
                           ];
          foreach($resumoAndamentoBndes as $valor){
               
            $totalAndamento['total_empreendimentos'] += $valor->num_empreendimentos;
            $totalAndamento['total_num_empreendimentos_ac'] += $valor->num_empreendimentos_ac;
            $totalAndamento['total_num_empreendimentos_al'] += $valor->num_empreendimentos_al;
            $totalAndamento['total_num_empreendimentos_am'] += $valor->num_empreendimentos_am;
            $totalAndamento['total_num_empreendimentos_ap'] += $valor->num_empreendimentos_ap;
            $totalAndamento['total_num_empreendimentos_ba'] += $valor->num_empreendimentos_ba;
            $totalAndamento['total_num_empreendimentos_ce'] += $valor->num_empreendimentos_ce;
            $totalAndamento['total_num_empreendimentos_df'] += $valor->num_empreendimentos_df;
            $totalAndamento['total_num_empreendimentos_es'] += $valor->num_empreendimentos_es;
            $totalAndamento['total_num_empreendimentos_go'] += $valor->num_empreendimentos_go;
            $totalAndamento['total_num_empreendimentos_ma'] += $valor->num_empreendimentos_ma;
            $totalAndamento['total_num_empreendimentos_mg'] += $valor->num_empreendimentos_mg;
            $totalAndamento['total_num_empreendimentos_ms'] += $valor->num_empreendimentos_ms;
            $totalAndamento['total_num_empreendimentos_mt'] += $valor->num_empreendimentos_mt;                            
            $totalAndamento['total_num_empreendimentos_pa'] += $valor->num_empreendimentos_pa;
            $totalAndamento['total_num_empreendimentos_pb'] += $valor->num_empreendimentos_pb;
            $totalAndamento['total_num_empreendimentos_pe'] += $valor->num_empreendimentos_pe;
            $totalAndamento['total_num_empreendimentos_pi'] += $valor->num_empreendimentos_pi;
            $totalAndamento['total_num_empreendimentos_pr'] += $valor->num_empreendimentos_pr;
            $totalAndamento['total_num_empreendimentos_rj'] += $valor->num_empreendimentos_rj;
            $totalAndamento['total_num_empreendimentos_rn'] += $valor->num_empreendimentos_rn;
            $totalAndamento['total_num_empreendimentos_ro'] += $valor->num_empreendimentos_ro;
            $totalAndamento['total_num_empreendimentos_rr'] += $valor->num_empreendimentos_rr;
            $totalAndamento['total_num_empreendimentos_rs'] += $valor->num_empreendimentos_rs;
            $totalAndamento['total_num_empreendimentos_sc'] += $valor->num_empreendimentos_sc;
            $totalAndamento['total_num_empreendimentos_se'] += $valor->num_empreendimentos_se;
            $totalAndamento['total_num_empreendimentos_sp'] += $valor->num_empreendimentos_sp;
            $totalAndamento['total_num_empreendimentos_to'] += $valor->num_empreendimentos_to;
          }

        $resumoSituacaoObraBndes = ViewResumoSituacaoObraBndes::get();
        $totalSituacaoObra= ['total_empreendimentos'=> 0, 
        'total_num_empreendimentos_ac'=> 0,'total_num_empreendimentos_al'=> 0,'total_num_empreendimentos_am'=> 0,'total_num_empreendimentos_ap'=> 0,
        'total_num_empreendimentos_ba'=> 0,'total_num_empreendimentos_ce'=> 0,'total_num_empreendimentos_df'=> 0,'total_num_empreendimentos_es'=> 0,
        'total_num_empreendimentos_go'=> 0,'total_num_empreendimentos_ma'=> 0,'total_num_empreendimentos_mg'=> 0,'total_num_empreendimentos_ms'=> 0,
        'total_num_empreendimentos_mt'=> 0,'total_num_empreendimentos_ms'=> 0,'total_num_empreendimentos_pa'=> 0,'total_num_empreendimentos_pb'=> 0,
        'total_num_empreendimentos_pe'=> 0,'total_num_empreendimentos_pi'=> 0,'total_num_empreendimentos_pr'=> 0,'total_num_empreendimentos_rj'=> 0,
        'total_num_empreendimentos_rn'=> 0,'total_num_empreendimentos_ro'=> 0,'total_num_empreendimentos_rr'=> 0,'total_num_empreendimentos_rs'=> 0,
        'total_num_empreendimentos_sc'=> 0,'total_num_empreendimentos_se'=> 0,'total_num_empreendimentos_sp'=> 0,'total_num_empreendimentos_to'=> 0,
       ];
        foreach($resumoSituacaoObraBndes as $valor){

        $totalSituacaoObra['total_empreendimentos'] += $valor->num_empreendimentos;
        $totalSituacaoObra['total_num_empreendimentos_ac'] += $valor->num_empreendimentos_ac;
        $totalSituacaoObra['total_num_empreendimentos_al'] += $valor->num_empreendimentos_al;
        $totalSituacaoObra['total_num_empreendimentos_am'] += $valor->num_empreendimentos_am;
        $totalSituacaoObra['total_num_empreendimentos_ap'] += $valor->num_empreendimentos_ap;
        $totalSituacaoObra['total_num_empreendimentos_ba'] += $valor->num_empreendimentos_ba;
        $totalSituacaoObra['total_num_empreendimentos_ce'] += $valor->num_empreendimentos_ce;
        $totalSituacaoObra['total_num_empreendimentos_df'] += $valor->num_empreendimentos_df;
        $totalSituacaoObra['total_num_empreendimentos_es'] += $valor->num_empreendimentos_es;
        $totalSituacaoObra['total_num_empreendimentos_go'] += $valor->num_empreendimentos_go;
        $totalSituacaoObra['total_num_empreendimentos_ma'] += $valor->num_empreendimentos_ma;
        $totalSituacaoObra['total_num_empreendimentos_mg'] += $valor->num_empreendimentos_mg;
        $totalSituacaoObra['total_num_empreendimentos_ms'] += $valor->num_empreendimentos_ms;
        $totalSituacaoObra['total_num_empreendimentos_mt'] += $valor->num_empreendimentos_mt;                            
        $totalSituacaoObra['total_num_empreendimentos_pa'] += $valor->num_empreendimentos_pa;
        $totalSituacaoObra['total_num_empreendimentos_pb'] += $valor->num_empreendimentos_pb;
        $totalSituacaoObra['total_num_empreendimentos_pe'] += $valor->num_empreendimentos_pe;
        $totalSituacaoObra['total_num_empreendimentos_pi'] += $valor->num_empreendimentos_pi;
        $totalSituacaoObra['total_num_empreendimentos_pr'] += $valor->num_empreendimentos_pr;
        $totalSituacaoObra['total_num_empreendimentos_rj'] += $valor->num_empreendimentos_rj;
        $totalSituacaoObra['total_num_empreendimentos_rn'] += $valor->num_empreendimentos_rn;
        $totalSituacaoObra['total_num_empreendimentos_ro'] += $valor->num_empreendimentos_ro;
        $totalSituacaoObra['total_num_empreendimentos_rr'] += $valor->num_empreendimentos_rr;
        $totalSituacaoObra['total_num_empreendimentos_rs'] += $valor->num_empreendimentos_rs;
        $totalSituacaoObra['total_num_empreendimentos_sc'] += $valor->num_empreendimentos_sc;
        $totalSituacaoObra['total_num_empreendimentos_se'] += $valor->num_empreendimentos_se;
        $totalSituacaoObra['total_num_empreendimentos_sp'] += $valor->num_empreendimentos_sp;
        $totalSituacaoObra['total_num_empreendimentos_to'] += $valor->num_empreendimentos_to;
        }
        $resumoSituacaoContratoBndes = ViewResumoSituacaoContratoBndes::get();
      

       
        return view('modulo_bndes.home_bndes',compact('usuario','resumoAndamentoBndes','resumoSituacaoObraBndes','resumoSituacaoContratoBndes',
                                            'totalAndamento','totalSituacaoObra'));
    }


}
