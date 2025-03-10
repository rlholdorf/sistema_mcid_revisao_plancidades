@extends('layouts.app')
@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
@endsection



@section('content')
<div class="br-breadcrumb "  style="padding-top: 0px">
   <ul class="crumb-list">
       <li class="crumb home"><a class="br-button circle" href="url"><span class="sr-only">Página inicial</span><i class="fas fa-home"></i></a></li>
       <!--
       <li class="crumb"><i class="icon fas fa-chevron-right"></i><a href="link1">telanterior01</a>
       </li>
       <li  class="crumb"><i class="icon fas fa-chevron-right"></i><a href="link2">telanterior02</a>
       </li>
      -->
       <li class="crumb" ><i class="icon fas fa-chevron-right"></i><span><strong>Dados do Programa</strong></span></li>
       <li class="crumb" ><i class="icon fas fa-chevron-right"></i><span><strong>Dados Abertos</strong></span></li>
       <li class="crumb" data-active="active"><i class="icon fas fa-chevron-right"></i><span>Política de Dados Abertos</span>
       </li>
   </ul>
</div>


<div class="main-content pl-sm-3 mt-4" id="main-content">
  
   <h1>Política de Dados Abertos (PDA) no âmbito do Ministério das Cidades.</h1>
   <span class="br-divider lg my-3"></span>
   
   
  <div class="form-group">
    <p>
        A Política de Dados Abertos do Poder Executivo Federal foi instituída pelo 
        <a class="external-link" href="http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2016/decreto/d8777.htm" target="_blank" title="" data-tippreview-enabled="false" data-tippreview-image="" data-tippreview-title="">Decreto nº 8.777, de 11 de maio de 2016</a>, 
        e tem por objetivo disponibilizar na internet, por parte dos órgãos e entidades da administração pública federal direta, autárquica e fundacional, dados e informações 
        acessíveis ao público que possam ser livremente reutilizados, visando aprimorar a cultura de transparência pública e franquear aos cidadãos, de forma aberta, aos dados 
        produzidos ou acumulados pelo Governo Federal.
    </p>
    <p>
        O propósito deste Plano de Dados Abertos (PDA) é promover a publicação de dados do Ministério das Cidades, em formato aberto, a fim de contribuir para a melhoria da gestão pública, 
        o incremento da transparência, o fomento do controle social, a pesquisa científica de base empírica sobre a gestão pública, o incentivo ao desenvolvimento de novas 
        tecnologias destinadas à construção de ambiente de gestão pública participativa e democrática e a melhor oferta de serviços públicos para o cidadão.
    </p>
    <p>
        Para tal, este plano foi elaborado com base na Lei nº 12.527, de 18 de novembro de 2011, a
chamada Lei de Acesso à Informação (LAI), em orientações do Manual para a Elaboração de Plano de Dados
Abertos da Controladoria-Geral da União (CGU), na Resolução nº 3, de 13 de outubro de 2017, do Comitê Gestor
da Infraestrutura Nacional de Dados Abertos (CG-IND aprova as normas sobre elaboração e publicação de
Planos de Dados Abertos, e no Decreto nº 9.903, de 8 de julho de 2019, que altera o Decreto nº 8.777, de 11 de
maio de 2016, entre outros normativos e documentos que abordam o tema de transparência da informação).
    </p>

    <p>
        O objetivo geral deste plano é promover a publicação de dados do Ministério das Cidades, em formato aberto, a fim de contribuir para a melhoria da
gestão pública, o incremento da transparência, o fomento do controle social, a pesquisa científica de base empírica
sobre a gestão pública, o incentivo ao desenvolvimento de novas tecnologias destinadas à construção de ambiente
de gestão pública participativa e democrática e a melhor oferta de serviços públicos para o cidadão.
    </p>
   
      <span class="br-divider dashed my-3"></span>
  </div>

      
</div>
@endsection


