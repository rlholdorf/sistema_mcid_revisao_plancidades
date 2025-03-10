<?php

namespace App\Http\Middleware;

use App\ModuloSistema;
use App\Permissoes;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirecionarUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
        $manutencao = false;
        if($manutencao){
            Auth::logout();
            return view('errors.manutencao');
        }
*/

        $usuario = Auth::user();
        $modulo = ModuloSistema::select('bln_ativo')->where('id', $usuario->modulo_sistema_id)->firstOrFail();
        $sistemaAtivo = $modulo->bln_ativo;




        if ($sistemaAtivo) {
            if ($usuario->status_usuario_id == 2) {


                return redirect('/usuario/primeiro_acesso');
            } elseif (!$usuario->bln_aceite_termo) {
                return redirect('/usuario/termo_responsabilidade');
            } else {
                if ($usuario->status_usuario_id >= 3) {
                    flash()->erro("Erro", "Usuário sem permissão ativa para acessar o Sistema");
                    Auth::logout();
                    return redirect('/login');
                } else {
                    if ($usuario->modulo_sistema_id == 1) {
                        if ($usuario->bln_ativo) {
                            return $next($request);
                        } else {
                            return redirect('/admin/usuario/' . $usuario->id);
                        }
                    } elseif ($usuario->modulo_sistema_id == 2) {
                        return redirect('/home_ente_publico');
                    } elseif ($usuario->modulo_sistema_id == 3) {
                        return redirect('/home_saci');
                    } elseif ($usuario->modulo_sistema_id == 4) {
                        return redirect('/home_formularios');
                    } elseif ($usuario->modulo_sistema_id == 5) {
                        return redirect('/home_bndes');
                    } elseif ($usuario->modulo_sistema_id == 6) {
                        return redirect('/home_apis');
                    } elseif ($usuario->modulo_sistema_id == 7) {
                        return redirect('/home_pac');
                    } elseif ($usuario->modulo_sistema_id == 8) {
                        return redirect('/plancidades');
                    } else {
                        flash()->erro("Erro", "Não existe usuário com esses dados.");
                        Auth::logout();
                        return redirect('/login');
                    }
                }
            }
        } else {

            flash()->erro("Fora do Ar", "Sistema em manutenção");
            Auth::logout();
            return redirect('/');
        }
    }
}