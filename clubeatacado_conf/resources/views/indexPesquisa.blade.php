@extends('layouts.siteNovo')
@include('layouts\_includes\topoIndex')
@section('content')

<section class="section">
    <div class="columns has-text-left" style="height: 25px !important;">
        <div class="column2" style="height: 25px !important;">
            <h1 class="titulos-1" style="width:447px;" id="titulo"></h1><br>
        </div>
        <div id="filtro" class="column">
            <div class="navbar-end">
                <div class="navbar-item">
                    <span onclick="alterarIconeCollapse('abrir')" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="abrirCollapse" class="navbar-link" style="padding: 0px;cursor: pointer;">Filtro &nbsp <img src="css\img\atoms-icons-07-others-oth-22-filter.png"></span>
                    <span onclick="alterarIconeCollapse('fechar')" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="fecharCollapse" class="navbar-link" style="color:#17B330;cursor: pointer;display:none">Fechar &nbsp <img src="css\img\atoms-icons-07-others-oth-11-cross-close.png"></span>
                </div>
                <div class="navbar-item has-dropdown is-hoverable" style="align-items: center;width:170px;cursor: pointer;">
                    Ordenar por preço: <img src="css\img\atoms-icons-07-others-oth-5-arrow.png">
                    <div class="navbar-dropdown">
                        <a onclick="ordenarProdutos('barato')" class="navbar-item">
                            Mais barato
                        </a>
                        <a onclick="ordenarProdutos('caro')" class="navbar-item">
                            Mais caro
                        </a>
                        <a onclick="ordenarProdutos('vendido')" class="navbar-item">
                            Mais vendido
                        </a>
                        <a onclick="ordenarProdutos('AZ')" class="navbar-item">
                            de A a Z
                        </a>
                        <a onclick="ordenarProdutos('ZA')" class="navbar-item">
                            de Z a A
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="wrap-collabsible">
        <input id="collapsible" class="toggle" type="checkbox">
        <label for="collapsible" class="lbl-toggle">Filtro</label>
        <div class="collapsible-content">
            <div class="content-inner">
                <div class="card card-body">
                    <br>
                    <div class="container" style="padding:0px;height: 25px;">
                        <div class="columns">
                            <div class="column">
                                <p class="subtitle is-6" style="text-align:left;">Categoria 1</p>
                                <div class="card">
                                    <select id="categoria1" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="column">
                                <p class="subtitle is-6" style="text-align:left;">Categoria 2</p>
                                <div class="card">
                                    <select id="categoria2" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="column">
                                <p class="subtitle is-6" style="text-align:left;">Categoria 3</p>
                                <div class="card">
                                    <select id="categoria3" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="column">
                                <p class="subtitle is-6" style="text-align:left;">Preço</p>
                                <section style="margin-top: 10px">
                                    <input min="0" max="10000" id="price-max" type="range" multiple="" value="0" class="multirange ghost" style="--low:0%; --high:100%;height: 2px;width: 200px">
                                </section>
                            </div>
                        </div>
                    </div>
                    <section class="section has-text-centered" style="margin-top: 70px;margin-bottom: -40px;">
                        <br>
                        <div class="buttons is-right">
                            <button onclick="recarregarPagina()" class="button gradiente is-outlined" style="color:#17B330;width: 232px;">Limpar filtro</button>
                            <button onclick="pesquisar()" class="button gradiente is-success" style="color: #ffffff;width: 232px">Aplicar filtro</button>
                        </div>
                    </section>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row" id="lista" style="left: 85px;position: relative;">
    </div>
    <br>
    <section class="section has-text-centered">
        <button id="btn-ver-mais" onclick="carregarCategorias()" class="button is-outlined is-success" style="display: none;width: 232px;margin-left: 510px;"> Ver
            Mais</button>
    </section>
    <section class="section has-text-centered">
        <button id="recarregar-pagina" onclick="recarregarPagina()" class="button is-outlined is-success" style="display:none;width: 232px;margin-left: 510px;"> Recarregar Página</button>
    </section>
    </div>

</section>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        onload();
        OmRangeSlider.init({
            min: 0,
            max: 999999,
            unit: ' Pcs.',
        });
    });

    function alterarIconeCollapse(acao) {
        if (acao == 'abrir') {
            $('#abrirCollapse').css('display', 'none');
            $('#fecharCollapse').css('display', 'block');
        } else {
            $('#fecharCollapse').css('display', 'none');
            $('#abrirCollapse').css('display', 'block');
        }
    }
</script>
@endsection