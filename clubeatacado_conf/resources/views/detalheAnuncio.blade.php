@extends('layouts.siteNovo')
@include('layouts\_includes\topoAnuncio')

@section('content')

<!--------------------------------------breadcrumb--------------->
<section class="section" style="padding-bottom: 810px;">
    <div class="container has-text-left">

        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#" aria-current="page">Leilão</a></li>
                <li><a href="#" aria-current="page">Verduras do campo</a></li>
            </ul>
        </nav>

        <div class="columns">

            <div class="column">
                <!-- Slideshow container -->
                <div class="slideshow-container">
                    <div id="listFotos">


                    </div>
                    <!-- Full-width images with number and caption text -->
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>

                <!-- The dots/circles -->
                <div id="listCurrentSlide" style="text-align:center">
                </div>
                <br>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-descricao-tab" data-toggle="tab" href="#nav-descricao" role="tab" aria-controls="nav-descricao" aria-selected="true">Descrição</a>
                                <a class="nav-item nav-link" id="nav-produtores-tab" data-toggle="tab" href="#nav-produtores" role="tab" aria-controls="nav-produtores" aria-selected="false">Produtor</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-descricao" role="tabpanel" aria-labelledby="nav-descricao-tab">
                                <p id="descricao" class="subtitle is-7">
                                </p>
                            </div>
                            <div class="tab-pane fade" id="nav-produtores" role="tabpanel" aria-labelledby="nav-produtores-tab">
                                <p id="produtores" class="subtitle is-7">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--------------------------------------INFORMAÇÕES DO PRODUTO--------------->
            <div class="column is-5" style="padding-left: 31px">

                <article class="media" id="tags">
                </article>

                <div class="media-content">

                    <p class="title is-bold" id="ds_produto"></p>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content" id="vl_antigo">
                               
                            </div>
                        </div>
                        <p class="title is-bold" id="vl_produto"></p>
                        <p class="subtitle is-6" style="text-align:left;" id="desc">
                        <br><a href="#" class="subtitle is-6" style="color:#17b330"><u>Ver mais detalhes</u></a></p>
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
                        <p class="subtitle is-6 is-bold" style="text-align:left;">Seleção de Quantidade</p>
                        <div class="navbar-menu" style="display: flex !important;">
                            <div class="navbar-item ">
                            <input type="number" class="form-control" name="qtd" id="qtd" placeholder="Digite a quantidade">
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <p class="control">
                        <a class="button is-success" style="height: 56px;width: 384px;border-radius:0px">COMPRAR</a>
                    </p>
                </div>
            </div>
        </div>
</section>

<!--------------------------------------QUALIDADE--------------->

<section class="section" style="padding-bottom: 180px;">
    <div class="container has-text-left">
        <p class="subtitle is-bold" style="width:447px;font-size:24px">Também pode interessar</p>
    </div>
    <br>
    <div class="container has-text-left">
        <div class="columns has-text-left" id="listAnuncios">
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#inputLance').mask('#.##0,00', {
            reverse: true
        });
        recuperarDetalheAnuncio();
        moment.defineLocale('pt-br', {
            months: 'janeiro_fevereiro_março_abril_maio_junho_julho_agosto_setembro_outubro_novembro_dezembro'.split('_'),
            monthsShort: 'jan_fev_mar_abr_mai_jun_jul_ago_set_out_nov_dez'.split('_'),
            weekdays: 'domingo_segunda-feira_terça-feira_quarta-feira_quinta-feira_sexta-feira_sábado'.split('_'),
            weekdaysShort: 'dom_seg_ter_qua_qui_sex_sáb'.split('_'),
            weekdaysMin: 'dom_2ª_3ª_4ª_5ª_6ª_sáb'.split('_'),
            longDateFormat: {
                LT: 'HH:mm',
                L: 'DD/MM/YYYY',
                LL: 'D [de] MMMM [de] YYYY',
                LLL: 'D [de] MMMM [de] YYYY [às] LT',
                LLLL: 'dddd, D [de] MMMM [de] YYYY [às] LT'
            },
            calendar: {
                sameDay: '[Hoje às] LT',
                nextDay: '[Amanhã às] LT',
                nextWeek: 'dddd [às] LT',
                lastDay: '[Ontem às] LT',
                lastWeek: function() {
                    return (this.day() === 0 || this.day() === 6) ?
                        '[Último] dddd [às] LT' : // Saturday + Sunday
                        '[Última] dddd [às] LT'; // Monday - Friday
                },
                sameElse: 'L'
            },
            relativeTime: {
                future: 'em %s',
                past: '%s atrás',
                s: 'segundos',
                m: 'um minuto',
                mm: '%d minutos',
                h: 'uma hora',
                hh: '%d horas',
                d: 'um dia',
                dd: '%d dias',
                M: 'um mês',
                MM: '%d meses',
                y: 'um ano',
                yy: '%d anos'
            },
            ordinal: '%dº'
        });
    });

    function showpassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            $("#eyeslashlogin").css('display', 'none');
            $("#eyelogin").css('display', 'block');
            x.type = "text";
        } else {
            $("#eyeslashlogin").css('display', 'block');
            $("#eyelogin").css('display', 'none');
            x.type = "password";
        }
    }
</script>
<script>
    var statusCode = JSON.parse("{{ json_encode(isset($statusCode)) }}");
    if (statusCode == 201) {
        alert('Usuário atualizado com sucesso!');
        //trocar por success
    }
</script>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection