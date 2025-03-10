@extends('layouts.app')




@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :titulosemlink="'Dados do Programa'"
      :telanterior01="'Dados Abertos'"    
      :telatual="'Dados Abertos da SNH'"
      >

</historico-navegacao>



<div class="main-content pl-sm-3 mt-4" id="main-content">
  
   <cabecalho-form
      :titulo="'Dados Abertos da SNH'"
      //:dataatualizacao="''"
      :linkcompartilhar="'{{ url("/dados_abertos/sistema_habitacao") }}'"
      barracompartilhar="true">
   </cabecalho-form> 
  
  
   
   
  <div class="form-group">
      <h3>Ministério do Desenvolvimento Regional</h3>                   
      <p>Criado em janeiro de 2019 com o desafio de integrar, numa única Pasta, as diversas políticas públicas de infraestrutura urbana e de promoção do desenvolvimento regional e produtivo. As ações da Pasta visam apoiar os 5.570 municípios brasileiros na melhoria da qualidade de vida da população. Foi estruturado a partir da junção dos antigos Ministérios das Cidades (MCid) e da Integração Nacional (MI), com adaptações para otimizar a administração de programas, recursos e financiamentos.</p>
      <p>Veja o Plano de Dados Abertos do MDR - agosto/2021 a agosto /2023 (<a href="https://www.gov.br/mdr/pt-br/acesso-a-informacao/plano_de_dados_abertos_do_mdr_2021_2023.pdf" target="_blank" rel="nofollow">https://www.gov.br/mdr/pt-br/acesso-a-informacao/plano_de_dados_abertos_do_mdr_2021_2023.pdf</a>)</p>
      <p>Acesse o Portal de Dados Abertos do MDR: <a href="https://dadosabertos.mdr.gov.br/" target="_blank" rel="nofollow">https://dadosabertos.mdr.gov.br/</a>)</p>

      <span class="br-divider dashed my-3"></span>
  </div>

  <div class="form-group">
      <h3>Secretaria Nacional da Habitação</h3>                  
      <p>A Secretaria Nacional de Habitação (SNH) é responsável por acompanhar e avaliar, além de formular e propor, os instrumentos para a implementação da Política Nacional de Habitação, em articulação com as demais políticas públicas e instituições voltadas ao desenvolvimento urbano, com o objetivo de promover a universalização do acesso à moradia.</p>
      <p>Nesse sentido a SNH desenvolve e coordena ações que incluem desde o apoio técnico aos entes federados e aos setores produtivos até a promoção de mecanismos de participação e controle social nos programas habitacionais. Cabe ainda à Secretaria Nacional de Habitação coordenar e apoiar as atividades referentes à área de habitação no Conselho das Cidades. </p>
      
      <h4>Sistema de Gerenciamento da Habitação - SISHAB</h4>
      <p>Dados do Sistema de Habitação com as operações contratadas e dos beneficiários do Programa Minha Casa Minha Vida (MCMV).</p>
      <p>O programa reúne iniciativas habitacionais do governo federal para ampliar o estoque de moradias e atender as necessidades habitacionais da população. O programa vai promover o desenvolvimento institucional de forma eficiente no setor de habitação e estimular a modernização do setor da construção e a inovação tecnológica.</p>
      <p>O MCMV é a maior iniciativa de acesso à casa própria já criada no Brasil. O programa, que mudou a história da habitação do País, prevê diversas formas de atendimento às famílias que necessitam de moradia, considerando a localização do imóvel – na cidade e no campo, renda familiar e valor da unidade habitacional. Além disso, contribui para geração de emprego e renda aos trabalhadores da construção civil. Para mais informações sobre os empreendimentos, os valores, as contratações, as entregas, e outros dados relevantes do PMCMV, acesse o Sistema de Gerenciamento da Habitação (SISHAB).</p>
      <span class="br-divider dashed my-3"></span>
   </div>


      <div class="form-group">
         <h3>Dados e Recursos</h3>
         <div class="table-responsive bde-table">
         <table class="table table-striped bitstreams">
               <tr>
                  <th id="t1" class="standard">Arquivo</th>
                  <th id="t3" class="standard">Descrição</th>
                  <th  id="t4" class="standard">Formato</th>                
               </tr>
               <tr>
                  <td headers="t1" class="standard break-all">
                     <a href='{{ url("/dados_abertos/_contratacoes_pcmv_pcva.csv") }}' target="_blank"><i class="fas fa-download"></i> _contratacoes_pcmv_pcva.csv</a>
                  </td>
                  <td headers="t3" class="standard">Dados de Contratação dos programas Minha Casa Minha Vida Faixa 1 e FGTS</td>
                  <td headers="t4" class="standard">CSV</td>
               </tr>
               <tr>
                  <td headers="t1" class="standard break-all">
                     <a href='{{ url("/dados_abertos/documentacao_campos_sishab.pdf") }}' target="_blank"><i class="fas fa-download"></i> documentacao_campos_sishab.pdf</a>
                  </td>
                  <td headers="t3" class="standard">Dicionário de Dados</td>
                  <td headers="t4" class="standard">PDF</td>
               </tr>
         </table>
         </div>
         <span class="br-divider dashed my-3"></span>
      </div>
      <div class="form-group">
           <h3>Informações Adicionais</h3>
          <section class="additional-info">            
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                   <tr>
                      <th scope="col">Campo</th>
                      <th scope="col">Valor</th>
                   </tr>
                </thead>
                <tbody>
                   <tr>
                      <th scope="row" class="dataset-label">Fonte</th>
                      <td class="dataset-details" property="foaf:homepage"><a href="http://sishab.mdr.gov.br/" rel="foaf:homepage" target="_blank">http://sishab.mdr.gov.br/</a></td>
                   </tr>
                   <tr>
                      <th scope="row" class="dataset-label">Autor</th>
                      <td class="dataset-details" property="dc:creator"><a href=mailto:ouvidoria@mdr.gov.br>Secretaria Nacional de Habitação</a></td>
                   </tr>
                   <tr>
                      <th scope="row" class="dataset-label">Mantenedor</th>
                      <td class="dataset-details" property="dc:contributor"><a href=mailto:ouvidoria@mdr.gov.br>Coordenação de Dados e Informações - CDI</a></td>
                   </tr>
                   <tr>
                      <th scope="row" class="dataset-label">Versão</th>
                      <td class="dataset-details">1.0</td>
                   </tr>
                   <tr>
                      <th scope="row" class="dataset-label">Última Atualização</th>
                      <td class="dataset-details">
                         <!-- Snippet snippets/local_friendly_datetime.html start -->
                         <span class="automatic-local-datetime" data-datetime="">
                            
                         </span>
                         <!-- Snippet snippets/local_friendly_datetime.html end -->
                      </td>
                   </tr>
                   <tr>
                      <th scope="row" class="dataset-label">Criado</th>
                      <td class="dataset-details">
                         <!-- Snippet snippets/local_friendly_datetime.html start -->
                         <span class="automatic-local-datetime" data-datetime="2021-10-08T14:08:36-0300">
                         28/10/2021
                         </span>
                         <!-- Snippet snippets/local_friendly_datetime.html end -->
                      </td>
                   </tr>
                   <tr rel="dc:relation" resource="_:extra">
                      <th scope="row" class="dataset-label" property="rdfs:label">Cobertura geográfica</th>
                      <td class="dataset-details" property="rdf:value">Nacional</td>
                   </tr>
                   <tr rel="dc:relation" resource="_:extra">
                      <th scope="row" class="dataset-label" property="rdfs:label">Cobertura temporal</th>
                      <td class="dataset-details" property="rdf:value">2009-2021</td>
                   </tr>
                   <tr rel="dc:relation" resource="_:extra">
                      <th scope="row" class="dataset-label" property="rdfs:label">Frequência de atualização</th>
                      <td class="dataset-details" property="rdf:value">Mensal</td>
                   </tr>
                   <tr rel="dc:relation" resource="_:extra">
                      <th scope="row" class="dataset-label" property="rdfs:label">Metodologia</th>
                      <td class="dataset-details" property="rdf:value">SGBD PostgreSQL</td>
                   </tr>
                </tbody>
             </table>
          </section>
      </div>
</div>
@endsection


