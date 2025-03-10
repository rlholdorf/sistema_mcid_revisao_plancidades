<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\Mod_selecao_demanda\SalvarUsuario;
use App\Http\Requests\NovaSenha;
use App\Http\Requests\Mod_selecao_demanda\SalvarUsuarioEnte;
use App\Http\Requests\RegistroUsuario;
use App\Http\Requests\ValidarCpf;
use App\Http\Requests\ValidarCpfCnpj;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use Illuminate\Support\Facades\Auth;

use App\User;
use Config\App;
use App\StatusUsuario;
use App\TipoUsuario;
use App\Mod_selecao_demanda\EntePublico;
use App\Mod_prototipo\EntePublicoProponente;

use App\ModuloSistema;
use App\ViewPermissoesUsuario;
use App\Permissoes;
use App\RlcModuloSistemaTipoUsuario;
use App\RlcModuloSistemaUsuario;
use App\ViewArquivosEnviados;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Crypt;


class UsuariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('entePublico');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }


    public function primeiro_acesso()
    {

        $usuario = Auth::user();

        if ($usuario->modulo_sistema_id == 2) {

            if (!$usuario->bln_oficio) {
                flash()->erro("Erro", "Favor enviar o ofício para validação do login no sistema.");
                Auth::logout();
                $entePublicoId = Crypt::encrypt($usuario->ente_publico_id);
                $cpfUsuario = Crypt::encrypt($usuario->txt_cpf_usuario);
                return redirect('/ente_publico/propostas/' . $cpfUsuario . '/' . $entePublicoId);
            } else {



                $where = [];
                $where[] = ['user_id', $usuario->id];

                $permissao = ViewPermissoesUsuario::where($where)->firstOrFail();

                if ($permissao->status_permissao_id != 2) {

                    flash()->confirma("Permissão " . $permissao->txt_status_permissao . ".", "Favor entrar em contato pelos telefones 61-20344908 ou enviar email para cadastramento.mcid@mdr.gov.br.");
                    Auth::logout();

                    if (empty($usuario->txt_cpf_usuario)) {
                        return redirect('/login');
                    } else {
                        $entePublicoId = Crypt::encrypt($usuario->ente_publico_id);
                        $cpfUsuario = Crypt::encrypt($usuario->txt_cpf_usuario);
                        return redirect('/ente_publico/propostas/' . $cpfUsuario . '/' . $entePublicoId);
                    }
                }
            }
        }

        return  view('modulo_sistema.primeiro_acesso', compact('usuario'));
    }

    public function updateUsuarioPrimeiroAcesso(Request $request)
    {




        $usuario = Auth::user();
        $usuario->load('tipoUsuario', 'statusUsuario', 'entePublico.municipio.uf');

        DB::beginTransaction();

        $usuario->password = bcrypt($request->password);
        $usuario->bln_ativo = true;
        $usuario->status_usuario_id = 1;
        $usuario->updated_at = Date("Y-m-d h:i:s");
        $salvoComSucessoUsu = $usuario->save();

        $dataExtenso = convertaDataExtenso(getdate());


        if (!$salvoComSucessoUsu) {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar os dados do responsável.");
            return back();
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Senha alterada com sucesso!");
            return  view('modulo_sistema.termo_responsabilidade', compact('usuario', 'dataExtenso'));
        }
    }

    public function abrirTermo()
    {

        $usuario = Auth::user();
        $usuario->load('tipoUsuario', 'statusUsuario', 'entePublico.municipio.uf');

        $dataExtenso = convertaDataExtenso(getdate());
        return  view('modulo_sistema.termo_responsabilidade', compact('usuario', 'dataExtenso'));
    }

    public function aceiteTermo(Request $request)
    {

        if ($request->termo == true) {
            $usuario = Auth::user();
            $usuario->bln_aceite_termo = true;
            $usuario->dte_aceite_termo = Date("Y-m-d h:i:s");

            //return $usuario;
            $salvouAceite = $usuario->save();
        }




        if ($salvouAceite) {
            flash()->sucesso("Sucesso", "Termo de Responsabilidade aceito de acordo com o disposto nos normativos vigentes do Programa.");
            return redirect('/home');
            //return view('ente_publico.painel_ente_publico',compact('usuario','numUsuarios'));

        } else {
            flash()->erro("Erro", "Não foi possível aceitar o Termo de Responsabilidade.");
            return back();
        }
    }

    public function dadosUsuarioEnte()
    {

        $usuario = Auth::user();
        $usuario->load('tipoUsuario', 'statusUsuario', 'entePublico.municipio.uf');

        $idUsuarioLogado  = $usuario->id;
        if ($usuario) {
            return view('modulo_sistema.dados_usuario', compact('usuario', 'idUsuarioLogado'));
        } else {
            flash()->erro("Erro", "Não existe esse usuário.");
            return back();
        }
    }

    public function filtroUsuarios()
    {
        return view('modulo_sistema.admin.filtroUsuarios');
    }

    public function pesquisarUsuarios(Request $request)
    {

        //return $request->all();
        $where = [];

        $subtitulo1 = 'BRASIL';
        if ($request->estado) {
            $where[] = ['tab_uf.id_uf', $request->estado];
            $estado = Uf::where('id', $request->estado)->firstOrFail();
            $subtitulo1 = $estado->txt_uf;
        }

        if ($request->municipio) {
            $where[] = ['tab_municipios.id_municipio', $request->municipio];
            $municipio = Municipio::where('id', $request->municipio)->firstOrFail();
            $subtitulo1 = trim($municipio->ds_municipio) . '/' . $estado->txt_sigla_uf;
        }

        if ($request->tipoUsuario) {
            $where[] = ['tipo_usuario_id', $request->tipoUsuario];
        }

        if ($request->moduloSistema) {
            $where[] = ['modulo_sistema_id', $request->moduloSistema];
        }

        if ($request->entePublico) {
            $where[] = ['ente_publico_id', $request->entePublico];
        }


        $usuarios = User::leftjoin('opc_tipo_usuario', 'users.tipo_usuario_id', '=', 'opc_tipo_usuario.id')
            ->leftjoin('opc_status_usuario', 'users.status_usuario_id', '=', 'opc_status_usuario.id')
            ->leftjoin('tab_ente_publico', 'users.ente_publico_id', '=', 'tab_ente_publico.id')
            ->leftjoin('ibge.tab_municipios', 'tab_ente_publico.municipio_id', '=', 'tab_municipios.id_municipio')
            ->leftjoin('ibge.tab_uf', 'tab_municipios.id_uf', '=', 'tab_uf.id_uf')
            ->leftjoin('ibge.tab_regiao', 'tab_uf.id_regiao', '=', 'tab_regiao.id_regiao')
            ->select(
                'sg_uf as txt_sigla_uf',
                'ds_municipio',
                'ds_regiao as txt_regiao',
                'txt_ente_publico',
                'users.id as usuario_id',
                'email',
                'name',
                'txt_tipo_usuario',
                'txt_status_usuario',
                'dte_aceite_termo',
                'bln_user_forms_google'
            )
            ->orderBy('txt_sigla_uf', 'asc')
            ->orderBy('ds_municipio', 'asc')
            ->orderBy('name', 'asc')
            ->where($where)->get();

        if ($usuarios->count() > 0) {
            return view('modulo_sistema.admin.ListaUsuarios', compact('usuarios', 'subtitulo1'));
        } else {
            flash()->info('Informação', 'Não Existe Usuários ou responsáveis para os critérios selecionados', 'error');
            return back();
        }
    }

    public function dadosUsuario($usuarioID)
    {

        $usuario = User::where('id', $usuarioID)->firstOrFail();

        $usuario->load('tipoUsuario', 'statusUsuario', 'entePublico.municipio.uf', 'setor.departamento.secretaria');

        $permissoes = Permissoes::where('user_id', $usuario->id)->get();

        $permissoes->load('tipoIndeferimento', 'userAnalisado');



        $dadosArquivoOficio = ViewArquivosEnviados::where('usuario_id', $usuario->id)->get();


        $idUsuarioLogado  = $usuario->id;
        if ($usuario) {
            return view('modulo_sistema.admin.dados_usuario', compact('usuario', 'idUsuarioLogado', 'permissoes', 'dadosArquivoOficio'));
        } else {
            flash()->erro("Erro", "Não existe esse usuário.");
            return back();
        }
    }


    public function cadastrar_usuario(RegistroUsuario $request)
    {

        // return $request->all();

        DB::beginTransaction();

        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->txt_cpf_usuario = $request->txt_cpf_usuario;
        $usuario->modulo_sistema_id = $request->modulo_sistema_id;
        $usuario->tipo_usuario_id = $request->tipo_usuario_id;
        $usuario->ente_publico_id = $request->ente_publico_id;
        $usuario->status_usuario_id = 2;
        $usuario->password = bcrypt($request->password);

        // return $moduloSistema = RlcModuloSistemaTipoUsuario::where('tipo_usuario_id',$request->tipo_usuario_id)->firstOrFail();

        $salvoComSucesso = $usuario->save();




        $modulo = new RlcModuloSistemaUsuario();
        $modulo->modulo_sistema_id = $request->modulo_sistema_id;
        $modulo->user_id = $usuario->id;
        $modulo->bln_permissao_ativa = TRUE;
        $modulo->dte_criacao = Date("Y-m-d h:i:s");
        $modulo->dte_ativacao = Date("Y-m-d h:i:s");
        $moduloSalvoComSucesso = $modulo->save();







        if ($salvoComSucesso && $moduloSalvoComSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!");
            return redirect('/admin/usuario/' . $usuario->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados do usuário.");
        }
        // return view('views_selecao_beneficiarios.cadastrar_usuario');
    }

    public function atualizar_usuario(ValidarCpf $request)
    {



        DB::beginTransaction();
        //return $request->all();

        $usuario = User::find($request->usuario_id);
        $usuario->name = $request->txt_nome;
        $usuario->txt_cpf_usuario = $request->txt_cpf_usuario;
        $usuario->modulo_sistema_id = $request->modulo_sistema_id;
        $usuario->tipo_usuario_id = $request->tipo_usuario_id;
        $usuario->ente_publico_id = $request->ente_publico_id;
        $usuario->bln_ativo = true;
        $usuario->setor_id = $request->setor;
        $usuario->txt_ddd_fixo = $request->txt_ddd_fixo;
        $usuario->txt_telefone_fixo = $request->txt_telefone_fixo;
        $usuario->txt_ddd_movel = $request->txt_ddd_movel;
        $usuario->txt_telefone_movel = $request->txt_telefone_movel;


        // return $moduloSistema = RlcModuloSistemaTipoUsuario::where('tipo_usuario_id',$request->tipo_usuario_id)->firstOrFail();

        $salvoComSucesso = $usuario->update();

        if ($salvoComSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Usuário atualizado com sucesso!");
            return redirect('/admin/usuario/' . $usuario->id);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar os dados do usuário.");
        }
        // return view('views_selecao_beneficiarios.cadastrar_usuario');
    }
}
