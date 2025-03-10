<template>
    <div class="form-group">
   
     <div class="row" v-if="this.contrato_pac > 0">                    
            <div class="col col-xs-12 col-sm-3 br-input">
                <div class="br-input">
                    <label for="input-medium">Contrato PAC</label>
                    <input id="contrato_pac" type="text"  name="contrato_pac" v-model="contrato_pac" disabled/>
                  </div>                
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Tipo Carga</label>
                <input id="tipo_carga" 
                        type="text" 
                        class="input-medium" 
                        name="cod_tipo_carga" 
                        v-model="tipo_carga" 
                        disabled>
            </div>           
             <div class="col col-xs-12 col-sm-3 br-input">
                 <label >Data da Carga</label>
                <input id="dte_carga" 
                       type="text" 
                       class="input-medium" 
                       name="dte_carga" 
                       v-model="dte_carga" 
                       disabled >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                 <label >Usuário (Admin)</label>
                <input id="login_usuario" 
                       type="text" 
                       class="input-medium" 
                       name="login_usuario" 
                       v-model="login_usuario" 
                       disabled >
            </div>

        </div>    
        <div class="row">                    
            <div class="col col-xs-12 col-sm-4">
                <div class="br-input">
                    <label for="input-medium">Contrato<span class="text-obrigatorio">*</span></label>
                    <input id="cod_contrato" type="text"  minlength="10" maxlength="15" name="cod_contrato" @change="onChangeContrato" v-model="contrato" required/>
                  </div>   
            </div>
            
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >Protocolo<span class="text-obrigatorio">*</span></label>
                <input id="txt_protocolo" 
                    type="text" 
                    class="input-medium" 
                    name="txt_protocolo" 
                    v-model="protocolo"       
                    required>
            </div>
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >Sequencial<span class="text-obrigatorio"></span></label>
                <input id="num_sequencial" 
                        type="text" 
                        class="input-medium" 
                        name="num_sequencial"  
                        v-model="sequencial"   
                        >

            </div>
            <!--
            <div class="col col-xs-12 col-sm-3">
                <label for="secretaria">Secretaria<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_secretaria"
                    class="input-medium" 
                    name="cod_secretaria"  
                    v-model="secretaria"  
                     @change="onChangeSecretaria"    
                     required
                >
                    <option value="">Escolha uma Secretaria:</option>
                    <option v-for="secretaria in secretarias" 
                        v-text="secretaria.txt_sigla_secretaria" 
                        :value="secretaria.cod_secretaria" :key="secretaria.cod_secretaria">
                    </option>
                </select>
            </div>
            -->
        </div><!-- div row -->
        <div class="row" >
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="area">Area<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_area"
                    class="form-select br-select" 
                    name="cod_area"  
                    v-model="area"    
                    @change="onChangeArea"
                    required  
                >
                    <option value="" >Escolha uma Area</option>
                    <option v-for="area in areas" 
                         v-text="area.txt_sigla_area" 
                        :value="area.cod_area" :key="area.cod_area">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="modalidade">Modalidade<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_modalidade"
                    class="form-select br-select" 
                    name="cod_modalidade"    
                     v-model="modalidade"   
                     @change="onChangeModalidade" 
                     :disabled="area == '' || buscando" 
                     required                              
                >
                   <option value="" v-text="textoEscolhaModalidade" ></option>
                   <option v-for="modalidade in modalidades" 
                        v-text="modalidade.dsc_modalidade" 
                        :value="modalidade.cod_modalidade" :key="modalidade.cod_modalidade">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="submodalidade">Submodalidade<span class="text-obrigatorio"></span></label>           
                <select 
                    id="cod_submodalidade"
                    class="form-select br-select" 
                    name="cod_submodalidade"  
                     v-model="submodalidade"      
                    :disabled="modalidade == '' || buscando || this.submodalidades.length==0" 
                           
                >
                   <option value="" v-text="textoEscolhaSubmodalidade" ></option>
                     <option v-for="submodalidade in submodalidades" 
                        v-text="submodalidade.dsc_submodalidade" 
                        :value="submodalidade.cod_submodalidade" :key="submodalidade.cod_submodalidade">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="cod_fase">Fase<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_fase"
                    class="form-select br-select" 
                    name="fase"    
                     v-model="fase"    
                     required  
                >
                    <option value="">Escolha uma Fase:</option>
                    <option v-for="fase in fases" 
                        v-text="fase.dsc_fase" 
                        :value="fase.cod_fase" :key="fase.cod_fase">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="fonte">Fonte<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_fonte"
                    class="form-select br-select" 
                    name="cod_fonte"  
                    v-model="fonte"  
                     @change="onChangeFonte" 
                    :disabled="area == '' || buscando"
                    required  
                >
                    <option value="" v-text="textoEscolhaFonte"></option>
                   <option v-for="fonte in fontes" 
                         v-text="fonte.dsc_fonte" 
                        :value="fonte.cod_fonte" :key="fonte.cod_fonte">
                    </option>
                </select>
            </div>
        </div><!-- div row -->
        <div class="row" >
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="eixo">Eixo<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="eixo"
                    class="form-select br-select" 
                    name="eixo"   
                    :disabled="area != 1"    
                    v-model="eixo"
                    required         
                >
                    <option value="">Escolha um Eixo:</option>
                    <option v-for="eixo in eixos" 
                        v-text="eixo.dsc_eixo" 
                        :value="eixo.cod_eixo" :key="eixo.cod_eixo">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="subeixo">Subeixos<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="subeixo"
                    class="form-select br-select" 
                    name="subeixo"   
                    :disabled="area != 1"    
                    v-model="subeixo"   
                     required 
                >
                    <option value="">Escolha um Subeixo:</option>
                    <option v-for="eixo in eixos" 
                        v-text="eixo.dsc_eixo" 
                        :value="eixo.cod_eixo" :key="eixo.cod_eixo">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="tipo">Tipo<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="tipo"
                    class="form-select br-select" 
                    name="tipo"     
                    :disabled="area != 1"      
                    v-model="tipo"  
                    required     
                    >
                    <option value="">Escolha um Tipo:</option>
                    <option v-for="tipo in tipos" 
                        v-text="tipo.dsc_tipo" 
                        :value="tipo.cod_tipo" :key="tipo.cod_tipo">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="subtipo">Subtipo<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="subtipo"
                    class="form-select br-select" 
                    name="subtipo"    
                    :disabled="area != 1"       
                    v-model="subtipo"  
                    required     
                >
                    <option value="">Escolha uma Subtipo:</option>
                    <option v-for="tipo in tipos" 
                        v-text="tipo.dsc_tipo" 
                        :value="tipo.cod_tipo" :key="tipo.cod_tipo">
                    </option>
                </select>
            </div>
        </div><!-- div row -->
        <div class="row">    
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="andamento">Andamento<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="andamento"
                    class="form-select br-select" 
                    name="andamento"  
                    v-model="andamento"   
                    required   
                >
                    <option value="">Escolha um Andamento:</option>
                    <option v-for="andamento in andamentos" 
                        v-text="andamento.dsc_andamento" 
                        :value="andamento.cod_andamento" :key="andamento.cod_andamento">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="situacao_contrato">Situação Contrato<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="situacao_contrato"
                    class="form-select br-select" 
                    name="situacao_contrato"  
                    v-model="situacaoContrato"   
                    required   
                >
                    <option value="">Escolha uma Situacao Contrato:</option>
                    <option v-for="situacaoContrato in situacaoContratos" 
                        v-text="situacaoContrato.dsc_situacao_contrato" 
                        :value="situacaoContrato.cod_situacao_contrato" :key="situacaoContrato.cod_situacao_contrato">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="situacao_obra">Situação Obra<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="situacao_obra"
                    class="form-select br-select" 
                    name="situacao_obra" 
                    v-model="situacaoObra" 
                    required       
                >
                    <option value="">Escolha uma Situação Obra:</option>
                    <option v-for="situacaoObra in situacaoObras" 
                        v-text="situacaoObra.dsc_situacao_obra" 
                        :value="situacaoObra.cod_situacao_obra" :key="situacaoObra.cod_situacao_obra">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="classificacao_cor">Classificação Cor<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_classificacao_cor"
                    class="form-select br-select" 
                    name="cod_classificacao_cor"   
                    v-model="classificacaoCor" 
                    required     
                >
                    <option value="">Escolha uma Classificação:</option>
                    <option v-for="classificacaoCor in classificacaoCores" 
                        v-text="classificacaoCor.dsc_classificacao_cor" 
                        :value="classificacaoCor.cod_classificacao_cor" :key="classificacaoCor.cod_classificacao_cor">
                    </option>
                </select>
            </div>
        </div><!-- div row -->         
        <div class="row">               
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="uf">UF<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_uf"
                    class="form-select br-select" 
                    name="cod_uf" 
                    @change="onChangeEstado"
                    v-model="estado"  
                    required       
                >
                    <option value="">Escolha uma UF:</option>
                    <option v-for="estado in estados" 
                        v-text="estado.txt_sigla_uf" 
                        :value="estado.id" :key="estado.id">
                    </option>
                </select>
            </div>
            <div class="column col-xs-12 col-sm-3 br-input">
            <!-- municipio -->    
                <label for="municipio">Município Principal<span class="text-obrigatorio">*</span></label>
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    :disabled="estado == '' || buscando"
                    @change="onChangeMunicipio"
                    v-model="municipio"
                    required>
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.cod_ibge_7_dig" :key="municipio.cod_ibge_7_dig"></option>
                </select>    
            </div>
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="entidade">Proponente<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="cod_entidade"
                    class="form-select br-select" 
                    name="cod_entidade"  
                    v-model="entidade"  
                    required              
                >
                    <option value="">Escolha uma Entidade:</option>
                        <option v-for="entidade in entidades" 
                        v-text="entidade.dsc_entidade" 
                        :value="entidade.cod_entidade" :key="entidade.cod_entidade">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="agente_financeiro">Agente Financeiro<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="agente_financeiro"
                    class="form-select br-select" 
                    name="agente_financeiro"  
                    v-model="agenteFinanceiro"              
                    required  
                >
                    <option value="">Escolha uma agente Financeiro:</option>
                        <option v-for="agenteFinanceiro in agenteFinanceiros" 
                        v-text="agenteFinanceiro.dsc_agente_financeiro" 
                        :value="agenteFinanceiro.cod_agente_financeiro" :key="agenteFinanceiro.cod_agente_financeiro">
                    </option>
                </select>
            </div>
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="entidade_tomadora">Entidade Tomadora<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="entidade_tomadora"
                    class="form-select br-select" 
                    name="entidade_tomadora"       
                    v-model="entidade_tomadora"
                    required         
                >
                    <option value="">Escolha uma Entidade Tomadora:</option>
                     <option v-for="entidade in entidades" 
                        v-text="entidade.dsc_entidade" 
                        :value="entidade.cod_entidade" :key="entidade.cod_entidade">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="entidade_executora">Interveniente Executor<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="entidade_executora"
                    class="form-select br-select" 
                    name="entidade_executora"       
                    v-model="entidade_executora"
                    required         
                >
                    <option value="">Escolha um	Interveniente Executor:</option>
                    <option v-for="entidade in entidades" 
                        v-text="entidade.dsc_entidade" 
                        :value="entidade.cod_entidade" :key="entidade.cod_entidade">
                    </option>                    
                </select>
            </div>
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input">
                <label >Empreendimento <span class="text-obrigatorio">*</span></label>
                <input id="txt_empreendimento" 
                       type="text" 
                       maxlength="255"
                       class="input-medium" 
                       name="txt_empreendimento" 
                       placeholder="Máximo de 255 caracteres"
                       v-model="txt_empreendimento" 
                       required >
            </div>
            <div class="col col-xs-12 col-sm-6 br-input">
                <label >Objeto<span class="text-obrigatorio">*</span></label>
                <input id="txt_objeto" 
                       type="text" 
                       class="input-medium" 
                       name="txt_objeto" 
                       v-model="txt_objeto" 
                       required >
            </div>
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >Descrição detalhada do Objeto<span class="text-obrigatorio"></span></label>
                <textarea class="input-medium" 
                          id="txt_descricao_obj" 
                          name="txt_descricao_obj"  
                          rows="10" 
                          v-model="txt_descricao_obj"
                            >
                </textarea>
            </div>    
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Data de Seleção<span class="text-obrigatorio">*</span></label>
                <input id="dte_selecao" 
                       type="text" 
                       class="input-medium" 
                       name="dte_selecao" 
                       v-model="dte_selecao" 
                       placeholder="Ex.: 10/10/2021"
                       required >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="vlr_emprestimo">Valor Empréstimo<span class="text-obrigatorio">*</span></label>           
                <input id="vlr_emprestimo" 
                        type="text"
                        placeholder="Ex.: 300000,23"
                        class="input-medium" 
                        name="vlr_emprestimo" 
                        v-model="vlr_emprestimo" 
                        required >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Valor da Contrapartida<span class="text-obrigatorio">*</span></label>
                <input id="vlr_contrapartida" 
                        type="text"
                        placeholder="Ex.: 300000,23"
                        class="input-medium" 
                        name="vlr_contrapartida" 
                        v-model="vlr_contrapartida" 
                        required >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Valor da Taxa Administrativa<span class="text-obrigatorio">*</span></label>
                <input id="vlr_taxa_administrativa" 
                        type="text"
                        class="input-medium" 
                        name="vlr_taxa_administrativa" 
                        v-model="vlr_taxa_administrativa" 
                        placeholder="Ex.: 300000,23"
                        required >
            </div>            
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="chamada">Chamadas<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="chamada"
                    class="form-select br-select" 
                    name="chamada"       
                    v-model="chamada"    
                    :disabled="area == '' || fonte == '' || buscando || this.chamadas.length==0"       
                    required  
                >
                    <option value=""  v-text="textoEscolhaChamada" ></option>
                     <option v-for="chamada in chamadas" 
                        v-text="chamada.dsc_chamada" 
                        :value="chamada.cod_chamada" :key="chamada.cod_chamada">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Número MCID<span class="text-obrigatorio"></span></label>
                <input id="txt_mcid" 
                        type="text" 
                        class="input-medium" 
                        name="txt_mcid" 
                        v-model="txt_mcid" 
                         >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="bln_ativo">Ativo<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="bln_ativo"
                    class="form-select br-select" 
                    name="bln_ativo"       
                    v-model="bln_ativo"  
                    required       
                >
                    <option value="">Contrato Ativo?</option>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>                    
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="programa">Programa<span class="text-obrigatorio">*</span></label>           
                <select 
                    id="programa"
                    class="form-select br-select" 
                    name="programa"  
                    v-model="programa"  
                    required   

                >
                    <option value="">Escolha um Programa:</option>    
                    <option v-for="programa in programas" 
                        v-text="programa.dsc_programa" 
                        :value="programa.cod_programa" :key="programa.cod_programa">
                    </option>                
                </select>
            </div>
        </div><!-- div row -->
        <div class="titulo">
            <h5>Monitor Responsável<span class="text-obrigatorio">*</span></h5> 
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label for="monitor">Nome</label>           
                <select 
                    id="monitor"
                    class="form-select br-select" 
                    name="monitor"       
                    v-model="monitor"    
                    :disabled="area == ''|| buscando || this.monitores.length==0"       
                    required  
                >
                    <option value=""  v-text="textoEscolhaMonitor" ></option>
                     <option v-for="monitor in monitores" 
                        v-text="monitor.txt_nome" 
                        :value="monitor.cod_usuario" :key="monitor.cod_usuario">
                    </option>
                </select>
            </div>
        </div><!-- div row -->
        <div v-if="estado != 53">
            <div class="titulo"  v-if="estado != '' && this.municipios.length > 1">
                    <h5>Municípios Beneficiados</h5> 
                </div>
            <div class="row" v-if="estado != '' && this.municipios.length > 1">
                
                <div class="col col-xs-12 col-sm-4 br-input">
                    <input type='checkbox' @click='checkAll()' v-model='isCheckAll'> Todos
                </div>
                <div class="col col-xs-12 col-sm-4 br-input" v-for='lang in municipios' v-if="lang.id != municipio" >
                    <input id="municipiosBeneficiados"  name="municipiosBeneficiados[]" type='checkbox' v-bind:value='lang.cod_ibge_7_dig' v-model='municipiosCheck' @change='updateCheckall()' > {{ lang.ds_municipio }}       
                </div>
            </div>
        </div>    
        <slot v-if="this.botaohabilitado">

        </slot>


        
    </div>
