<?php

namespace App;

use App\IndicadoresHabitacionais\Municipio;
use Illuminate\Database\Eloquent\Model;

class EntePublico extends Model
{
    protected $connection	= 'pgsql_corp';
    protected $keyType = 'string';
    
    protected $table = 'mcid_sistema_se.tab_ente_publico';

    


	public function users(){
		return $this->hasMany(User::class,'ente_publico_id','id');
	}

	public function municipio()
    {
       return $this->belongsTo(Municipio::class,'municipio_id'); //possui muitos
    }

    public function propostas(){
		return $this->hasMany(Propostas::class);
	}
}
