@extends('layouts.topo')

@section('content')
    <br>
    <br>
    <br>
    <br>
    <section>
    <div class="container hero-body ">
        <div class="column is-6 has-text-left is-pulled-left">
            <h1 class="title titulo is-size-2">
                <span class="has-text-grey-dark"> Guia de </span><span> Reciclagem</span>
            </h1>
            <h2 class=" is-size-4 color-grey">
                Resíduos sólidos urbanos
            </h2>
            <p style="margin-top:1em;">Os chamados Resíduos Sólidos Urbanos (RSUs, de acordo com a norma NBR.10.004 da Associação Brasileira de Normas Técnicas - ABNT), vulgarmente denominados como lixo urbano, são resultantes da atividade doméstica e comercial dos centros urbanos. A composição varia de população para população, dependendo da situação socioeconômica e das
                condições e hábitos de vida de cada um. Esses resíduos podem ser classificados das seguintes maneiras</p>
        </div>

        <div class="column is-6 is-pulled-left">
            <img src="images/menina-guia.png" alt="" class="img-centered">
        </div>
    </div>
    </section>
    @for($i=0; $i<5; $i++)
    <materiais titulo="Plástico"
           descricao="Copos, Sacos/ Sacolas, Frascos de produtos, Tampas, Potes, Canos e Tubos de PVC…"
    >

    </materiais>
    @endfor


@endsection