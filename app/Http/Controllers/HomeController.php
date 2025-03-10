<?php

namespace App\Http\Controllers;

use App\Corporativo\Mcid_carteira_investimento\ViewResumoSecretariaOrigem;
use App\Corporativo\Mcid_carteira_investimento\ViewResumoSituacaoContrato;
use App\Corporativo\Mcid_carteira_investimento\ViewResumoTipoInstrumentoOrigem;
use App\DadosPaineis;
use App\EntePublico;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Propostas\SelecaoPropostas;
use App\Propostas\ViewPropostasCadastradas;
use App\Propostas\ViewPropostasCadastradasUf;
use App\Secretaria;
use App\ViewArquivosEnviados;
use DirectoryIterator;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Enum_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirecionar');
        //       $this->middleware('moduloUsuario');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        $usuario = Auth::user();





        //return $totalProposta;
        $where = [];
        $where[] = ['bln_oficio', true];



        $arquivosOficio = ViewArquivosEnviados::selectRaw('sg_uf, 
                                                    count(usuario_id) as num_oficios,
                                                    SUM(CASE WHEN bln_documento_analisado = false THEN 1 ELSE 0 END) AS num_aguardando_analise,
                                                    SUM(CASE WHEN bln_documento_analisado = TRUE and bln_documento_validado = true  THEN 1 ELSE 0 END) AS num_validado,
                                                    SUM(CASE WHEN bln_documento_analisado = TRUE AND bln_documento_validado = false  THEN 1 ELSE 0 END) AS num_invalidado')
            ->where($where)
            ->groupBy('sg_uf')
            ->get();

        $totalOficios = [
            'total_oficios' => 0,
            'total_num_aguardando_analise' => 0,
            'total_num_validado' => 0,
            'total_num_invalidado' => 0
        ];

        foreach ($arquivosOficio as $valor) {

            $totalOficios['total_oficios'] += $valor->num_oficios;
            $totalOficios['total_num_aguardando_analise'] += $valor->num_aguardando_analise;
            $totalOficios['total_num_validado'] += $valor->num_validado;
            $totalOficios['total_num_invalidado'] += $valor->num_invalidado;
        }



        $selecaoProposta = SelecaoPropostas::orderBy('dte_resultado')->get();

        //$selecaoProposta = '';
        $wherePainel = [];
        $wherePainel[] = ['bln_ativo', true];
        //$wherePainel[] = ['bln_acesso_externo',false];

        $dadosPaineis = DadosPaineis::where($wherePainel)->get();

        $resumoTipoInstrumento = ViewResumoTipoInstrumentoOrigem::get();
        $resumoSecretaria = ViewResumoSecretariaOrigem::get();
        $resumoSituacaoContrato = ViewResumoSituacaoContrato::get();


        return view(
            'home',
            compact(
                'usuario',
                'arquivosOficio',
                'totalOficios',
                'selecaoProposta',
                'dadosPaineis',
                'resumoTipoInstrumento',
                'resumoSecretaria',
                'resumoSituacaoContrato'
            )
        );
    }
}