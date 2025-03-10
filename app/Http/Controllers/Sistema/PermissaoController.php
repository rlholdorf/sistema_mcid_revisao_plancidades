<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail\PermissaoDeferida;
use App\Permissoes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;


use DB;
use Illuminate\Support\Facades\Auth;

class PermissaoController extends Controller
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

    

    public function dadosPermissao(Permissoes $permissao){

        $usuario = Auth::user();        

         $permissao->load('user','tipoIndeferimento');

        return view('modulo_sistema.admin.usuario.DadosPermissao',compact('usuario','permissao' ));

         
    }
}
