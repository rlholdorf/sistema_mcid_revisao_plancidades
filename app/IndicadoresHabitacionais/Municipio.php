<?php

namespace App\IndicadoresHabitacionais;

use App\EntePublico;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{

   protected $connection   = 'pgsql';

   protected $table = '_indicadores_habitacionais.tab_municipios';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização



   public function uf()
   {
      return $this->belongsTo(Uf::class); //possui muitos
   }

   public function entePublicos()
   {
      return $this->hasMany(EntePublico::class); //possui muitos
   }

   public function idhMunicipio()
   {
      return $this->belongsTo(IdhMunicipio::class); //possui muitos
   }
}