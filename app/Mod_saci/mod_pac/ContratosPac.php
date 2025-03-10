<?php

namespace App\Mod_saci\mod_pac;

use App\Mod_saci\mod_sistema\Secretaria;
use App\Mod_saci\mod_sistema\Usuario;

use Illuminate\Database\Eloquent\Model;

use DB;



class ContratosPac extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'pac.tab_contratos_pac';

   protected $primaryKey = 'cod_contrato_pac';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'cod_contrato_pac',
      'cod_fonte',
      'cod_area',
      'cod_contrato',
      'txt_protocolo',
      'txt_sequencial',
      'cod_situacao_contrato',
      'cod_agefin',
      'cod_uf',
      'cod_entidade',
      'cod_modalidade',
      'cod_submodalidade',
      'txt_empreendimento',
      'txt_objeto',
      'dsc_objeto',
      'vlr_repasse',
      'vlr_contrapartida',
      'cod_chamada',
      'dte_selecao',
      'txt_mcid',
      'cod_situacao_obra',
      'cod_classificacao_cor',
      'bln_ativo',
      'cod_entidade_tomador',
      'cod_entidade_executora',
      'cod_eixo',
      'cod_subeixo',
      'cod_tipo',
      'cod_subtipo',
      'cod_pt',
      'vlr_taxa_administrativa',
      'cod_programa'
   ];

   public function secretarias()
   {
      return $this->hasMany(Secretaria::class, 'cod_secretaria', 'cod_secretaria'); //possui muitos
   }

   public function situacaoContrato()
   {
      return $this->belongsTo(SituacaoContrato::class, 'cod_situacao_contrato', 'cod_situacao_contrato'); //possui muitos
   }

   public function usuario()
   {
      return $this->belongsTo(Usuario::class, 'cod_usuario', 'cod_usuario'); //possui muitos
   }

   public function MunicipioBeneficiados()
   {
      return $this->hasMany(MunicipioBeneficiado::class, 'cod_contrato_pac', 'cod_contrato_pac'); //possui muitos
   }

   public function observacoesContratos()
   {
      return $this->hasMany(ObservacoesContratos::class, 'cod_contrato_pac', 'cod_contrato_pac'); //possui muitos
   }


   public static function salvarContratos($request)
   {

      DB::beginTransaction();

      $contratosPac = new ContratosPac;
      $contratosPac->cod_contrato = str_replace(".", "", str_replace("-", "", $request->cod_contrato));
      $contratosPac->cod_pt = substr($request->cod_contrato, 0, 7);

      $contratosPac->cod_andamento = $request->andamento;
      $contratosPac->cod_usuario = $request->cod_usuario;
      $contratosPac->cod_area = $request->cod_area;
      $contratosPac->cod_fonte = $request->cod_fonte;
      $contratosPac->txt_protocolo = $request->txt_protocolo;
      $contratosPac->num_sequencial = $request->cod_contrato;
      $contratosPac->cod_situacao_contrato = $request->situacao_contrato;
      $contratosPac->cod_situacao_obra = $request->situacao_obra;
      $contratosPac->cod_classificacao_cor = $request->cod_classificacao_cor;
      $contratosPac->cod_uf = $request->cod_uf;
      $contratosPac->cod_entidade_proponente = $request->cod_entidade;
      $contratosPac->cod_agente_financeiro = $request->agente_financeiro;
      $contratosPac->cod_modalidade = $request->cod_modalidade;
      $contratosPac->cod_submodalidade = $request->cod_submodalidade;
      $contratosPac->cod_fase = $request->fase;
      $contratosPac->txt_empreendimento = substr($request->txt_empreendimento, 0, 255);;
      $contratosPac->txt_objeto = $request->txt_objeto;
      $contratosPac->txt_descricao_obj = $request->txt_descricao_obj;
      $contratosPac->vlr_repasse = str_replace(",", ".", str_replace(".", "", $request->vlr_emprestimo));
      $contratosPac->vlr_contrapartida = str_replace(",", ".", str_replace(".", "", $request->vlr_contrapartida));
      $contratosPac->dte_selecao = $request->dte_selecao;
      $contratosPac->cod_chamada = $request->chamada;
      $contratosPac->txt_mcid = $request->txt_mcid;
      $contratosPac->bln_ativo = $request->bln_ativo;
      $contratosPac->cod_entidade_tomador = $request->entidade_tomadora;
      $contratosPac->cod_entidade_executora = $request->entidade_executora;
      $contratosPac->cod_eixo = $request->eixo;
      $contratosPac->cod_subeixo = $request->subeixo;
      $contratosPac->cod_tipo = $request->tipo;
      $contratosPac->cod_subtipo = $request->subtipo;

      $contratosPac->cod_programa = $request->programa;
      $contratosPac->vlr_taxa_administrativa =  str_replace(",", ".", str_replace(".", "", $request->vlr_taxa_administrativa));


      $salvoProposta = $contratosPac->save();

      //dd($contratosPac);

      if ($salvoProposta) {
         DB::commit();
      } else {
         DB::rollBack();
      }

      return $contratosPac->cod_contrato_pac;
   }

   public static function atualizarContratos($request)
   {



      $contratosPac = ContratosPac::find($request->cod_contrato_pac);
      $contratosPac->cod_contrato = $request->cod_contrato;
      $contratosPac->cod_pt = substr($request->cod_contrato, 7);
      //$contratosPac->cod_usuario = $request->monitor;
      $contratosPac->cod_andamento = $request->andamento;
      $contratosPac->cod_area = $request->cod_area;
      $contratosPac->cod_fonte = $request->cod_fonte;
      $contratosPac->txt_protocolo = $request->txt_protocolo;
      $contratosPac->num_sequencial = $request->cod_contrato;
      $contratosPac->cod_situacao_contrato = $request->situacao_contrato;
      $contratosPac->cod_situacao_obra = $request->situacao_obra;
      $contratosPac->cod_classificacao_cor = $request->cod_classificacao_cor;
      $contratosPac->cod_uf = $request->cod_uf;

      $contratosPac->cod_entidade_proponente = $request->cod_entidade;
      $contratosPac->cod_agente_financeiro = $request->agente_financeiro;
      $contratosPac->cod_modalidade = $request->cod_modalidade;
      $contratosPac->cod_submodalidade = $request->cod_submodalidade;
      $contratosPac->cod_fase = $request->fase;
      $contratosPac->txt_empreendimento = $request->txt_empreendimento;
      $contratosPac->txt_objeto = $request->txt_objeto;
      $contratosPac->txt_descricao_obj = $request->txt_descricao_obj;
      $contratosPac->vlr_repasse = str_replace(",", ".", str_replace(".", "", $request->vlr_emprestimo));
      $contratosPac->vlr_contrapartida = str_replace(",", ".", str_replace(".", "", $request->vlr_contrapartida));
      $contratosPac->dte_selecao = $request->dte_selecao;
      $contratosPac->cod_chamada = $request->chamada;
      $contratosPac->txt_mcid = $request->txt_mcid;
      $contratosPac->bln_ativo = ($request->bln_ativo == 1) ? true : false;
      $contratosPac->cod_entidade_tomador = $request->entidade_tomadora;
      $contratosPac->cod_entidade_executora = $request->entidade_executora;
      $contratosPac->cod_eixo = $request->eixo;
      $contratosPac->cod_subeixo = $request->subeixo;
      $contratosPac->cod_tipo = $request->tipo;
      $contratosPac->cod_subtipo = $request->subtipo;

      $contratosPac->cod_programa = $request->programa;
      $contratosPac->vlr_taxa_administrativa =   str_replace(",", ".", str_replace(".", "", $request->vlr_taxa_administrativa));
      $contratosPac->dte_carga = Date('Y-m-d');

      return $salvoProposta = $contratosPac->update();
   }
}
