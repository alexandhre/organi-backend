@extends('layouts.land')

@section('content')
    <section class="hero is-medium is-bold background-top">
        <div class="hero-body ">
            <div class="column is-6 has-text-centered is-pulled-left">
                <h1 class="title is-1">
                    Ganhe dinheiro com <br> os seus resíduos
                </h1>
                <h2 class="subtitle is-4">
                    Recicle e transforme a sua cidade
                </h2>
                <a href="/vender" class="button btn-banner"> QUERO VENDER</a>
            </div>
            <div class="column is-6 is-pulled-left">
                <img src="images/pareja_web.png" alt="">
            </div>
        </div>
    </section>

        <ofertas v-bind:list="{{$anuncio}}"></ofertas>

    <!-- -->
    <div class="img-background-verde">
        <div class="container ">
            <div class=" has-text-centered">
                <div class="columns is-vcentered">
                    <div class="column is-5 img-background">
                        <h1 class="title is-2 has-text-white">
                            Coleta Reversa
                        </h1>
                        <p class="has-text-centered">
                            <a class="button is-medium is-primary is-inverted is-outlined" href="/programa/coletareversa">
                                Clique aqui para saber mais
                            </a>
                        </p>
                    </div>
                    <div class="column is-5 img-background2">
                        <h1 class="title is-2 has-text-white">
                            Programa vale-luz
                        </h1>
                        <p class="has-text-centered">
                            <a class="button is-medium is-primary is-inverted is-outlined" href="/programa/valeluz">
                                Clique aqui para saber mais
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Section Mapa -->
    <div class="container has-text-centered">
        <div class="column is-10  is-offset-1">
            <h1 class="title titulo-mapa  ">
                Pontos de entrega voluntária (PEV)
            </h1>
            <h2 class="subtitle text-mapa is-offset-1">
                Os pontos de entrega voluntária(PEV), são locais oferecidos pela Secretaria ou
                Depatarmento de Limpeza Urbana para que os cidadãos possam descartar
                de maneira adequada seus resíduos.
            </h2>

        </div>
        <!-- MAPA -->
        <div class="hero" style="background:url(images/mapa.png) no-repeat; background-size:cover; height:525px;">
            <!-- <div id="map"></div> -->
        </div>
    </div>

    <div class="hero img-background-verde2">
        <feature></feature>


        <div class="container has-text-centered features">

            <div class="columns is-vcentered">
                <div class="column is-6 ">
                    <h1 class="subtitle is-2 has-text-left titulo column is-10">
                        Contização de cada tipo de <span>  material reciclável</span>
                    </h1>
                    <div class="column is-8">
                        Let this cover page describe a product or service.
                        Let this cover page describe a product or service.
                        Let this cover page describe a product or service.
                        Let this cover page describe a product or service.

                    </div>
                    <br>
                    <p class="has-text-centered column is-8">
                        <a class="button is-medium is-success is-outlinedy is-outlined is-fullwidth" href="/cotizacao">
                            Ver Cotização
                        </a>

                    </p>
                </div>

                <div class="column is-6">
                    <figure class="image is-5by4 size-img">
                        <img src="images/mockup_cotz.png" alt="Recicla">
                    </figure>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection
