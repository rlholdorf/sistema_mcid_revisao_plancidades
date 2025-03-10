<template>
<div>
    <div class="form-group">
        <div class="row">
            <div class="col col-xs-12 col-sm-4 br-input input-button">
                <label for="nome_painel" >Nome</label>            
                <input id="nome_painel" type="text" name="nome_painel" v-model="nome_painel" required>                
            </div>
            <div class="col col-xs-12 col-sm-4 br-input input-button">
                <label for="secretaria" >Secretaria</label>            
                <input id="secretaria" type="text" name="secretaria" v-model="secretaria" required>                
            </div>
            <div class="col col-xs-12 col-sm-4 br-input input-button">
                <label for="elaborado_por" >Elaborado por</label>            
                <input id="elaborado_por" type="text" name="elaborado_por" v-model="elaborado_por" required>                
            </div>
        </div>    
        
        <div class="br-textarea">
            <label for="dsc_painel" class="control-label">Descrição</label>
            <textarea class="form-control" 
            id="dsc_painel" 
            name="dsc_painel"  
            v-model="dsc_painel"
            rows="5"></textarea>
        </div>

        <div class="row">
            <div class="col col-xs-12 col-sm-4 br-input input-button">
                <label for="bln_ativo">Ativo</label>           
                    <select 
                        id="bln_ativo"
                        class="form-select br-select" 
                        name="bln_ativo"
                        required
                        v-model="bln_ativo">
                        <option value="">Painel ativo?</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                        
                    </select>                   
            </div>
            <div class="col col-xs-12 col-sm-4 br-input input-button">
                <label for="bln_acesso_externo">Acesso externo</label>           
                    <select 
                        id="bln_acesso_externo"
                        class="form-select br-select" 
                        name="bln_acesso_externo"
                        required
                        v-model="bln_acesso_externo">
                        <option value="">Possui acesso externo?</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                        
                    </select>                   
            </div>
            <div class="col col-xs-12 col-sm-4 br-input input-button">
                <label for="bln_manutencao">Manutenção</label>           
                    <select 
                        id="bln_manutencao"
                        class="form-select br-select" 
                        name="bln_manutencao"
                        required
                        v-model="bln_manutencao">
                        <option value="">Esta em manutenção?</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                        
                    </select>                   
            </div>
        </div> 
        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input input-button">
                <label for="txt_caminho_painel" >URL Painel</label>            
                <input id="txt_caminho_painel" type="text" name="txt_caminho_painel" v-model="txt_caminho_painel" required>                
            </div>
            <div class="col col-xs-12 col-sm-6 br-input input-button">
                <label for="txt_key_power_bi" >Key power BI</label>            
                <input id="txt_key_power_bi" type="text" name="txt_key_power_bi" v-model="txt_key_power_bi" required>                
            </div>
        </div>
        <img v-bind:src='this.caminho_imagem'  class="img-thumbnail" >
        <div class="br-upload">            
            <label class="upload-label" for="single-file"><span>Envio de arquivo</span></label>
            <input class="upload-input" id="single-file" type="file" aria-hidden="null" aria-label="enviar arquivo"/>
            <div class="upload-list"></div>
          </div>
    </div>
    
</div>
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                nome_painel:'',
                secretaria:'',
                elaborado_por:'',
                dsc_painel:'',
                bln_ativo:'',
                bln_acesso_externo:'',
                bln_manutencao:'',
                txt_key_power_bi:'',
                txt_caminho_painel:'',
                caminho_imagem:''
                }
            },
        methods:{
        },
        mounted() {

            if(this.dados){
                this.nome_painel = this.dados.txt_nome_painel;
                this.secretaria = this.dados.txt_secretaria;
                this.elaborado_por = this.dados.txt_elaborado_por;
                this.dsc_painel = this.dados.dsc_painel;

                if(this.dados.bln_ativo){
                    this.bln_ativo = 1;
                }else{
                    this.bln_ativo = 0;
                }

                if(this.dados.bln_acesso_externo){
                    this.bln_acesso_externo = 1;
                }else{
                    this.bln_acesso_externo = 0;
                }

                if(this.dados.bln_manutencao){
                    this.bln_manutencao = 1;
                }else{
                    this.bln_manutencao = 0;
                }

                this.txt_caminho_painel = this.dados.txt_caminho_painel;
                this.txt_key_power_bi = this.dados.txt_key_power_bi;

                this.caminho_imagem = this.url + '\\arquivos\\paineis\\img_carteira_investimento.png';
            }
        }
    }
</script>