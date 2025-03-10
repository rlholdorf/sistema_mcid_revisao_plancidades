<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class DadosArquivosSelecaoSecretaria extends Model
{
    protected $connection	= 'pgsql_corp';
    
   protected $table = 'tab_dados_arquivo_selecao_secretaria';

   protected $primaryKey = 'cod_dados_arquivo_selecao_secretaria';

   protected $fillable = [
                            'cod_dados_arquivo_selecao_secretaria',
                            'cod_contrato_pac',
                            'txt_fonte',
                            'txt_area',
                            'txt_contrato',
                            'txt_protocolo',
                            'txt_sequencial',
                            'txt_situacao_contrato',
                            'txt_agefin',
                            'txt_uf',
                            'txt_entidade',
                            'txt_modalidade',
                            'txt_submodalidade',
                            'txt_empreendimento',
                            'txt_objeto',
                            'dsc_objeto',
                            'vlr_emprestimo',
                            'vlr_contrapartida',
                            'cod_chamada',
                            'dte_selecao',
                            'num_fase',
                            'txt_mcid',
                            'txt_situacao_obra',
                            'txt_classificacao_cor',
                            'bln_ativo',
                            'txt_entidade_tomador',
                            'txt_entidade_executora',
                            'txt_eixo',
                            'txt_subeixo',
                            'txt_tipo',
                            'txt_subtipo',
                            'txt_pt',
                            'vlr_taxa_administrativa',
                            'txt_programa',
                            'cod_arquivos_selecao_secretaria',
                            'created_at',
                            'updated_at'
                            ];

  

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    


}
