<template>
    <div class="form-group">
        <div class="form-inline">
            <div class="form-group pull-right">
                <input type="search" class="form-control" placeholder="Buscar" v-model="buscar">
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm ">
                <thead  class="text-center">
                    <tr class="text-center ">
                        <th scope="col" v-for="titulo in titulos">{{titulo}}</th>  
                        
                    </tr>
                </thead>
                <tbody>                  
                    <tr  class="text-center conteudoTabela" v-for="(item,index) in lista">
                        <td>{{item.arquivo_id}}</td>                               
                        <td>{{item.sg_uf}}</td>                               
                        <td>{{item.ds_municipio}}</td>                               
                        <td>{{item.txt_ente_publico}}</td>                   
                        <td>{{aplicarMascaraCPF(item.txt_cpf_usuario)}}</td>                   
                        <td>{{item.name}}</td>                                                       
                        <td>{{formatarData(item.dte_envio)}}</td>                               
                        <td class="text-center" v-if="item.bln_documento_analisado"><i class="fas fa-check-circle text-success"></i></td>                                                       
                        <td class="text-center" v-if="!item.bln_documento_analisado"><i class="fas fa-times-circle text-danger"></i></td>                                                       
                        <td class="text-center" v-if="item.bln_documento_validado"><i class="fas fa-check-circle text-success"></i></td>                                                       
                        <td class="text-center" v-if="!item.bln_documento_validado"><i class="fas fa-times-circle text-danger"></i></td>                                                       
                        
                        <td >
                            <a v-if="!item.bln_documento_analisado" type="button" class="br-button  secondary small mr-3"
                                v-bind:item="item" v-bind:href="url + '/admin/ente_publico/oficios/validar/'+ item.arquivo_id">
                                <i class="fas fa-check"></i>Validar
                            </a>
                            <a v-if="item.bln_documento_analisado" type="button" class="br-button circle secondary small mr-3"
                                v-bind:item="item" v-bind:href="url + '/admin/ente_publico/analise/oficios/'+ item.arquivo_id">
                                <i class="fas fa-eye"></i>
                            </a>

                           
                        </td>                               
                    </tr>                              
                </tbody>
            </table> 
        </div>        
    </div>
</template>

<script>
    export default {
       props:['titulos','itens','url'],
       data: function(){
           return {
               buscar:'' 
           }
       },
        methods:{
           formatarValor(valor,campo) {
                if(!valor) return '';
                valor = valor.toString();
                if(valor.split('-').length == 3){
                    valor = valor.split('-');
                    return valor[2] + '/' + valor[1]+ '/' + valor[0];
                }

                return valor;
            },
            formatarData(data) {
                // Verifica se a data é válida
                if (!data) {
                    return '';
                }

                // Cria um objeto Date a partir da string da data
                const dataObj = new Date(data);

                // Obtém o dia, mês e ano da data
                const dia = String(dataObj.getDate()).padStart(2, '0');
                const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
                const ano = dataObj.getFullYear();

                // Formata a data no formato "dd/mm/yyyy"
                return `${dia}/${mes}/${ano}`;
            },
            aplicarMascaraCPF(cpf) {
               // Remove qualquer caractere que não seja número do CPF
                    cpf = cpf.replace(/\D/g, '');

                // Aplica a máscara: 999.999.999-99
                if (cpf.length > 3) {
                cpf = cpf.replace(/^(\d{3})(\d)/, '$1.$2');
                }

                if (cpf.length > 6) {
                cpf = cpf.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
                }

                if (cpf.length > 9) {
                return cpf.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');
                }
                }
        },    
       filters: {
        formataCampo(valor) {
          if(!valor) return '';
          valor = valor.toString();
          if(valor.split('-').length == 3){
            valor = valor.split('-');
            return valor[2] + '/' + valor[1]+ '/' + valor[0];
          }else if(!isNaN(valor)) {
               if(campo != 'num_apf_obra'){
                if (valor) {
                        let val = (valor/1).toFixed(2).replace('.', ',')
                        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                    } else {
                        return '0.00';
                    }
                } 
          }

          return valor;
        }
        

      },
      computed:{
        lista:function(){
            //let lista = this.itens.data;
            if(this.buscar){
                return this.itens.filter(res => {
                     res = Object.values(res);
                    for(let k = 0;k < res.length; k++){
                        if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                            return true;
                        }
                    }
                    return false;
                });
            }

          return this.itens;
        }
      },
      mounted(){
          
      }
    }
</script>

