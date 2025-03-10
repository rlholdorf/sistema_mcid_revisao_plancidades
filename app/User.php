<?php

namespace App;

use App\Mod_apis\AcompanhamentoDebentures;
use App\Propostas\Propostas;
use App\ModuloSistema;
use App\Propostas\SelecaoPropostas;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

    protected $connection    = 'pgsql_corp';

    protected $table = 'users';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipo_usuario_id', 'modulo_sistema_id', 'txt_cpf_usuario', 'ente_publico_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isEntePublico()
    {

        if (($this->tipo_usuario_id == 8) || ($this->tipo_usuario_id == 9)) {
            return true;
        } else {
            return false;
        }
    }

    public function entePublico()
    {
        return $this->belongsTo(EntePublico::class); //possui muitos
    }

    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario_id');
    }

    public function statusUsuario()
    {
        return $this->belongsTo(StatusUsuario::class);
    }

    public function propostas()
    {
        return $this->hasMany(Propostas::class);
    }

    public function moduloSistema()
    {
        return $this->hasMany(ModuloSistema::class, 'id', 'modulo_sistema_id');
    }

    public function selecaoPropostas()
    {
        return $this->hasMany(SelecaoPropostas::class);
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

    public function acompanhamentosDebentures()
    {
        return $this->hasMany(AcompanhamentoDebentures::class);
    }
}
