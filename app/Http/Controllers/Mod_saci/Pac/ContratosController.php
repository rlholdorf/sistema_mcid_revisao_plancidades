<?php

namespace App\Http\Controllers\Mod_saci\Pac;

use App\Corporativo\Pendencias_caixa\ObraFisica;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Auth;


use App\User;

use App\Mod_saci\mod_pac\Andamento;
use App\Mod_saci\mod_pac\AgenteFinanceiro;
use App\Mod_saci\mod_pac\Chamada;
use App\Mod_saci\mod_pac\ClassificacaoCor;
use App\Mod_saci\mod_pac\ContratosPac;
use App\Mod_saci\mod_pac\Entidade;
use App\Mod_saci\mod_pac\Eixo;
use App\Mod_saci\mod_pac\Evento;
use App\Mod_saci\mod_pac\Fase;
use App\Mod_saci\mod_pac\Fonte;
use App\Mod_saci\mod_pac\ModalidadePAC;
use App\Mod_saci\mod_pac\Programa;
use App\Mod_saci\mod_pac\SituacaoContrato;
use App\Mod_saci\mod_pac\SituacaoObraPAC;
use App\Mod_saci\mod_pac\DadosArquivosSelecaoSecretaria;
use App\Mod_saci\mod_pac\ArquivoSelecaoSecretaria;
use App\Mod_saci\mod_pac\SituacaoArquivo;
use App\Mod_saci\mod_pac\Tipo;
use App\Mod_saci\mod_pac\RegistroContratosPacCadastrados;
use App\Mod_saci\mod_pac\MunicipioBeneficiado;



use App\Mod_saci\mod_sistema\Area;
use App\Mod_saci\mod_sistema\Secretaria;
use App\Mod_saci\mod_sistema\Usuario;
use App\Mod_saci\mod_sistema\Permissao;

use App\Mod_saci\mod_ibge\Regiao;
use App\Mod_saci\mod_ibge\Municipio;
use App\Mod_saci\mod_ibge\Uf;
use App\Mod_saci\mod_pac\VisBaseCaixa;
use App\Mod_saci\mod_pac\VisContratosPAC;
use App\Mod_saci\mod_pac\VisMunicipiosBeneficiados;
use App\Mod_saci\mod_pac\VisParalisadas;

