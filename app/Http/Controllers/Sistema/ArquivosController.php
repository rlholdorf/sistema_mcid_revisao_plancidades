<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;


use DB;


use App\User;
use App\Mail\PermissaoDeferida;
use App\Mail\PermissaoIndeferida;
use App\Permissoes;

use App\RlcArquivoUser;
use App\RlcEmailInstitucionalEnte;
use App\ViewArquivosEnviados;
use DirectoryIterator;
use Illuminate\Support\Facades\Auth;

use App\Imports\Mod_resultado_primario\FileRP8Import;
use Maatwebsite\Excel\Facades\Excel;

class ArquivosController extends Controller
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

    public function consultarOficiosEnte()
    {
        $whereOficio = [];

        $whereOficio[] = ['bln_oficio', true];
        $whereOficio[] = ['bln_documento_analisado', false];

        $arquivosOficio = ViewArquivosEnviados::where($whereOficio)
            ->where($whereOficio)
            ->orderBy('dte_envio', 'ASC')
            ->get();

        $cabecalhoTab = ['id', 'UF', 'Município', 'Ente Público', 'CPF', 'Usuário', 'Data Envio', 'Analisado', 'Validado', 'Ação'];

        return view('modulo_sistema.admin.ente_publico.ConsultarOficio', compact('arquivosOficio', 'cabecalhoTab'));
    }

    public function validarOficiosEnte($arquivoId)
    {

        $arquivoOficio = ViewArquivosEnviados::where('arquivo_id', $arquivoId)->firstOrfail();

        return view('modulo_sistema.admin.ente_publico.ValidarOficio', compact('arquivoOficio'));
    }

    public function listarArquivos()
    {
        $pasta = "../public/uploads_arquivos/modulo_propostas/propostas/oficio";
        $dir = new DirectoryIterator($pasta);
        $arquivos = [];
        foreach ($dir as $fileInfo) {
            array_push($arquivos, $fileInfo->getFilename());
        }

        return $arquivos;
    }

    public function salvarValidacaoOficio(Request $request)
    {


        $usuario = Auth::user();

        DB::beginTransaction();

        //return $request->all();

        $arquivoOficio = RlcArquivoUser::find($request->arquivo_id);

        $permissao = Permissoes::find($request->permissao_id);



        $arquivoOficio->bln_documento_analisado = true;
        $arquivoOficio->user_id_analisado_por = $usuario->id;

        if ($request->bln_validado == 'true') {
            $arquivoOficio->bln_documento_validado = true;
            $permissao->status_permissao_id = 2;
        } else {
            $arquivoOficio->bln_documento_validado = false;
            $arquivoOficio->dsc_motivo_validacao = $request->dsc_motivo_validacao;

            $permissao->status_permissao_id = 3;
            $permissao->tipo_indeferimento_id = $request->tipo_indeferimento;
            if ($request->outro_tipo_indeferimento) {
                $permissao->txt_outro_tipo_indeferimento = $request->outro_tipo_indeferimento;
            }
        }

        $arquivoOficio->dte_validacao = Date("Y-m-d");
        $arquivoSalvo = $arquivoOficio->update();


        $permissao->user_id = $arquivoOficio->user_id;
        $permissao->modulo_sistema_id = 2;
        $permissao->bln_analisada = true;
        $permissao->dte_analise = Date("Y-m-d h:i:s");
        $permissao->usuario_id_analise = $usuario->id;

        $permissao->txt_observacao = $request->txt_observacao;

        $salvouPermissao = $permissao->update();

        $permissao->load('user', 'tipoIndeferimento');

        $usuarioValidado = User::find($arquivoOficio->user_id);

        $usuarioValidado->load('tipoUsuario', 'statusUsuario', 'entePublico.municipio.uf');

        if ($arquivoSalvo && $salvouPermissao) {
            flash()->sucesso("Sucesso", "Ofício validado com sucesso!");
            DB::commit();



            if ($request->bln_validado == 'true') {
                Mail::to($permissao->user->email)->send(new PermissaoDeferida($permissao, $usuarioValidado));
            } else {
                Mail::to($permissao->user->email)->send(new PermissaoIndeferida($permissao, $usuarioValidado));
            }

            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível validar o ofício.");
            return back();
        }
    }

    public function pesquisarOficio(Request $request)
    {

        //return $request->all();

        $where = [];

        $where[] = ['bln_oficio', true];


        if ($request->estado) {
            $where[] = ['uf_id', $request->estado];
        }

        if ($request->municipio) {
            $where[] = ['municipio_id', $request->municipio];
        }

        if ($request->bln_analisado) {
            $where[] = ['bln_documento_analisado', $request->bln_analisado];
        }

        if ($request->bln_validado) {
            $where[] = ['bln_documento_validado', $request->bln_validado];
        }

        if ($request->tipo_indeferimento) {
            $where[] = ['tipo_indeferimento_id', $request->tipo_indeferimento];
        }

        //return $where;        

        $arquivosOficio = ViewArquivosEnviados::where($where)->get();
        $cabecalhoTab = ['id', 'UF', 'Município', 'Ente Público', 'CPF', 'Usuário', 'Data Envio', 'Analisado', 'Validado', 'Ação'];


        if ($arquivosOficio) {

            return view('modulo_sistema.admin.ente_publico.ListaOficio', compact('arquivosOficio', 'cabecalhoTab'));
        } else {

            flash()->erro("Erro", "Não existe ofícios com os dados selecionados.");
            return back();
        }
    }

    public function analiseOficiosEnte($arquivoId)
    {

        $arquivoOficio = ViewArquivosEnviados::where('arquivo_id', $arquivoId)->firstOrfail();

        $possuiEmail = RlcEmailInstitucionalEnte::where('user_id', $arquivoOficio->usuario_id)->get();


        return view('modulo_sistema.admin.ente_publico.AnaliseValidacaoOficio', compact('arquivoOficio'));
    }
}
