<?php

namespace App\Http\Middleware;

use App\Mod_saci\mod_sistema\Permissao;
use App\ModuloSistema;
use App\Permissoes;
use App\RlcModuloSistemaTipoUsuario;
use Closure;
use Illuminate\Support\Facades\Auth;

class ModuloUsuario
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
         $usuario = Auth::user();    
        $modulo = RlcModuloSistemaTipoUsuario::where('modulo_sistema_id',$usuario->modulo_sistema_id)->firstOrFail();
        

        
        if($usuario->tipo_usuario_id == $modulo->tipo_usuario_id){
            return $next($request);
        }

           flash()->confirma('Perfil inválido', 'Este usuário não pode acessar esta página', 'error');
           Auth::logout();
            return redirect('/'); 
    }
}
