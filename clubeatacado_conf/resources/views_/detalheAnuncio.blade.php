@extends('layouts.site')
@include('layouts\_includes\topoAnuncio')

@section('content')

<!--------------------------------------breadcrumb--------------->
<section class="section">
    <div class="container has-text-left">

        <nav class="breadcrumb" aria-label="breadcrumbs" style="font-family:'Roboto';">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#" aria-current="page">Alimentos</a></li>
                <li><a href="#" aria-current="page">Legumes e verduras</a></li>
                <li><a href="#" aria-current="page">Tomate</a></li>
            </ul>
        </nav>

        <div class="columns">

            <div class="column">
                <figure class="image">
                    <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 641px; width: 636px">
                </figure>
                <br>
                <div class="columns has-text-left">
                    <div class="column">
                        <figure class="image">
                            <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 70px; width: 72px">
                        </figure>
                    </div>
                    <div class="column">
                        <figure class="image">
                            <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 70px; width: 72px">
                        </figure>
                    </div>
                    <div class="column">
                        <figure class="image">
                            <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 70px; width: 72px">
                        </figure>
                    </div>
                    <div class="column">
                        <figure class="image">
                            <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 70px; width: 72px">
                        </figure>
                    </div>
                    <div class="column">
                        <figure class="image">
                            <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 70px; width: 72px">
                        </figure>
                    </div>
                    <div class="column">
                        <figure class="image">
                            <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 70px; width: 72px">
                        </figure>
                    </div>
                    <div class="column">
                        <figure class="image">
                            <img class="image" src="{{ asset('css\img\alok.png') }}" style="height: 70px; width: 72px">
                        </figure>
                    </div>
                </div>

                <div class="tabs is-centered" style="border-bottom-color:#ffffff">
                    <ul style="border-bottom-color:#ffffff">
                        <li class="is-active"><a>Descrição &nbsp </a></li>
                        <li><a>Produtores &nbsp </a></li>
                        <li><a>Origem &nbsp </a></li>
                        <li><a>Nutrição &nbsp </a></li>
                        <li><a>Envios &nbsp </a></li>
                    </ul>
                </div>

                <p class="subtitle is-7" style="text-align:left;font-family:'Roboto';">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.
                </p>

            </div>

            <!--------------------------------------INFORMAÇÕES DO PRODUTO--------------->
            <div class="column is-5" style="padding-left: 31px">

                <article class="media">
                    <div class="media-left" style="width: 81px;height: 22px;background-color:red;">
                        <span class="subtitle is-8" style="color:#ffffff;padding:8px">Temporada</span>
                    </div>
                    <div class="media-right" style="width: 81px;height: 22px; background-color:red;">
                        <span class="subtitle is-8" style="color:#ffffff;padding:8px">Top ventas</span>
                    </div>
                </article>

                <div class="media-content">

                    <p class="title is-bold">Cesta de verduras</p>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <font class="subtitle is-6">Antes</font>
                                <font class="subtitle is-8 is-danger"><strike>R$12,60</strike></font>
                                <font class="subtitle is-8 is-danger" style="background-color:#ffe500;">10% de desconto</font>
                            </div>
                        </div>
                        <p class="title is-bold">R$ 10,92 <font class="subtitle is-6">(Sale a R$16,70/Kg)</font>
                        </p>
                        <p class="subtitle is-6" style="text-align:left;">Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Maecenas varius tortor nibh, sit amet tempor
                            nibh finibus et.Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Maecenas varius tortor
                            nibh, sit amet tempor nibh finibus et. <br><a href="#" class="subtitle is-6" style="color:#17b330"><u>Ver mais detalhes</u></a></p>
                        <p class="subtitle is-6 is-bold" style="text-align:left;">Seleção de peso</p>
                        <div class="navbar-menu" style="display: flex !important;">

                            <div class="navbar-item ">
                                <a class="navbar-item" style=" background-color:#E8FCEC;border-radius:17px;">
                                    250 g
                                </a>
                            </div>
                            <div class="navbar-item ">
                                <a class="navbar-item" style="color:#ffffff; background-color:#14B330;border-radius:17px;">
                                    500 g
                                </a>
                            </div>
                            <div class="navbar-item ">
                                <a class="navbar-item" style="background-color:#ECFCEC;border-radius:17px;">
                                    1.000 g
                                </a>
                            </div>
                        </div>
                        <br><br>
                        <nav class="level">
                            <div class="level-left" style="background-color:#f2f2f2;border-radius:75px">
                                <div class="level-item">
                                    <a><img style="height:28px; width:28px" src="{{ asset('css\img\icons8-minus-50.png') }}"></a>
                                    <span class="subtitle is-bold" style="font-size:16px;color:#1a1a1a;"> &nbsp 1 &nbsp </span>
                                    <a><img style="height:28px; width:28px" src="{{ asset('css\img\icons8-plus-50.png') }}"></a>
                                </div>
                            </div>

                        </nav>

                    </div>
                    <br><br>

                    <p class="control">
                        <a class="button is-success" style="height: 56px;width: 384px;border-radius:0px">COMPRAR</a>
                    </p>
                </div>
            </div>
        </div>


</section>

<!--------------------------------------COMPLETE SUA MESA--------------->

