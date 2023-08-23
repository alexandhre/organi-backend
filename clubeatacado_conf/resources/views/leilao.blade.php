@extends('layouts.site')
@include('layouts\_includes\topoLeilao')
@include('layouts\_includes\topoIndex')

@section('content')
    <!--------------------------------------CADASTRAMENTO--------------->
    <div class="container has-text-left">
      <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#" aria-current="page">Leilão</a></li>
        </ul>
      </nav>
      <p class="subtitle is-bold" style="width:447px;font-size:32px;color:#1a1a1a">Leilão</p>
      <p class="subtitle" style="width:620px;font-size:18px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo.</p><br>
    </div>
    <div class="container has-text-left" style="padding-bottom: 100px;">
      <div class="columns has-text-left">
        @foreach($leiloes as $key => $leilao)        
        <div class="column">
          <div class="card">
          <a onclick="abrirDetalheLeilao('{{$leilao->ID_LEILAO}}')" href="#">
            <div class="card-image" style="height: 288px; width: 350px;">
              <figure class="image">
                <img src="css\img\fitness.png" style="height: 288px; width: 350px;" alt="Placeholder image">
              </figure>
            </div>
            </a>
            <div class="card-content">
              <div class="content">
                <article class="media">
                  <div class="media-content">
                    <div class="field">
                      <p class="control has-icon-right">
                        @if ($leilao->IN_LEILAO == 1)
                        <p class="subtitle is-8 is-bold"
                          style="width: max-content;height: 24px;border-radius:12px;background-color:#ffc1077a;color:#000000;padding:5px">
                          Encerra em {{$leilao->VL_DIAS_FALTANTES}} 🔥 </p>
                        </p>
                        @elseif ($leilao->IN_LEILAO == 0)
                          <p class="subtitle is-8 is-bold"
                            style="width: max-content;height: 24px;border-radius:12px;background-color:#ffcccc;color:#000000;padding:5px">
                            Leilão Encerrado 🔥 </p>
                          </p>
                        @else
                          <p class="subtitle is-8 is-bold"
                            style="width: max-content;height: 24px;border-radius:12px;background-color:#ccffdc;color:#000000;padding:5px">
                            Leilão começa em {{$leilao->VL_DIAS_FALTANTES}} 🔥 </p>
                          </p>
                        @endif              
                      <p class="control">
                      <p class="subtitle is-5 is-left">{{$leilao->DS_ANUNCIO_PRODUTO}}</p>
                      </p>
                      <p class="control">
                      <p class="subtitle is-7 is-left" style="color: #808080;">Preço atual</p>
                      </p>
                      <p class="control">
                      <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;">R$ {{$leilao->VL_PRECO_INICIAL}}</p>
                      </p>
                    </div>
                  </div>
                  <div class="media-right" style="margin-left:0px;margin-top:16px;">
                    <nav class="level is-mobile">
                      <div class="level-left">
                        <div class="level-item">
                            @if ($leilao->FLAG_FAVORITO == 1)
                            <a onclick="favoritarAnuncio('{{$leilao->ID_ANUNCIO_PRODUTO}}')" class="button gradiente"><img id="imgFavorito{{$leilao->ID_ANUNCIO_PRODUTO}}" style="height:27x; width:30px"
                              src="css\img\16.png">
                            </a>
                            @else
                            <a onclick="favoritarAnuncio('{{$leilao->ID_ANUNCIO_PRODUTO}}')" class="button gradiente"><img id="imgFavorito{{$leilao->ID_ANUNCIO_PRODUTO}}" style="height:27x; width:30px"
                              src="css\img\icons8-favorite-60.png">
                            </a>
                            @endif                            
                        </div>
                        <a class="level-item">
                          <span class="icon"><img src="css\img\icons-general-share-32.png"></span>
                        </a>
                      </div>
                    </nav>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>               
        @endforeach
      </div>
    </div>
  </section>
  <br>
  <br>
  <br>
@endsection

@section('scripts')
<script type="text/javascript">   
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
@endsection