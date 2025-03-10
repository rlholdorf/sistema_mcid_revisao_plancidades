@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/fichaAudiencia.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/relatorio_executivo.css')}}" media="screen" />


@endsection

@section('scriptsjs')

<link rel="stylesheet" type="text/css" href="{{ asset('css/graficos.css') }}" media="screen">
<script src="{{URL::asset('js/fichaAudiencia.js')}}"></script>


@endsection


@section('content')

<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Briefing Ministerial'"
    :telanterior02="'Consultar Município'" :telatual="'Ficha Briefing'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">
    <div class="text-center">
        <img src='{{ URL::asset("/img/briefing/banner_briefing_antigo.png")}}' alt="Imagem ilustrativa" />
    </div>

    <cabecalho-relatorios :titulo="'{{$municipio->ds_municipio}} - {{$estado->ds_uf}}'"
        :linkcompartilhar="'{{ url("/api/briefing/ficha_briefing/pesquisar/estado/$estado->id/municipio/$municipio->id") }}'"
        :barracompartilhar="true">
    </cabecalho-relatorios>

    <div class="form-group">

        <div class="card ">
            <div class="card-header text-white bg-primary">SÍNTESE DOS INVESTIMENTOS - Ministério das Cidades</div>
            <div class="card-body">
                <p>
                    ● No Estado do <STRONG>{{$estado->ds_uf}}</STRONG>, o MCID possui <u>investimentos ativos</u> no
                    montante de <STRONG>R$ {{number_format($carteriaMcidEstado->vlr_global, 2, ',' , '.')}}</STRONG> em
                    <STRONG>{{number_format($carteriaMcidEstado->contratos, 0, ',' , '.')}}</STRONG>
                    contratos ativos de
                    <STRONG>{{number_format($carteriaMcidEstado->municipios, 0, ',' , '.')}}</STRONG> Municípios
                </p>

                <p>
                    ● O MCID está fazendo novos investimentos, sendo um pouco mais de <strong>R$
                        {{number_format($novoPacSelecaoEstado->vlr_investimento, 2, ',' , '.')}}</STRONG> com obras do
                    NOVO PAC e cerca de R$
                    <STRONG>{{number_format($selecaoMcmvEstado->sum('num_uh')*$valoresUhMcmvCidadesEstado->vlr_uh, 2, ',' , '.')}}</STRONG>
                    (<STRONG>{{number_format($selecaoMcmvEstado->sum('num_uh'), 0, ',' , '.')}}</STRONG> UH) com novas
                    moradias no MCMV.<br />
                    Total de Novos Investimentos MCID: <strong>R$
                        {{number_format($novoPacSelecaoEstado->vlr_investimento+($selecaoMcmvEstado->sum('num_uh')*$valoresUhMcmvCidadesEstado->vlr_uh), 2, ',' , '.')}}</STRONG>.
                </p>

                <p>
                    ● Em {{$municipio->ds_municipio}}, o MCID possui investimentos ativos no montante de <strong>R$
                        {{number_format($carteriaMcidMunicipio->vlr_global, 2, ',' , '.')}}</strong> em
                    <strong>{{number_format($carteriaMcidMunicipio->contratos, 0, ',' , '.')}}</strong> contratos
                    ativos. O MCID está fazendo
                    novos investimentos na cidade: <strong>R$
                        {{number_format($novoPacSelecaoMunic->vlr_investimento, 2, ',' , '.')}}</STRONG> no NOVO PAC e
                    <STRONG>{{number_format($selecaoMcmvMunicipio->sum('num_uh'), 0, ',' , '.')}}</STRONG> UH
                    <STRONG>{{number_format($selecaoMcmvMunicipio->sum('num_uh')*$valoresUhMcmvCidadesMunic->vlr_uh, 2, ',' , '.')}}</STRONG>
                    milhões em novas moradias MCMV.<br />
                    Total de Novos Investimentos MCID: <strong>R$
                        {{number_format($novoPacSelecaoMunic->vlr_investimento+($selecaoMcmvMunicipio->sum('num_uh')*$valoresUhMcmvCidadesMunic->vlr_uh), 2, ',' , '.')}}</STRONG>.
                </p>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-primary">Minha Casa Minha Vida - {{$estado->ds_uf}}</div>
                    <div class="card-body">
                        <p>
                            <b>Seleções</b>: <STRONG>R$
                                {{number_format($selecaoMcmvEstado->sum('num_uh')*$valoresUhMcmvCidadesEstado->vlr_uh, 2, ',' , '.')}}</STRONG><br />
                            ● {{number_format($selecaoMcmvEstado->sum('num_uh'), 0, ',' , '.')}} UH selecionadas:<br />
                            @foreach($selecaoMcmvEstado AS $dados)
                            - {{$dados->txt_modalidade}} ({{$dados->txt_tipo}}):
                            {{number_format($dados->num_uh, 0, ',' , '.')}} UH <br />
                            @endforeach
                        </p>

                        <p>
                            <b>Entregas</b><br />
                            ● De 2009 até 2024:
                            {{number_format($entreguesOguEstado->num_uh+$entreguesFgtsEstado->num_uh, 0, ',' , '.')}} de
                            UH.<br />
                            ● Em 2023: {{number_format($entreguesOguEstado->num_uh_entregues_2023, 0, ',' , '.')}} UH
                            entregues.<br />
                            ● Para 2024: Entregues
                            {{number_format($entreguesOguEstado->num_uh_entregues_2024, 0, ',' , '.')}} UH.<br />
                        </p>
                        <p>
                            <b>Retomadas</b><br />
                            ● Em 2023/2024 {{number_format($retomadaEstado->num_uh_contratada, 0, ',' , '.')}} UH foram
                            retomadas.<br />
                        </p>
                        <p>
                            <b>Paralisações Evitadas</b> <br />
                            ● Suplementação de R$
                            {{number_format($suplementacaoEstado->vlr_suplementacao, 2, ',' , '.')}} para
                            finalização.<br />
                        </p>
                        <p>
                            <b>FGTS (2023/2024)</b><br />
                            ● Financiadas {{number_format($entreguesFgtsEstado->num_uh_entregues_2023, 0, ',' , '.')}}
                            UH – R$ {{number_format($entreguesFgtsEstado->vlr_financiamento, 2, ',' , '.')}}<br />
                        </p>

                    </div>
                </div>
            </div>
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-primary">Minha Casa Minha Vida - {{$municipio->ds_municipio}}
                    </div>
                    <div class="card-body">
                        <p>
                            <b>Seleções</b>: <STRONG>R$
                                {{number_format($selecaoMcmvMunicipio->sum('num_uh')*$valoresUhMcmvCidadesMunic->vlr_uh, 2, ',' , '.')}}</STRONG><br />
                            ● {{number_format($selecaoMcmvMunicipio->sum('num_uh'), 0, ',' , '.')}} UH
                            selecionadas:<br />
                            @foreach($selecaoMcmvMunicipio AS $dados)
                            - {{$dados->txt_modalidade}} ({{$dados->txt_tipo}}):
                            {{number_format($dados->num_uh, 0, ',' , '.')}} UH<br />
                            @endforeach
                        </p>
                        <p>
                            <b>Entregas</b><br />
                            ● De 2009 até 2024:
                            {{number_format($entreguesOguMunic->num_uh+$entreguesFgtsMunic->num_uh, 0, ',' , '.')}} de
                            UH.<br />
                            ● Em 2023: {{number_format($entreguesOguMunic->num_uh_entregues_2023, 0, ',' , '.')}} UH
                            entregues.<br />
                            ● Para 2024: Entregues
                            {{number_format($entreguesOguMunic->num_uh_entregues_2024, 0, ',' , '.')}} UH.<br />
                        </p>
                        <p>
                            <b>Retomadas</b><br />
                            ● Em 2023/2024 {{number_format($retomadaMunicipio->num_uh_contratada, 0, ',' , '.')}} UH
                            foram retomadas.<br />
                        </p>
                        <p>
                            <b>Paralisações Evitadas</b> <br />
                            ● Suplementação de R$
                            {{number_format($suplementacaoMunicipio->vlr_suplementacao, 0, ',' , '.')}} para
                            finalização.<br />
                        </p>
                        <p>
                            <b>FGTS (2023/2024)</b><br />
                            ● Financiadas
                            {{number_format($entreguesFgtsMunic->num_uh_entregues_2023+$entreguesFgtsMunic->num_uh_entregues_2024, 0, ',' , '.')}}
                            UH – R$ {{number_format($entreguesFgtsMunic->vlr_financiamento, 2, ',' , '.')}}<br />
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <br />
        <div class="row">
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-success">Novo PAC - {{$estado->ds_uf}}</div>
                    <div class="card-body">

                        <p>
                            SELEÇÕES NOVO PAC: R$ <strong>R$
                                {{number_format($novoPacSelecaoEstado->vlr_investimento, 2, ',' , '.')}}</STRONG>.<br>
                            <br>
                            @foreach($listaNovoPacSelecaoEstado as $dados)
                            {{ $dados->modalidade}} - <strong>R$
                                {{number_format($dados->vlr_investimento, 2, ',' , '.')}}</strong> <br>
                            @endforeach
                        </p>

                    </div>
                </div>
            </div>
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-success">Novo PAC - {{$municipio->ds_municipio}}</div>
                    <div class="card-body">
                        <p>
                            SELEÇÕES NOVO PAC: <strong>R$
                                {{number_format($novoPacSelecaoMunic->vlr_investimento, 2, ',' , '.')}}</STRONG>.<br>
                            </br>
                            @foreach($listaNovoPacSelecaoMunic as $dados)
                            {{ $dados->modalidade}} - <strong>R$
                                {{number_format($dados->vlr_investimento, 2, ',' , '.')}}</strong> <br>
                            @endforeach
                        </p>

                    </div>
                </div>
            </div>
        </div>


        <br />
        <div class="row">
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-success">Novo PAC - {{$estado->ds_uf}}</div>
                    <div class="card-body">

                        <div class="table-responsive-sm">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>Eixo</th>
                                        <th>Subeixo</th>
                                        <th>Municípios</th>
                                        <th>Investimento Gov. Federal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($novoPacEixoSubeixoEstado as $dados)
                                    <tr class="text-center">
                                        <td>{{$dados->eixo}}</td>
                                        <td>{{$dados->subeixo}}</td>
                                        <td class="text-center">{{number_format($dados->qtd_municipios, 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($dados->vlr_portaria_total, 2, ',' , '.')}}</td>
                                        @endforeach
                                    <tr class="text-center total">
                                        <td colspan="2"> TOTAL</td>
                                        <td class="text-center">
                                            {{number_format($novoPacEixoSubeixoEstado->SUM('qtd_municipios'), 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($novoPacEixoSubeixoEstado->SUM('vlr_portaria_total'), 2, ',' , '.')}}
                                        </td>
                                    </tr>
                                </tbody><!-- fechar tbody-->
                            </table><!-- fechar table-->
                        </div> <!-- table-responsive-sm -->

                    </div>
                </div>
            </div>
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-success">Novo PAC - {{$municipio->ds_municipio}}</div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>Eixo</th>
                                        <th>Subeixo</th>
                                        <th class="text-center">Investimento Gov. Federal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($novoPacEixoSubeixoMunic as $dados)
                                    <tr class="text-center">
                                        <td>{{$dados->eixo}}</td>
                                        <td>{{$dados->subeixo}}</td>
                                        <td class="text-center">
                                            {{number_format($dados->vlr_portaria_total, 2, ',' , '.')}}</td>
                                        @endforeach
                                    <tr class="text-center total">
                                        <td colspan="2"> TOTAL</td>
                                        <td class="text-center">
                                            {{number_format($novoPacEixoSubeixoMunic->SUM('vlr_portaria_total'), 2, ',' , '.')}}
                                        </td>
                                    </tr>
                                </tbody><!-- fechar tbody-->
                            </table><!-- fechar table-->
                        </div> <!-- table-responsive-sm -->

                    </div>
                </div>
            </div>
        </div>


        <br />

        <div class="row">
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-success">PAC MIGRADO - {{$estado->ds_uf}}</div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>Eixo</th>
                                        <th>Subeixo</th>
                                        <th>Contratos</th>
                                        <th>Municípios</th>
                                        <th>Investimento Gov. Federal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($eixoSubeixoPACEstado as $dados)
                                    <tr class="text-center">
                                        <td>{{$dados->eixo}}</td>
                                        <td>{{$dados->subeixo}}</td>
                                        <td class="text-center">{{number_format($dados->qtd_contratos, 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">{{number_format($dados->qtd_municipios, 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">{{number_format($dados->vlr_repasse, 2, ',' , '.')}}
                                        </td>
                                        @endforeach
                                    <tr class="text-center total">
                                        <td colspan="2"> TOTAL</td>
                                        <td class="text-center">
                                            {{number_format($eixoSubeixoPACEstado->SUM('qtd_contratos'), 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($eixoSubeixoPACEstado->SUM('qtd_municipios'), 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($eixoSubeixoPACEstado->SUM('vlr_repasse'), 2, ',' , '.')}}
                                        </td>
                                    </tr>
                                </tbody><!-- fechar tbody-->
                            </table><!-- fechar table-->
                        </div> <!-- table-responsive-sm -->

                    </div>
                </div>
            </div>
            <div class="col col-xs-12 col-sm-6">
                <div class="card ">
                    <div class="card-header text-white bg-success">PAC MIGRADO - {{$municipio->ds_municipio}}</div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>Eixo</th>
                                        <th>Subeixo</th>
                                        <th class="text-center">Contratos</th>
                                        <th class="text-center">Municípios</th>
                                        <th class="text-center">Investimento Gov. Federal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($eixoSubeixoPACMunic as $dados)
                                    <tr class="text-center">
                                        <td>{{$dados->eixo}}</td>
                                        <td>{{$dados->subeixo}}</td>
                                        <td class="text-center">{{number_format($dados->qtd_contratos, 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">{{number_format($dados->qtd_municipios, 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">{{number_format($dados->vlr_repasse, 2, ',' , '.')}}
                                        </td>
                                        @endforeach
                                    <tr class="text-center total">
                                        <td colspan="2"> TOTAL</td>
                                        <td class="text-center">
                                            {{number_format($eixoSubeixoPACMunic->SUM('qtd_contratos'), 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($eixoSubeixoPACMunic->SUM('qtd_municipios'), 0, ',' , '.')}}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($eixoSubeixoPACMunic->SUM('vlr_repasse'), 2, ',' , '.')}}
                                        </td>
                                    </tr>
                                </tbody><!-- fechar tbody-->
                            </table><!-- fechar table-->
                        </div> <!-- table-responsive-sm -->
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card ">
            <div class="card-header text-white bg-primary">MCMV – FINANCIAMENTOS FGTS</div>
            <div class="card-body">
                <p>Orçamento 2024 POR Região (em milhões) </p>

                <table class="table tab_executivo table-striped table-hover table-sm">
                    <thead>
                        <tr class="celulaCorAzul">
                            <th>Região Geográfica</th>
                            <th>Orçamento Oneroso</th>
                            <th>Pró-Moradia</th>
                            <th>Descontos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orcamentoPorRegiao as $dados)
                        <tr class="text-center conteudoTabela">
                            <td>{{$dados->txt_regiao}}</td>
                            <td>{{number_format($dados->vlr_orcamento_oneroso, 0, ',' , '.')}}</td>
                            <td>{{number_format($dados->vlr_pro_moradia, 0, ',' , '.')}}</td>
                            <td>{{number_format($dados->vlr_descontos, 0, ',' , '.')}}</td>
                        </tr>
                        @endforeach
                        <tr class="total">
                            <td>TOTAL</td>
                            <td>{{number_format($orcamentoPorRegiao->SUM('vlr_orcamento_oneroso'), 0, ',' , '.')}}</td>
                            <td>{{number_format($orcamentoPorRegiao->SUM('vlr_pro_moradia'), 0, ',' , '.')}}</td>
                            <td>{{number_format($orcamentoPorRegiao->SUM('vlr_descontos'), 0, ',' , '.')}}</td>
                        </tr>
                    </tbody>
                </table>

                <p>Comparativo de Volume de Financiamento 2022 X 2024 no Estado</p>

                <table class="table tab_executivo table-striped table-hover table-sm">
                    <thead>
                        <tr class="celulaCorAzul">
                            <th>Região</th>
                            <th>UF</th>
                            <th>Faixa de Renda</th>
                            <th>UH 2022</th>
                            <th>UH 2023</th>
                            <th>UH 2024</th>
                            <th>Variação 2022/2024</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dadosComparativosFGTS as $dados)
                        <tr>
                            <td>{{$dados->txt_regiao}}</td>
                            <td>{{$dados->txt_sigla_uf}}</td>
                            <td>{{$dados->txt_faixa_renda}}</td>
                            <td>{{number_format($dados->num_uh_2022, 0, ',' , '.')}}</td>
                            <td>{{number_format($dados->num_uh_2023, 0, ',' , '.')}}</td>
                            <td>{{number_format($dados->num_uh_2024, 0, ',' , '.')}}</td>
                            <td>{{number_format($dados->prc_variacao_2022_2024*100, 2, ',' , '.')}}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <br>
        <div class="card ">
            <div class="card-header text-white bg-primary">CARTEIRA ATIVA - MINHA CASA MINHA VIDA</div>
            <div class="card-body">

                <p>
                    No Estado do {{$estado->ds_uf}}, o MCID possui
                    <strong>{{number_format($ativaMcmvEstado->contratos, 0, ',' , '.')}}</strong> ativos do MCMV em um
                    investimento total de <strong>R$
                        {{number_format($ativaMcmvEstado->vlr_global, 2, ',' , '.')}}</strong>. <br>

                </p>
                <br>
                <p>
                    No Municío de {{$municipio->ds_municipio}}, o MCID possui
                    <strong>{{number_format($ativaMcmvMunicipio->contratos, 0, ',' , '.')}}</strong> ativos do MCMV em
                    um
                    investimento total de <strong>R$
                        {{number_format($ativaMcmvMunicipio->vlr_global, 2, ',' , '.')}}</strong>. <br>

                </p>
            </div>
        </div>
    </div>
    <br />
    <div class="card ">
        <div class="card-header text-white bg-warning">CONTRATO REPASSE</div>
        <div class="card-body">

            <p>
                Existem <a class="menu-item"
                    href='{{url("/briefing/contrato_repasse/municipio/$municipio->id_municipio")}}'
                    title="Contratos de Repasses ativos em Belém"><strong>{{number_format($contratoRepasseMunic->SUM('contratos'), 0, ',' , '.')}}</strong></a>
                contratos de repasses ativos em {{$municipio->ds_municipio}} – <strong>R$
                    {{number_format($contratoRepasseMunic->SUM('vlr_global'), 2, ',' , '.')}}</strong><br>
                Onde <strong>{{number_format($dadosContratoRepJader->contratos, 0, ',' , '.')}} </strong>deles são
                Gestão Lula/Jader<br>
                @foreach ($contratoRepasseMunic as $dados)
                ● {{number_format($dados->contratos, 0, ',' , '.')}} são {{$dados->secretaria}} com Valor Total de
                <strong>{{number_format($dados->vlr_global, 2, ',' , '.')}} </strong>.<br>
                @endforeach
            </p>



        </div>
    </div>
    <br>
    <div class="card ">
        <div class="card-header text-white bg-danger">RESULTADO FINAL - SELEÇÃO MCMV FNHIS</div>
        <div class="card-body">

            <p>
                Em Relação ao Resultado Final MCMV FNHIS no Estado do {{$estado->ds_uf}}:
                <strong>{{$selecaoMcmvEstado->where('txt_modalidade', 'FNHIS')->sum('qtd_municipios')}}</strong>
                Municípios
                foram contemplados com um total de
                <strong>{{number_format($selecaoMcmvEstado->where('txt_modalidade', 'FNHIS')->sum('num_uh'), 0, ',' , '.')}}</strong>
                de UH, Totalizando <strong>R$
                    {{number_format($selecaoMcmvEstado->where('txt_modalidade', 'FNHIS')->sum('num_uh')*$valoresUhMcmvCidadesEstado->vlr_uh, 2, ',' , '.')}}</strong>:
                <br>
                @foreach($selecaoMcmvEstado->where('txt_modalidade', 'FNHIS') as $dados)
                @if($dados->txt_modalidade == 'FNHIS')

                - FNHIS {{$dados->txt_tipo}}: <strong>{{number_format($dados->qtd_municipios, 0, ',' , '.')}}</strong>
                Municípios foram contemplados com um total de
                <strong>{{number_format($dados->num_uh, 0, ',' , '.')}}</strong> de UH, Totalizando <strong>R$
                    {{number_format($dados->num_uh*$valoresUhMcmvCidadesEstado->vlr_uh, 2, ',' , '.')}}</strong></br>
                @endif
                @endforeach
            </p>


        </div>
    </div>
</div>
<div class="p-3 text-right">
    <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir"
        onclick="window.print();">Imprimir
    </button>
    <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
    </button>
</div>

</div>

@endsection