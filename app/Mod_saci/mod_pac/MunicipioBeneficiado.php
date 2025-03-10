<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

use DB;

class MunicipioBeneficiado extends Model
{
    protected $connection	= 'pgsql_corp';
    
   protected $table = 'pac.rlc_municipios_beneficiarios';

  protected $primaryKey = ['cod_contrato_pac', 'cod_municipio_ibge'];

  public $keyType = 'integer';
  
  public $incrementing = false;

  protected $fillable = [
    'cod_contrato_pac',
    'cod_municipio_ibge',
    'bln_principal'
  ];


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function contratosPacs()
    {
       return $this->hasMany(ContratosPac::class,'cod_contrato_pac','cod_contrato_pac'); //possui muitos
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public static function limparMunicipiosBeneficiados($contratoPAC, $blnPrincipal) {

        
        $where = [];
            $where[] = ['cod_contrato_pac',intval($contratoPAC)];

          if($blnPrincipal == 'false'){
            $where[] = ['bln_principal',false];
          }elseif($blnPrincipal == 'true'){
            $where[] = ['bln_principal',true];
          }

       $municipioBen = MunicipioBeneficiado::where($where)->get();

        $cont = count($municipioBen);

        foreach($municipioBen as $dados){
            //return $dados->cod_municipio_ibge;
           

         // return $where;
         
            //return $municipio = MunicipioBeneficiado::where($where)->first();
            $dados->delete();
            $cont -= 1;
        }

        if($cont == 0){                      
            return true;
        }else{                      
            return false;
        }
    }

    public static function salvarMunicipioBeneficiado($contratoPAC, $codMunicipio, $blnPrincipal) {

            $municipiosBen = new MunicipioBeneficiado;
            $municipiosBen->cod_contrato_pac = $contratoPAC;
            $municipiosBen->cod_municipio_ibge = $codMunicipio;
            $municipiosBen->bln_principal = $blnPrincipal;
            $salvoMunicipiosBen = $municipiosBen->save();

       
        if($salvoMunicipiosBen){                      
            return true;
        }else{                      
            return true;
        }
    }
}
