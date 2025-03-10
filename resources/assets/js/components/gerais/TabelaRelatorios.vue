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
                        <th scope="col" class="acao" v-if="show">Ação</th>
                    </tr>
                </thead>
                <tbody>                  
                    <tr  class="text-center conteudoTabela" v-for="(item,index) in lista">
                        <td v-for="(i, index2) in item"  >{{formatarValor(i,index2) }}</td>    
                            <td class="acao" v-if="show"><a  v-bind:item="item" v-if="item.id != null"  v-bind:href="show + '/'+ item.id"><i class="fas fa-eye"></i></a></td>  
                    </tr>                              
                </tbody>
            </table> 
        </div>        
    </div>
</template>

<script>
    export default {
       props:['titulos','itens','show'],
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
                }
        },    
       filters: {
        formataCampo(valor,campo) {
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

