@extends('layouts.site')
@include('layouts\_includes\topoLeilao')

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


        <p class="title is-bold" style="width:447px;font-size:24px">Informação geral</p><br>
        <p class="subtitle" style="width:447px;font-size:16x"><b>Loja: </b>
          <font id="loja"></font>
        </p>
        <p class="subtitle" style="width:447px;font-size:16x"><b>Vendedor: </b>
          <font id="vendedor"></font>
        </p>

        <br>
        <div class="row">
          <div class="col-md-12">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-descricao-tab" data-toggle="tab" href="#nav-descricao" role="tab" aria-controls="nav-descricao" aria-selected="true">Descrição</a>
                <a class="nav-item nav-link" id="nav-identificacao-tab" data-toggle="tab" href="#nav-identificacao" role="tab" aria-controls="nav-identificacao" aria-selected="false">Identificação</a>
                <a class="nav-item nav-link" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="false">Informações</a>
                <a class="nav-item nav-link" id="nav-condicoesGerais-tab" data-toggle="tab" href="#nav-condicoesGerais" role="tab" aria-controls="nav-condicoesGerais" aria-selected="false">Condições Gerais</a>
                <a class="nav-item nav-link" id="nav-acessorios-tab" data-toggle="tab" href="#nav-acessorios" role="tab" aria-controls="nav-acessorios" aria-selected="false">Acessórios</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-descricao" role="tabpanel" aria-labelledby="nav-descricao-tab">
                <p id="descricao" class="subtitle is-7">
                </p>
              </div>
              <div class="tab-pane fade" id="nav-identificacao" role="tabpanel" aria-labelledby="nav-identificacao-tab">
                <p id="identificacao" class="subtitle is-7">
                </p>
              </div>
              <div class="tab-pane fade" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                <p id="info" class="subtitle is-7">
                </p>
              </div>
              <div class="tab-pane fade" id="nav-condicoesGerais" role="tabpanel" aria-labelledby="nav-condicoesGerais-tab">
                <p id="condicoesGerais" class="subtitle is-7">
                </p>
              </div>
              <div class="tab-pane fade" id="nav-acessorios" role="tabpanel" aria-labelledby="nav-acessorios-tab">
                <p id="acessorios" class="subtitle is-7">
                </p>
              </div>
            </div>
          </div>
        </div>



      </div>

      <!--------------------------------------INFORMAÇÕES DO PRODUTO--------------->
      <div class="column is-5" style="padding-left: 31px">


        <div class="media-content">

          <p class="title is-bold" style="font-size:28px;" id="tituloLeilao"></p>
          <div class="card-content">
            <p class="subtitle is-6" style="text-align:left;" id="descLeilao"></p>
            <div class="media">
              <div class="media-content">
                <b><span class="subtitle is-6" id="dt_fim_leilao" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffe000;color:#000000;padding:5px"></span></b><br>
                <br>
                <br>
                <p id="expira" class="subtitle is-5">Expira em: </p>
                <span class="timer-leilao"><span id="days"></span> : <span id="hours"></span> : <span id="minutes"></span> : <span id="seconds"></span></span><br>
                <span class="Dias">Dias</span><span class="Horas">Horas</span><span class="Minutos">Minutos</span><span class="Segundos">Segundos</span>
              </div>
            </div>
            <br>
            <p class="subtitle is-5">Maior lance atualmente</p>
            <p class="subtitle is-danger" style="font-size:32px; font-weight:bold" id="maiorValorLance"></p>


          </div>
          <br><br>

          <p class="control">
            <button class="button is-success" style="height: 48px;width: 350px;border-radius:4px">COMPRAR AGORA</button>
          </p>
          <br>
          <p class="control">
            <button id="myBtn" class="button gradiente is-outline" style="display:none;border:1px solid #17B330;height: 48px;width: 350px;border-radius:4px">FAÇA SEU LANCE</button>
            <div id="myModal" class="modal">
              <!-- Modal content -->
              <div class="modal-content" style="width: 50%;">
                <span id="close" class="close">&times;</span>
                <p style="margin-left: 260px;">Digite o valor:</p>
                <input id="inputLance" class="button gradiente is-outline" style="border:1px solid #17B330;height: 48px;width: 350px;border-radius:4px;margin-left: 260px;"/>
                <button onclick="enviarLanceLeilao()" id="myBtn" class="button gradiente is-success" style="border:1px solid #17B330;height: 48px;width: 350px;border-radius:4px;margin-left: 260px;margin-top: 30px;">Enviar Lance</button>
              </div>
            </div>            
          </p>
        </div>
        <br>
        <p id="lances" class="subtitle is-6 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffe000;color:#000000;padding:5px"></p>
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
    <div class="columns has-text-left" id="listLeiloes">
    </div>

  </div>

</section>

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#inputLance').mask('#.##0,00', {reverse: true});
    recuperarDetalheLeilao();
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