</template>

<script>
    export default {
        props:['url','dadoscontrato','municipiobeneficiados'],
        data(){
            return{
                 buscando: false,
                 contrato_pac:0,
                 tipo_carga:'',
                 dte_carga:'',
                contrato: '',
                contrato_pac: '',
                area: '',
                areas: '',
                 textoEscolhaArea: 'Filtre a Secretaria',
                 textoEscolhaSubmodalidade: 'Filtre a Modalidade',
                 textoEscolhaModalidade: 'Filtre a Area',
                 textoEscolhaChamada: 'Filtre a Fonte',
                 textoEscolhaFonte: 'Filtre a Area',
                 textoEscolhaMonitor: 'Filtre a Area',
                 textoEscolhaMunicipio: 'Filtre o Estado',
                secretaria: '',
                secretarias: '',
                fonte: '',
                fontes: '',
                protocolo: '',
                sequencial: '',
                situacaoContrato: '',
                situacaoContratos: '',
                situacaoObra: '',
                situacaoObras: '',
                classificacaoCor: '',
                classificacaoCores: '',
                estado: '',
                estados: '',
                entidade: '',
                entidades: '',
                agenteFinanceiro: '',
                agenteFinanceiros: '',
                modalidade: '',
                modalidades: '',
                submodalidade: '',
                submodalidades: '',
                fase: '',
                fases: '',
                txt_empreendimento: '',
                txt_objeto:'',
                txt_descricao_obj:'',
                dte_selecao:'',
                vlr_emprestimo:'',
                vlr_contrapartida:'',                
                vlr_taxa_administrativa:'',
                txt_mcid:'',
                chamada:'',
                chamadas:'',
                bln_ativo:'',
                entidade_tomadora:'',
                entidade_executora:'',
                andamento:'',
                andamentos:'',
                subeixo:'',
                eixos:'',
                eixo:'',
                tipo:'',
                tipos:'',
                subtipo:'',
                programa:'',
                programas:'',
                cod_pt:'',
                login_usuario:'',
                monitor:'',
                monitores:'',
                municipio:'',
                municipios:'',
                isCheckAll: false,           
                listmunic: [],                
                municipiosCheck:[],
                selectedlang: "",
                botaohabilitado:true,
                munPrincipalRetirado:0,
                ufSelecionado:0
            }        
        },
        methods:{
            checkAll: function(){

                this.isCheckAll = !this.isCheckAll;
                this.municipiosCheck = [];
                if(this.isCheckAll){ // Check all
                     for (let i = 0; i < this.municipios.length; i++) {
                    this.municipiosCheck.push(this.municipios[i].id);
                    }
                }
                },
                updateCheckall: function(){
                if(this.municipiosCheck.length == this.municipios.length){
                    this.isCheckAll = true;
                }else{
                    this.isCheckAll = false;
                }
            },
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.municipios = resposta.data;      
                        
                    }).catch(error => {
                        console.log(error);
                    });                  

                   
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                    this.textoEscolhaEmpreendimento = "Filtre o Estado"
                }      

                //verifica se a UF escolhida é a mesma que estava cadastrada
                    if(this.estado == this.dadoscontrato.cod_uf){
                        //retorna o municipio cadastrado para o componente municipio
                        this.municipio = this.dadoscontrato.cod_municipio_ibge;
                        this.onChangeMunicipio();
                         this.municipiosCheck = this.listmunic;
                    }else{
                        //armazena os municipios escolhidos que estavam cadastrados
                        this.listmunic = this.municipiosCheck;
                    } 

                  this.ufSelecionado  = this.estado;
                
            },
            onChangeMunicipio() {

                console.log(this.listmunic);

                    //verifica se o municipio principal estava entreg os escolhidos nos checks
                    var index = this.municipiosCheck.indexOf(this.municipio);
                    if (index > -1) {
                        //se o municipio escolhido já havia sido escolhido desmarca ele
                        this.munPrincipalRetirado = this.municipio;
                        this.municipiosCheck.splice(index, 1);
                    }else{

                        //verifica se existe municipio retirado do array
                        if(this.munPrincipalRetirado > 0){
                             //incluir o municipio no array dos checks
                            this.municipiosCheck.push(this.munPrincipalRetirado);
                        }else{
                            
                            this.municipiosCheck = [];
                        }
                    }                       
            },    
            onChangeSecretaria() {
                this.textoEscolhaArea = "Buscando...";
                this.textoEscolhaModalidade = "Filtre a Area"
                
                this.area = '';
                this.fonte = '';
                this.modalidade = '';
                this.buscando = true;
               
                if(this.secretaria != '') {
                   
                    axios.get(this.url + '/api/pac/areas/' + this.secretaria).then(resposta => {
                        this.textoEscolhaArea = "Escolha uma Area:";
                        this.textoEscolhaFonte = "Escolha uma Area:";
                        this.buscando = false;
                        this.areas = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.area = '';
                    this.textoEscolhaArea = "Filtre a Secretaria"
                    this.textoEscolhaModalidade = "Filtre a Area"
                    this.textoEscolhaFonte = "Filtre a Area"

                }            
            },
            onChangeContrato() {
                this.cod_pt = this.cod_pt;
            },    
            onChangeArea() {
                this.textoEscolhaModalidade = "Buscando...";                
                this.modalidade = '';
                this.buscando = true;
               
                if(this.area != '') {
                   
                    axios.get(this.url + '/api/pac/modalidades/areas/' + this.area).then(resposta => {
                        this.textoEscolhaModalidade = "Escolha uma Modalidade:";
                        this.textoEscolhaFonte = "Escolha uma Fonte:";
                        this.buscando = false;
                        this.modalidades = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

                     axios.get(this.url + '/api/pac/monitores/areas/' + this.area).then(resposta => {
                        this.textoEscolhaMonitor = "Escolha um Monitor:";
                        this.buscando = false;
                        this.monitores = resposta.data;
                       
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.modalidade = '';
                    this.textoEscolhaModalidade = "Filtre a Area"
                    this.textoEscolhaFonte = "Filtre a Area"
                    this.textoEscolhaMonitor = "Filtre a Area"
                }            
            },
            onChangeFonte() {
                this.textoEscolhaModalidade = "Buscando...";                
                this.chamada = '';
                this.buscando = true;
                
                if(this.fonte != '') {
                   
                    axios.get(this.url + '/api/pac/chamadas/fontes/' + this.fonte +'/areas/' + this.area).then(resposta => {
                        this.textoEscolhaChamada = "Escolha uma Chamada:";                        
                        this.buscando = false;
                        this.chamadas = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.chamada = '';
                    this.textoEscolhaChamada = "Filtre a Fonte"
                    
                }            
            },
            onChangeModalidade() {
                this.textoEscolhaSubmodalidade = "Buscando...";
                this.subModalidade = '';
                this.buscando = true;
               
                if(this.modalidade != '') {
                   
                    axios.get(this.url + '/api/pac/submodalidades/modalidade/' + this.modalidade + '/areas/' + this.area).then(resposta => {
                        this.textoEscolhaSubmodalidade = "Escolha uma Submodalidade:";
                        this.buscando = false;
                         this.submodalidades = resposta.data;
                            
                        
                        if(this.submodalidades.length==0){
                           this.textoEscolhaSubmodalidade = "Não Existe Submodalildade";
                        }                       
                        
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.subModalidade = '';
                    this.textoEscolhaSubmodalidade = "Filtre o Modalidade"
                }            
            },
            formatarValor(valor,casas) {
                if (valor) {
                    let val = (valor/1).toFixed(casas).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                } else {
                    return '0.00';
                }
            },
            formatarData(data) {
                if (data) {    
                    var dataInput = data;

                    data = new Date(dataInput);
                    return data.toLocaleDateString('pt-BR', {timeZone: 'UTC'});
                } else {
                    return '';
                }
            } 
        },    
        mounted() {
            
            
             //retorna as secretarias
            axios.get(this.url + '/api/pac/secretarias').then(resposta => {
                
                this.secretarias = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna as areas

             axios.get(this.url + '/api/pac/areas/').then(resposta => {
                        this.textoEscolhaArea = "Escolha uma Area:";
                        this.textoEscolhaFonte = "Escolha uma Area:";
                        this.buscando = false;
                        this.areas = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

            //retorna as andamentos

             axios.get(this.url + '/api/pac/andamentos/').then(resposta => {                       
                       
                        this.buscando = false;
                        this.andamentos = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

            //retorna as fontes
            axios.get(this.url + '/api/pac/fontes').then(resposta => {                
                this.fontes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

           

            //retorna as situacaoContratos
            axios.get(this.url + '/api/pac/situacao_contratos').then(resposta => {                
                this.situacaoContratos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna as situacaoObras
            axios.get(this.url + '/api/pac/situacao_obras').then(resposta => {                
                this.situacaoObras = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna as classificacaoCores
            axios.get(this.url + '/api/pac/classificacao_cores').then(resposta => {                
                this.classificacaoCores = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna as estados
            axios.get(this.url + '/api/estados').then(resposta => {                
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna as entidades
            axios.get(this.url + '/api/pac/entidades').then(resposta => {                
                this.entidades = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

             //retorna os agente_financeiro
            axios.get(this.url + '/api/pac/agente_financeiros').then(resposta => {                
                this.agenteFinanceiros = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

       
      
            //retorna as fases
            axios.get(this.url + '/api/pac/fases').then(resposta => {                
                this.fases = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

          

            //retorna os eixos
            axios.get(this.url + '/api/pac/eixos').then(resposta => {                
                this.eixos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

             //retorna os tipos
            axios.get(this.url + '/api/pac/tipos').then(resposta => {                
                this.tipos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna os programas
            axios.get(this.url + '/api/pac/programas').then(resposta => {                
                this.programas = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

           
            //POPULAR CAMPOS
           
            if(this.dadoscontrato){

                 this.botaohabilitado = false;
                    
                    this.contrato_pac = this.dadoscontrato.cod_contrato_pac;
                    this.login_usuario = this.dadoscontrato.txt_login_usuario;
                    this.andamento = this.dadoscontrato.cod_andamento;
                    
               
                    
                    this.contrato = this.dadoscontrato.cod_contrato;
                    
                    this.secretaria = this.dadoscontrato.cod_secretaria;
                     this.onChangeSecretaria();
                     this.area = this.dadoscontrato.cod_area;
                     this.fonte = this.dadoscontrato.cod_fonte;
                     this.onChangeArea();
                    this.onChangeFonte();
                    this.monitor = this.dadoscontrato.cod_usuario_monitor;
                    this.modalidade = this.dadoscontrato.cod_modalidade;
                    this.onChangeModalidade();

                    this.submodalidade = this.dadoscontrato.cod_submodalidade;

                    
                    this.protocolo = this.dadoscontrato.txt_protocolo;
                    this.sequencial = this.dadoscontrato.num_sequencial;
                    this.situacaoContrato = this.dadoscontrato.cod_situacao_contrato;
                    this.situacaoObra = this.dadoscontrato.cod_situacao_obra;
                    this.classificacaoCor = this.dadoscontrato.cod_classificacao_cor;

                    this.estado = this.dadoscontrato.cod_uf;
                    this.onChangeEstado();

                    this.municipio = this.dadoscontrato.cod_municipio_ibge;

                    this.entidade = this.dadoscontrato.cod_entidade_proponente;
                    this.agenteFinanceiro = this.dadoscontrato.cod_agente_financeiro;
                    
                    this.fase = this.dadoscontrato.cod_fase;
                    this.txt_empreendimento = this.dadoscontrato.txt_empreendimento;
                    this.txt_objeto = this.dadoscontrato.txt_objeto;
                    this.txt_descricao_obj = this.dadoscontrato.txt_descricao_obj;
                    this.dte_selecao = this.formatarData(this.dadoscontrato.dte_selecao);
                    this.dte_carga = this.formatarData(this.dadoscontrato.dte_carga);
                    this.vlr_emprestimo = this.formatarValor(this.dadoscontrato.vlr_repasse,2);
                    this.vlr_contrapartida =this.formatarValor( this.dadoscontrato.vlr_contrapartida,2);
                    this.txt_mcid = this.dadoscontrato.txt_mcid;
                    this.chamada = this.dadoscontrato.cod_chamada;
                    if(this.dadoscontrato.bln_ativo == true){
                        this.bln_ativo = 1;
                    }else{
                        this.bln_ativo = 0;
                    }
                    
                    this.entidade_tomadora = this.dadoscontrato.cod_entidade_tomador;
                    this.entidade_executora = this.dadoscontrato.cod_entidade_executora;
                    this.subeixo = this.dadoscontrato.cod_subeixo;
                    this.eixo = this.dadoscontrato.cod_eixo;
                    this.tipo = this.dadoscontrato.cod_tipo;
                    this.subtipo = this.dadoscontrato.cod_subtipo;
                    this.programa = this.dadoscontrato.cod_programa;
                    this.cod_pt = this.dadoscontrato.cod_pt;
                    this.vlr_taxa_administrativa = this.formatarValor(this.dadoscontrato.vlr_taxa_administrativa,2);

                    if(this.dadoscontrato.bln_importado_por_arquivo == "true"){
                        this.tipo_carga = "Registro importado por arquivo";
                    }else{
                        this.tipo_carga = "Registro cadastro pelo formulário";
                    }

                 
                    if(this.municipiobeneficiados){
                        for (let i = 0; i < this.municipiobeneficiados.length; i++) {
                            this.municipiosCheck.push(this.municipiobeneficiados[i].cod_municipio_ibge);
                        }
                    }

                    this.botaohabilitado = true;
                    
            }  


              
        }
    }
</script>