<section class="section">
    <div class="container has-text-left">
        <h1 class="titulos-1" style="width:447px;">Complete a sua mesa</h1><br>
    </div>
    <br>


    <div class="container has-text-left">
        <div class="columns has-text-left">
            <div class="column">
                <div class="card">

                    <div class="card-image">
                        <figure class="image" style="height: 288px; width: 255px;">
                            <div class="container" style="position:absolute; left:20px; width:106px;height:32px;background-color:#FFE500;">
                                <p class="subtitle is-danger is-6" style="position:absolute; top:8px;right:15px;width:75px;font-weight:bold;">OFERTAS</p>
                            </div>
                            <img src="{{ asset('css\img\fitness.png') }}" style="height: 288px; width: 255px;" alt="Placeholder image">
                        </figure>
                    </div>

                    <div class="card-content" style="padding:10px;box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15);">

                        <div class="content">
                            <article class="media">

                                <div class="media-content">
                                    <div class="field">
                                        <p class="control">
                                        <p class="subtitle is-bold is-6 is-left">Alface do campo</p>
                                        <font class="subtitle is-8 is-danger"><strike>R$72,00</strike></font>
                                        <font class="subtitle is-6">R$45,00 / kilo</font>
                                        </p>
                                    </div>
                                    <nav class="level">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <a class="button gradiente"><img style="height:27x; width:30px" src="{{ asset('css\img\icons8-favorite-60.png') }}"></a>
                                            </div>
                                        </div>
                                        <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                            <div class="level-item">
                                                <a><img style="height:28px; width:28px" src="{{ asset('css\img\icons8-minus-50.png') }}"></a>
                                                <span class="subtitle is-bold" style="font-size:16px;color:#1a1a1a;"> &nbsp 3 &nbsp </span>
                                                <a><img style="height:28px; width:28px" src="{{ asset('css\img\icons8-plus-50.png') }}"></a>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </article>
                        </div>

                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">

                    <div class="card-image">

                        <figure class="image" style="height: 288px; width: 255px;">
                            <div class="container" style="position:absolute; left:20px; width:106px;height:32px;background-color:#FFE500;">
                                <p class="subtitle is-danger is-6" style="position:absolute; top:8px;right:15px;width:75px;font-weight:bold;">OFERTAS</p>
                            </div>
                            <img src="{{ asset('css\img\fitness.png') }}" style="height: 288px; width: 255px;" alt="Placeholder image">
                        </figure>
                    </div>

                    <div class="card-content" style="padding:10px;box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15);">

                        <div class="content">
                            <article class="media">

                                <div class="media-content">
                                    <div class="field">
                                        <p class="control">
                                        <p class="subtitle is-bold is-6 is-left">Alface do campo</p>
                                        <font class="subtitle is-8 is-danger"><strike>R$72,00</strike></font>
                                        <font class="subtitle is-6">R$45,00 / kilo</font>
                                        </p>
                                    </div>
                                    <nav class="level">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <a class="button gradiente"><img style="height:27x; width:30px" src="{{ asset('css\img\icons8-favorite-60.png') }}"></a>
                                            </div>
                                        </div>
                                        <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                            <div class="level-item">

                                                <a><img style="height:34px; width:34px" src="{{ asset('css\img\general-icons-32-px-ic-plus-circle.png') }}"></a>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </article>
                        </div>

                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">

                    <div class="card-image">

                        <figure class="image" style="height: 288px; width: 255px;">
                            <img src="{{ asset('css\img\fitness.png') }}" style="height: 288px; width: 255px;" alt="Placeholder image">
                        </figure>
                    </div>

                    <div class="card-content" style="padding:10px;box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15);">

                        <div class="content">
                            <article class="media">

                                <div class="media-content">
                                    <div class="field">
                                        <p class="control">
                                        <p class="subtitle is-bold is-6 is-left">Alface do campo</p>
                                        <font class="subtitle is-8 is-danger"><strike>R$72,00</strike></font>
                                        <font class="subtitle is-6">R$45,00 / kilo</font>
                                        </p>
                                    </div>
                                    <nav class="level">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <a class="button gradiente"><img style="height:27x; width:30px" src="{{ asset('css\img\icons8-favorite-60.png') }}"></a>
                                            </div>
                                        </div>
                                        <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                            <div class="level-item">
                                                <a><img style="height:28px; width:25px" src="{{ asset('css\img\general-icons-32-px-ic-trash.png') }}"></a>
                                                <span class="subtitle is-bold" style="font-size:16px;color:#1a1a1a;"> &nbsp 1 &nbsp </span>
                                                <a><img style="height:28px; width:28px" src="{{ asset('css\img\icons8-plus-50.png') }}"></a>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </article>
                        </div>

                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">

                    <div class="card-image">

                        <figure class="image" style="height: 288px; width: 255px;">
                            <div class="container" style="position:absolute; left:20px; width:106px;height:32px;background-color:#FFE500;">
                                <p class="subtitle is-danger is-6" style="position:absolute; top:8px;right:15px;width:75px;font-weight:bold;">OFERTAS</p>
                            </div>
                            <img src="{{ asset('css\img\fitness.png') }}" style="height: 288px; width: 255px;" alt="Placeholder image">
                        </figure>
                    </div>

                    <div class="card-content" style="padding:10px;box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15);">

                        <div class="content">
                            <article class="media">

                                <div class="media-content">
                                    <div class="field">
                                        <p class="control">
                                        <p class="subtitle is-bold is-6 is-left">Alface do campo</p>
                                        <font class="subtitle is-8 is-danger"><strike>R$72,00</strike></font>
                                        <font class="subtitle is-6">R$45,00 / kilo</font>
                                        </p>
                                    </div>
                                    <nav class="level">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <a class="button gradiente"><img style="height:27x; width:30px" src="{{ asset('css\img\icons8-favorite-60.png') }}"></a>
                                            </div>
                                        </div>
                                        <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                            <div class="level-item">

                                                <a><img style="height:34px; width:34px" src="{{ asset('css\img\general-icons-32-px-ic-plus-circle.png') }}"></a>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </article>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
       
    });
   
</script>
@endsection