class ContratosController extends Controller
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
    public function index()
    {
        $usuario = Auth::user();

        if ($usuario->status_usuario_id == 2) {

            return redirect('/usuario/primeiro_acesso');
        }


        return view('modulo_saci.painel_saci');
    }
    public function importarArquivo()
    {

        $agente_financeiro = AgenteFinanceiro::orderBy('dsc_agente_financeiro')->get();
        $classificacaoCor = ClassificacaoCor::orderBy('dsc_classificacao_cor')->get();
        $entidade = Entidade::orderBy('dsc_entidade')->get();
        $fonte = Fonte::orderBy('dsc_fonte')->get();
        $modalidade =  ModalidadePAC::orderBy('dsc_modalidade')->get();
        $situacaoContrato = SituacaoContrato::orderBy('dsc_situacao_contrato')->get();
        $situacaoObra = SituacaoObraPAC::orderBy('dsc_situacao_obra')->get();
        $secretaria = Secretaria::where('cod_secretaria', '!=', 6)->orderBy('dsc_secretaria')->get();

        return view('modulo_saci.importar_arquivo', compact(
            'agente_financeiro',
            'classificacaoCor',
            'entidade',
            'fonte',
            'modalidade',
            'situacaoContrato',
            'situacaoObra',
            'secretaria'
        ));
    }

    public function excluirArquivoImportado($cod_arquivo)
    {
        DB::beginTransaction();
        $dadosArquivo = ArquivoSelecaoSecretaria::find($cod_arquivo);
        $deletouRegistro = $dadosArquivo->delete();

        if (!$deletouRegistro) {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível excluir o arquivo desejado.");
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Arquivo excluído com sucesso!");

            return redirect('/saci/propostas/arquivo/consultar');
        }
    }



    public function salvarDadosArquivo(Request $request)
    {

        // return $request->all();
        $arquivo = $request->file('txt_caminho_arquivo');
        $cabecalhoValido  = array(
            "txt_fonte",
            "txt_area",
            "txt_chamada",
            "contrato",
            "num_protocolo",
            "sequencial",
            "txt_situacao_contrato",
            "txt_agefin",
            "txt_uf",
            "txt_entidade",
            "txt_modalidade",
            "txt_submodalidade",
            "empreendimento",
            "objeto",
            "descricao_do_objeto",
            "valor_de_emprestimo_r",
            "valor_de_contrapartida_r",
            "data_da_selecao",
            "fase",
            "mcid",
            "txt_situacao_obra",
            "txt_classificacao_cor",
            "bln_ativo",
            "txt_entidade_tomador",
            "txt_entidade_executora",
            "txt_eixo",
            "txt_subeixo",
            "txt_tipo",
            "txt_subtipo",
            "txt_pt",
            "vlr_taxa_administrativa",
            "txt_programa",
        );



        $extensao = $arquivo->extension();


        // if para saber extensão
        if (($extensao == 'xlsx') || ($extensao == 'xls')) {
            if ($request->hasFile('txt_caminho_arquivo')) { //if para saber se tem arquivo
                $path = $request->file('txt_caminho_arquivo')->getRealPath();
                $dadosArquivo = Excel::load($path, function ($reader) {
                })->get();
                $nomeArquivo = $request->file('txt_caminho_arquivo')->getClientOriginalName();
                if (!empty($dadosArquivo) && $dadosArquivo->count()) { //fim if para saber se o arquivo esta vazio

                    $cabecalhoArquivo = $dadosArquivo->first()->keys()->toArray(); //retorna o cabeçalho do arquivo                 
                    $comparacaoCabecalho = count(array_diff_assoc($cabecalhoValido, $cabecalhoArquivo)); //diferença no cabeçalho

                    if ($comparacaoCabecalho == 0) { //if para saber se o cabeçalho é diferente
                        DB::beginTransaction();
                        //salvar os dados do arquivo
                        $numeroRegistroArquivo = 0;
                        foreach ($dadosArquivo as $dados) {
                            $numeroRegistroArquivo += 1;
                        }

                        $dadosArquivoSelecao = new ArquivoSelecaoSecretaria;
                        $dadosArquivoSelecao->txt_nome_arquivo =  $nomeArquivo;
                        $dadosArquivoSelecao->num_registros =  $numeroRegistroArquivo;
                        $dadosArquivoSelecao->cod_situacao_arquivo =  1;
                        $dadosArquivoSelecao->cod_secretaria =  $request->secretaria;
                        $dadosArquivoSelecao->cod_usuario =  1;
                        $dadosArquivoSelecao->created_at = Date('Y-m-d');

                        $salvouDadosArquivo = $dadosArquivoSelecao->save();

                        if ($salvouDadosArquivo) { //if para saber se salvou os dados resumidos do arquivo

                            foreach ($dadosArquivo as $dados) {

                                $selecaoSecretaria = new DadosArquivosSelecaoSecretaria;
                                //$selecaoSecretaria->cod_contrato_pac = $dados->cod_contrato_pac;
                                $selecaoSecretaria->txt_fonte = $dados->txt_fonte;
                                $selecaoSecretaria->txt_area = $dados->txt_area;
                                $selecaoSecretaria->txt_contrato = $dados->contrato;
                                $selecaoSecretaria->txt_protocolo = $dados->num_protocolo;
                                $selecaoSecretaria->txt_sequencial = $dados->sequencial;
                                $selecaoSecretaria->txt_situacao_contrato = $dados->txt_situacao_contrato;
                                $selecaoSecretaria->txt_agefin = $dados->txt_agefin;
                                $selecaoSecretaria->txt_uf = $dados->txt_uf;
                                $selecaoSecretaria->txt_entidade = $dados->txt_entidade;
                                $selecaoSecretaria->txt_modalidade = $dados->txt_modalidade;
                                $selecaoSecretaria->txt_submodalidade = $dados->txt_submodalidade;
                                $selecaoSecretaria->txt_empreendimento = $dados->empreendimento;
                                $selecaoSecretaria->txt_objeto = $dados->objeto;
                                $selecaoSecretaria->dsc_objeto = $dados->descricao_do_objeto;
                                $selecaoSecretaria->vlr_emprestimo = $dados->valor_de_emprestimo_r;
                                $selecaoSecretaria->vlr_contrapartida = $dados->valor_de_contrapartida_r;
                                $selecaoSecretaria->txt_chamada = $dados->txt_chamada;
                                $selecaoSecretaria->dte_selecao = $dados->data_da_selecao;
                                $selecaoSecretaria->num_fase = $dados->fase;
                                $selecaoSecretaria->txt_mcid = $dados->mcid;
                                $selecaoSecretaria->txt_situacao_obra = $dados->txt_situacao_obra;
                                $selecaoSecretaria->txt_classificacao_cor = $dados->txt_classificacao_cor;
                                if ($dados->bln_ativo == 'Ativo') {
                                    $selecaoSecretaria->bln_ativo = 1;
                                } else {
                                    $selecaoSecretaria->bln_ativo = 0;
                                }
                                $selecaoSecretaria->txt_entidade_tomador = $dados->txt_entidade_tomador;
                                $selecaoSecretaria->txt_entidade_executora = $dados->txt_entidade_executora;
                                $selecaoSecretaria->txt_eixo = $dados->txt_eixo;
                                $selecaoSecretaria->txt_subeixo = $dados->txt_subeixo;
                                $selecaoSecretaria->txt_tipo = $dados->txt_tipo;
                                $selecaoSecretaria->txt_subtipo = $dados->txt_subtipo;
                                $selecaoSecretaria->txt_pt = $dados->txt_pt;
                                $selecaoSecretaria->vlr_taxa_administrativa = $dados->vlr_taxa_administrativa;
                                $selecaoSecretaria->txt_programa = $dados->txt_programa;
                                $selecaoSecretaria->cod_arquivos_selecao_secretaria = $dadosArquivoSelecao->cod_arquivos_selecao_secretaria;
                                $selecaoSecretaria->created_at = Date('Y-m-d');

                                $salvouSelecao = $selecaoSecretaria->save();
                            }

                            if ($salvouSelecao) { //if para saber se salvou os dados                                
                                DB::commit();
                                flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!");
                                return redirect('/saci/proposta/importada/' . $dadosArquivoSelecao->cod_arquivos_selecao_secretaria);
                            } else {
                                DB::rollBack();
                                flash()->erro("Erro", "Erro salvar os dados importados!");
                                return back();
                            } //fim if para saber se salvou os dados                                 

                        } else {
                            DB::rollBack();
                            flash()->erro("Erro", "Erro salvar os dados resumidos do arquivo importado!");
                            return back();
                        } //fim if para saber se salvou os dados resumidos do arquivo


                    } else {
                        flash()->erro("Erro: Cabeçalho inválido", "O cabeçalho do arquivo esta incorreto");
                        return back();
                    } //fim if para saber se o cabeçalho é diferente
                } else {
                    flash()->erro("Erro", "Arquivo Vazio, o arquivo importado não possui registros.");
                    return back();
                } //fim if para saber se o arquivo esta vazio


            } //fim if para saber se tem arquivo 
        } else {

            flash()->erro("Erro", "Arquivo inválido, os arquivos válidos são dos tipos .xlsx e .xls");
            return back();
        } //fim if para saber extensão

    }

    public function arquivoImportado($cod_arquivo)
    {
        $dadosArquivo = ArquivoSelecaoSecretaria::find($cod_arquivo);

        $dadosArquivo->load('secretaria', 'situacaoArquivo');
        $dadosSelecao = DadosArquivosSelecaoSecretaria::where('cod_arquivos_selecao_secretaria', $cod_arquivo)->get();

        return view('modulo_saci.dadosArquivoImportado', compact('dadosArquivo', 'dadosSelecao'));
    }

    public function validarArquivo(Request $request)
    {
        DB::beginTransaction();

        $dadosArquivoSelecao = ArquivoSelecaoSecretaria::find($request->cod_arquivos_selecao_secretaria);
        if ($request->validar_arquivo == 0) {
            $dadosArquivoSelecao->cod_situacao_arquivo = 3;
            $dadosArquivoSelecao->txt_justificativa = $request->txt_justificativa;
        } else {
            $dadosArquivoSelecao->cod_situacao_arquivo = 2;
            $dadosArquivoSelecao->txt_justificativa = null;

            return $dadosSelecao = DadosArquivosSelecaoSecretaria::where('cod_arquivos_selecao_secretaria', $request->cod_arquivos_selecao_secretaria)->get();
        }

        $dadosArquivoSelecao->cod_usuario = 1;
        $dadosArquivoSelecao->dte_validacao = Date('Y-m-d');
        $dadosArquivoSelecao->updated_at = Date('Y-m-d');

        $salvoValidar = $dadosArquivoSelecao->update();

        if ($salvoValidar) {
            DB::commit();
            flash()->sucesso("Sucesso", "Arquivo validado com sucesso!");
            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível validar o arquivo");
            return back();
        }
    }

    public function cancelarValidacao(Request $request)
    {
        DB::beginTransaction();

        $dadosArquivoSelecao = ArquivoSelecaoSecretaria::find($request->cod_arquivos_selecao_secretaria);


        $dadosArquivoSelecao->cod_situacao_arquivo = 1;
        $dadosArquivoSelecao->txt_justificativa = null;
        $dadosArquivoSelecao->dte_validacao = null;
        $dadosArquivoSelecao->cod_usuario = null;

        $dadosArquivoSelecao->updated_at = Date('Y-m-d');

        $salvoValidar = $dadosArquivoSelecao->update();

        if ($salvoValidar) {
            DB::commit();
            flash()->sucesso("Sucesso", "Validação cancelada validado com sucesso!");
            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cancelar a validação do arquivo");
            return back();
        }
    }

    public function consultarArquivos()
    {


        $secretaria = Secretaria::where('cod_secretaria', '!=', 6)->orderBy('dsc_secretaria')->get();
        $situacao = SituacaoArquivo::orderBy('dsc_situacao_arquivo')->get();
        $arquivos = ArquivoSelecaoSecretaria::get();

        $arquivos->load('secretaria', 'situacaoArquivo');
        return view('modulo_saci.consultar_arquivo', compact('arquivos', 'secretaria', 'situacao'));
    }

    public function pesquisarArquivos(Request $request)
    {
        $secretaria = Secretaria::where('cod_secretaria', '!=', 6)->orderBy('dsc_secretaria')->get();
        $situacao = SituacaoArquivo::orderBy('dsc_situacao_arquivo')->get();

        $where = [];
        if ($request->secretaria) {
            $where[] = ['cod_secretaria', $request->secretaria];
        }

        if ($request->situacao) {
            $where[] = ['cod_situacao_arquivo', $request->situacao];
        }

        //return  $where;

        $arquivos = ArquivoSelecaoSecretaria::where($where)->get();
        //return count($arquivos);
        if (count($arquivos) > 0) {
            $arquivos->load('secretaria');
            return view('modulo_saci.lista_arquivos', compact('arquivos', 'secretaria', 'situacao'));
        } else {
            $arquivos = ArquivoSelecaoSecretaria::get();

            $arquivos->load('secretaria');
            flash()->erro("Erro", "Não existem arquivos para os parâmetros selecionados");
            return view('modulo_saci.consultar_arquivo', compact('arquivos', 'secretaria', 'situacao'));
        }
    }



    public function cadastroProposta()
    {

        // return Auth::user();

        $usuario = Auth::user();

        $loginEmail = substr($usuario->email, 0, strpos($usuario->email, '@'));
        $usuarioPAC = Usuario::where('txt_login_usuario', $loginEmail)->first();

        if ((!$usuarioPAC) && ($usuario->tipo_usuario_id != 1)) {
            flash()->erro("Erro", "Usuário não cadastrado no SACI");
            return back();
        }

        if ($usuarioPAC->cod_nivel == 9) {
            return view('modulo_saci.cadastrar_proposta', compact('usuarioPAC'));
        } else {
            flash()->erro("Erro", "Somente Administradores podem candastrar contratos");
            return back();
        }
    }

    public function salvarProposta(Request $request)
    {

        //return  $request->all();

        $contrato = ContratosPac::salvarContratos($request);

        if (!empty($contrato)) {
            DB::beginTransaction();

            $registro = new RegistroContratosPacCadastrados;
            $registro->cod_contrato_pac =  $contrato;
            $registro->bln_importado_por_arquivo = false;
            $registro->created_at = Date('Y-m-d');
            $salvoRegistro = $registro->save();

            $permissao = new Permissao;
            $permissao->cod_contrato_pac =   $contrato;
            $permissao->cod_usuario =   $request->monitor;
            $permissao->bln_altera =   true;
            $permissao->bln_inclui =   false;
            $permissao->bln_exclui =   false;
            $permissao->cod_tipo_transferencia =   2;
            $salvoPermissao = $permissao->save();

            $municipio = new MunicipioBeneficiado;
            $municipio->cod_contrato_pac = $contrato;
            $municipio->cod_municipio_ibge = $request->municipio;
            $municipio->bln_principal = true;
            $salvoMunicipio = $municipio->save();

            $salvouMunicipioBeneficiado = true;
            if ($request->municipiosBeneficiados) {
                foreach ($request->municipiosBeneficiados as $municipio) {
                    $salvouMunicipioBeneficiado = MunicipioBeneficiado::salvarMunicipioBeneficiado($contrato, $municipio, false);
                }
            }

            if ($salvoRegistro && $salvoPermissao && $salvoMunicipio && $salvouMunicipioBeneficiado) {
                DB::commit();
                flash()->sucesso("Sucesso", "Contrato salvo com sucesso!");
                return redirect('/saci/contrato/' . $registro->cod_contrato_pac);
            } else {
                DB::rollBack();
                flash()->erro("Erro", "Não foi possível salvar os dados do contrato");
                return back();
            }
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível salvar os dados do contrato");
            return back();
        }
    }

    public function Saci($contratoPac)
    {

        //     return $contratoPac;
        $where = [];
        $where[] = ['tab_contratos_pac.cod_contrato_pac', $contratoPac];
        $where[] = ['rlc_municipios_beneficiarios.bln_principal', true];

        $contrato = ContratosPac::leftjoin('sistema.opc_areas', 'opc_areas.cod_area', '=', 'tab_contratos_pac.cod_area')
            ->join('tab_registro_contratos_pac_cadastrados', 'tab_registro_contratos_pac_cadastrados.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
            ->join('sistema.tab_usuarios', 'tab_usuarios.cod_usuario', '=', 'tab_contratos_pac.cod_usuario')
            ->join('sistema.tab_permissoes', 'tab_permissoes.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
            ->join('rlc_municipios_beneficiarios', 'rlc_municipios_beneficiarios.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
            ->select(
                'tab_contratos_pac.*',
                'tab_permissoes.cod_usuario as cod_usuario_monitor',
                'txt_nome',
                'txt_login_usuario',
                'opc_areas.cod_secretaria',
                'cod_municipio_ibge',
                'tab_registro_contratos_pac_cadastrados.bln_importado_por_arquivo'
            )
            ->where($where)->first();

        // $contrato->load('situacaoContrato');

        $where = [];
        $where[] = ['cod_contrato_pac', $contrato->cod_contrato_pac];
        $where[] = ['bln_principal', false];
        //    return $where;
        $municipioBen = MunicipioBeneficiado::where($where)->get();

        $usuario = Auth::user();

        $loginEmail = substr($usuario->email, 0, strpos($usuario->email, '@'));
        $usuarioPAC = Usuario::where('txt_login_usuario', $loginEmail)->first();

        if ($usuarioPAC  || ($usuario->tipo_usuario_id == 1)) {
            return view('modulo_saci.dados_proposta', compact('contrato', 'usuarioPAC', 'usuario', 'municipioBen'));
        } else {
            flash()->erro("Erro", "Usuário não cadastrado no SACI");
            return back();
        }
    }

    public function atualizarProposta(Request $request)
    {
        DB::beginTransaction();
        //return  $request->all();
        //retorna dados do contrato
        $whereCont = [];
        $whereCont[] = ['tab_contratos_pac.cod_contrato_pac', $request->cod_contrato_pac];
        $whereCont[] = ['rlc_municipios_beneficiarios.bln_principal', true];

        $contratosPac = ContratosPac::leftjoin('sistema.opc_areas', 'opc_areas.cod_area', '=', 'tab_contratos_pac.cod_area')
            ->join('tab_registro_contratos_pac_cadastrados', 'tab_registro_contratos_pac_cadastrados.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
            ->join('sistema.tab_usuarios', 'tab_usuarios.cod_usuario', '=', 'tab_contratos_pac.cod_usuario')
            ->join('sistema.tab_permissoes', 'tab_permissoes.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
            ->join('rlc_municipios_beneficiarios', 'rlc_municipios_beneficiarios.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
            ->select(
                'tab_contratos_pac.*',
                'tab_permissoes.cod_usuario as cod_usuario_monitor',
                'txt_nome',
                'txt_login_usuario',
                'opc_areas.cod_secretaria',
                'cod_municipio_ibge',
                'tab_registro_contratos_pac_cadastrados.bln_importado_por_arquivo'
            )
            ->where($whereCont)->first();

        //retorna o municipio principal
        $where = [];
        $where[] = ['cod_contrato_pac', $request->cod_contrato_pac];
        $where[] = ['bln_principal', true];

        $municipioPrincipal = MunicipioBeneficiado::where($where)->first();

        $salvoMunicipiosBen = true;

        if ($contratosPac->cod_uf != $request->cod_uf) {
            //limpa os municipios na tabela
            $deletouMunicipios = MunicipioBeneficiado::limparMunicipiosBeneficiados($request->cod_contrato_pac, null);

            if ($deletouMunicipios) {
                //salvar municipio principal
                $salvouMunicipioPrincipal = MunicipioBeneficiado::salvarMunicipioBeneficiado($request->cod_contrato_pac, $request->municipio, true);

                if ($salvouMunicipioPrincipal) {

                    if ($request->municipiosBeneficiados) {
                        //loop para salvar os municipios beneficiaros escolhidos
                        foreach ($request->municipiosBeneficiados as $dados) {
                            $municipiosBen = new MunicipioBeneficiado;
                            $salvouMunicipioBeneficiado = MunicipioBeneficiado::salvarMunicipioBeneficiado($request->cod_contrato_pac, $dados, false);
                        }

                        if ($salvouMunicipioBeneficiado) {
                            $salvoMunicipiosBen = true;
                        }
                    }
                } else {
                    $salvoMunicipiosBen = false;
                }
            } else {
                $salvoMunicipiosBen = false;
            }
        } else {


            //verifica se alterou o municipio principal
            if ($municipioPrincipal->cod_municipio_ibge != $request->municipio) {
                $deletouMunicipios = MunicipioBeneficiado::limparMunicipiosBeneficiados($request->cod_contrato_pac, null);
                $municipio = new MunicipioBeneficiado;

                $municipio->cod_contrato_pac = $request->cod_contrato_pac;
                $municipio->cod_municipio_ibge = $request->municipio;
                $municipio->bln_principal = true;
                $salvouMunicipioPrincipal =  $municipio->save();

                if ($salvouMunicipioPrincipal) {
                    $salvoMunicipiosBen = true;
                } else {
                    $salvoMunicipiosBen = false;
                }
            } else {
                $deletouMunicipios = MunicipioBeneficiado::limparMunicipiosBeneficiados($request->cod_contrato_pac, 'false');
            }



            if ($request->municipiosBeneficiados) {
                if ($deletouMunicipios) {
                    foreach ($request->municipiosBeneficiados as $municipio) {
                        $salvouMunicipioBeneficiado = MunicipioBeneficiado::salvarMunicipioBeneficiado($request->cod_contrato_pac, $municipio, false);
                    }
                    if ($salvouMunicipioBeneficiado) {
                        $salvoMunicipiosBen = true;
                    } else {
                        $salvoMunicipiosBen = false;
                    }
                }
            }
        }

        $salvoPermissao = true;
        if ($request->monitor != $contratosPac->cod_usuario_monitor) {
            $permissao = Permissao::where('cod_contrato_pac', $request->cod_contrato_pac)->first();
            $permissao->cod_usuario =   $request->monitor;
            $salvoPermissao = $permissao->save();
        }


        $atualizaContrato = ContratosPac::atualizarContratos($request);

        //  return $atualizaContrato .' - ' . $salvoPermissao .' - ' .  $salvoMunicipiosBen;
        if ($atualizaContrato && $salvoPermissao && $salvoMunicipiosBen) {
            DB::commit();
            flash()->sucesso("Sucesso", "Contrato atualizado com sucesso!");
            return redirect('/saci/contrato/' . $request->cod_contrato_pac);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar os dados do contrato");
            return back();
        }
    }

    public function  consultarRegistros()
    {


        $usuario = Auth::user();

        $loginEmail = substr($usuario->email, 0, strpos($usuario->email, '@'));
        $usuarioPAC = Usuario::where('txt_login_usuario', $loginEmail)->first();

        if ((!$usuarioPAC) && ($usuario->tipo_usuario_id != 1)) {
            flash()->erro("Erro", "Usuário não cadastrado no SACI");
            return back();
        } else {
            if ($usuario->tipo_usuario_id == 1) {
                $registros = ContratosPac::leftjoin('sistema.opc_areas', 'opc_areas.cod_area', '=', 'tab_contratos_pac.cod_area')
                    ->join('tab_registro_contratos_pac_cadastrados', 'tab_registro_contratos_pac_cadastrados.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
                    ->join('sistema.tab_usuarios', 'tab_usuarios.cod_usuario', '=', 'tab_contratos_pac.cod_usuario')
                    ->select('tab_contratos_pac.*', 'txt_login_usuario', 'opc_areas.cod_secretaria', 'tab_registro_contratos_pac_cadastrados.bln_importado_por_arquivo')
                    ->get();
            } else {
                $registros = ContratosPac::leftjoin('sistema.opc_areas', 'opc_areas.cod_area', '=', 'tab_contratos_pac.cod_area')
                    ->join('tab_registro_contratos_pac_cadastrados', 'tab_registro_contratos_pac_cadastrados.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
                    ->join('sistema.tab_usuarios', 'tab_usuarios.cod_usuario', '=', 'tab_contratos_pac.cod_usuario')
                    ->select('tab_contratos_pac.*', 'txt_login_usuario', 'opc_areas.cod_secretaria', 'tab_registro_contratos_pac_cadastrados.bln_importado_por_arquivo')
                    ->where('tab_contratos_pac.cod_usuario', $usuarioPAC->cod_usuario)
                    ->get();
            }
        }

        //return  $registros;


        return view('modulo_saci.consultar_registros', compact('registros', 'usuarioPAC'));
    }

    public function pesquisarRegistros(Request $request)
    {

        $usuario = Auth::user();

        $loginEmail = substr($usuario->email, 0, strpos($usuario->email, '@'));
        $usuarioPAC = Usuario::where('txt_login_usuario', $loginEmail)->first();

        if ((!$usuarioPAC) && ($usuario->tipo_usuario_id != 1)) {
            flash()->erro("Erro", "Usuário não cadastrado no SACI");
            return back();
        }
        //return $request->all();


        $where = [];
        $subtitulo1 = null;
        if ($request->bln_importado_por_arquivo) {

            if ($request->bln_importado_por_arquivo == 'arquivo') {
                $where[] = ['bln_importado_por_arquivo', true];
                $subtitulo1 = 'Registro importado por aquivo';
            } else {
                $where[] = ['bln_importado_por_arquivo', false];
                $subtitulo1 = 'Registro cadastro pelo formulário';
            }
        }

        $dataInicial = null;
        $dataFinal = null;

        $subtitulo2 = null;
        if ($request->dte_carga_inicial) {
            $dataInicial = $request->dte_carga_inicial;
            $dataFinal = $request->dte_carga_inicial;
            if ($subtitulo1) {
                $subtitulo2 = 'Propostas cadastras em ' . date('d/m/Y', strtotime($dataInicial));
            } else {
                $subtitulo1 = 'Propostas cadastras em ' . date('d/m/Y', strtotime($dataInicial));
            }
        }

        if ($request->dte_carga_final) {
            $dataFinal = $request->dte_carga_final;
            if ($subtitulo1) {
                $subtitulo2 = 'Período: de ' . date('d/m/Y', strtotime($dataInicial)) . ' até ' . date('d/m/Y', strtotime($dataFinal));
            } else {
                $subtitulo1 = 'Período: de ' . date('d/m/Y', strtotime($dataInicial)) . ' até ' . date('d/m/Y', strtotime($dataFinal));
            }
        }

        if ($request->dte_carga_inicial || $request->dte_carga_final) {
            $registros = ContratosPac::leftjoin('sistema.opc_areas', 'opc_areas.cod_area', '=', 'tab_contratos_pac.cod_area')
                ->join('tab_registro_contratos_pac_cadastrados', 'tab_registro_contratos_pac_cadastrados.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
                ->join('sistema.tab_usuarios', 'tab_usuarios.cod_usuario', '=', 'tab_contratos_pac.cod_usuario')
                ->select('tab_contratos_pac.*', 'txt_login_usuario', 'opc_areas.cod_secretaria', 'tab_registro_contratos_pac_cadastrados.bln_importado_por_arquivo')
                ->where($where)
                ->whereBetween('dte_carga', [$dataInicial, $dataFinal])
                ->orderBy('dte_carga')
                ->get();
        } else {
            $registros = ContratosPac::leftjoin('sistema.opc_areas', 'opc_areas.cod_area', '=', 'tab_contratos_pac.cod_area')
                ->join('tab_registro_contratos_pac_cadastrados', 'tab_registro_contratos_pac_cadastrados.cod_contrato_pac', '=', 'tab_contratos_pac.cod_contrato_pac')
                ->join('sistema.sistema.tab_usuarios', 'tab_usuarios.cod_usuario', '=', 'tab_contratos_pac.cod_usuario')
                ->select('tab_contratos_pac.*', 'txt_login_usuario', 'opc_areas.cod_secretaria', 'tab_registro_contratos_pac_cadastrados.bln_importado_por_arquivo')
                ->where($where)
                ->orderBy('dte_carga')
                ->get();
        }

        // return $registros;

        if (count($registros) == 0) {
            flash()->erro("Erro", "Não existe registros para o parâmetros selecionados");
            return back();
        }


        return view('modulo_saci.lista_registros', compact('registros', 'subtitulo1', 'subtitulo2'));
    }

    public function filtroContratos()
    {

        return view('modulo_saci.consultar_contratos_saci');
    }

    public function PesquisarContratos(Request $request)
    {

        //return $request->all();

        $where = [];
        $subtitulo1 = null;

        if ($request->cod_uf) {
            $where[] = ['cod_uf', $request->cod_uf];
        }

        if ($request->municipio) {
            $where[] = ['cod_ibge', $request->municipio];
        }

        if ($request->cod_area) {
            $where[] = ['cod_area', $request->cod_area];
        }


        if ($request->monitor) {
            $where[] = ['monitor', $request->monitor];
        }

        if ($request->fase) {
            $where[] = ['cod_fase', $request->fase];
        }

        if ($request->cod_modalidade) {
            $where[] = ['cod_modalidade', $request->cod_modalidade];
        }

        if ($request->cod_submodalidade) {
            $where[] = ['cod_submodalidade', $request->cod_submodalidade];
        }

        if ($request->cod_fonte) {
            $where[] = ['cod_fonte', $request->cod_fonte];
        }

        if ($request->situacao_contrato) {
            $where[] = ['cod_situacao_contrato', $request->situacao_contrato];
        }

        if ($request->situacao_obra) {
            $where[] = ['cod_situacao_obra', $request->situacao_obra];
        }

        if ($request->programa) {
            $where[] = ['cod_programa', $request->programa];
        }

        if ($request->bln_ativo) {
            $where[] = ['cod_programa', $request->bln_ativo];
        }


        $contratosPAC = VisContratosPAC::where($where)
            ->orderBy('txt_sigla_uf')
            ->orderBy('txt_municipio')
            ->get();

        if (count($contratosPAC) == 0) {
            flash()->erro("Erro", "Não existe contratos para o parâmetros selecionados");
            return back();
        } else {

            return view('modulo_saci.lista_contratos_saci', compact('contratosPAC'));
        }
    }

    public function dadosContratoSaci($contratoSaci)
    {

        $contratoPAC = VisContratosPAC::find($contratoSaci);

        $contratoBaseCaixa = VisBaseCaixa::find($contratoPAC->cod_contrato);

        $paralisada = VisParalisadas::find($contratoPAC->cod_contrato);

        $pendeciasCaixa = ObraFisica::find($contratoPAC->cod_contrato);

        $municipioBeneficiados = VisMunicipiosBeneficiados::where('cod_contrato_pac', $contratoSaci)->get();


        return view('modulo_saci.dados_contrato_saci', compact('contratoPAC', 'contratoBaseCaixa', 'paralisada', 'pendeciasCaixa', 'municipioBeneficiados'));
    }
}
