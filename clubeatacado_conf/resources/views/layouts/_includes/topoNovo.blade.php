<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tendering</title>
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
  <!-- Bulma Version 0.7.1-->
  <link rel="stylesheet" href="{{ asset('css/tenderingNovo.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/sliderNovo.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/modalNovo.css') }}" />
  <!-- <link rel="stylesheet" href="{{ asset('css/om-javascript-range-slider.css') }}" /> -->
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/iziToast.min.css') }}">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
  <script src="{{ asset('js/iziToast.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/controler.js') }}"></script>
  <script src="{{ asset('js/index.js') }}"></script>
  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/om-javascript-range-slider.js') }}"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment-with-locales.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

  @include('layouts\_includes\validateMask')
  <script>
    function redirecionamento(rota) {
      window.location = rota
    }

    function showpassword(fieldId, fieldEyeLashId, fieldEyeId) {
      var x = document.getElementById(fieldId);
      if (x.type === "password") {
        $("#" + fieldEyeLashId).css('display', 'none');
        $("#" + fieldEyeId).css('display', 'block');
        x.type = "text";
      } else {
        $("#" + fieldEyeLashId).css('display', 'block');
        $("#" + fieldEyeId).css('display', 'none');
        x.type = "password";
      }
    }
  </script>
</head>

<body>
  <!--------------------------------------BARRA VERDE--------------->
  <div class="barra-verde">
    <nav class="navbar" style="background-color:#17B330;min-height: 40px;">
      <div class="navbar-start" style="margin:0 0px 0px 30px">
        <p class="navbar-item">
          <img src="{{ asset('css\img\FLA003 _ brazil.png') }}" style="max-height: 40px;">
        <p class="portugues">Portugues</p>
        <p class="atoms-icons-06-system-sys-018-">
          <i class="fas fa-angle-down"></i>
        </p>
        </p>
      </div>

      @if (session('id'))
      <div class="navbar-end">
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link text-white" style="padding:0 0 0 0">
            <img src="{{ asset('css\img\icons8-thunder-32.png') }}" style="height:15px;width:15px;" />&nbsp Seja bem vindo, {{ session('nome') }}
          </a>
          <div class="navbar-dropdown" style="margin-left:-120px;">
            <a href="/perfil" class="navbar-item">
              Meu Perfil
            </a>
            <a class="navbar-item" href="/logout">
              Sair
            </a>
          </div>
        </div>
      </div>
  </div>
  @else
  <div class="navbar-end">
    <div class="navbar-item">
      <div class="field">
        <div class="control">
          <a class="label-2 text-white" href="/login">Login</a>
          <span class="label-2 text-white">/</span>
          <a class="label-2 text-white" href="/registro"> Registro
          </a>
        </div>
      </div>
    </div>
  </div>
  @endif
  </nav>
  </div>