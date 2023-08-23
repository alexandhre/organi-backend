<!--------------------------------------barra de logo--------------->

<!-- @if (session('id'))
  <div class="Rectangle mb-3">
    <div class="navbar-start" style="min-height:40px;background-color:#17b33000;">
      <div class="navbar-item col-md-10 mx-auto">

        <div class="navbar-item">
          <span>
            Oportunidades em Disputa:<b>&nbsp 000</b>
          </span>
        </div>

        <div class="navbar-item">
          <span>
            Oportunidades Vencidas:<b>&nbsp 000</b>
          </span>
        </div>

        <div class="navbar-item">
          <span>
            Atas de Registro de Preço Ativas:<b>&nbsp 000</b>
          </span>
        </div>

      </div>
    </div>

  </div>
  @endif -->

@if(Route::currentRouteName() == 'perfil')
<div class="container has-text-left">
  <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
    <div class="col-md-6 float-left">
      <a class="navbar-brand" href="/home">
        <img src="{{ asset('css\img\Tendering.png') }}" alt="Tendering">
      </a>
    </div>
    <div class="col-md-6 float-right has-text-right">
      <a href="/anuncio" class="button gradiente is-success"> SUBIR PRODUTO</a>
    </div>
  </div>
  @else
  <div class="col-md-12  mt-4" style="background-color: #ffffff;min-height: 45px;">
    <div class="col-md-2 col-lg-2 float-left">
      <a href="/home" class="float-right">
        <img src="{{ asset('css\img\Tendering.png') }}" alt="Tendering: Logomarca" style="max-height: 40px;">
      </a>

    </div>

    <div id="navbarExampleTransparentExample" class="col-md-6 float-left" style="top: -25px;">
      <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
          <div class="control has-icon" style="top:25px;margin-left:99px">
            <span class="icon" style="font-size:16px; color:black;top:3px;left:10px">
              <img src="css\img\magnifier-simple-line-icons.png">
            </span>
            <input id="inputPesquisa" class="input" style="left:10px;font-size:16px;width:480px;height:40px;border-radius:20px;" type="text" placeholder="Encontrar em Tendering">
          </div>
          <div class="control has-icon" style="top:25px;margin-left:30px">
            <button onclick="pesquisarIndex()" class="button gradiente is-success px-4">Pesquisar</button>
          </div>

        </div>
      </div>
    </div>
    <div class="navbar-end" style="margin:0 0 0 0">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" style="color:#17B330; padding:0 0 0 0">
          <img src="css\img\icons8-thunder-32.png" style="height:15px;width:15px;" />&nbsp Acesso Rápido
        </a>
        <div class="navbar-dropdown" style="margin-left:-120px;">
          <a href="/fornecedor" class="navbar-item">
            Cadastramento de Fornecedores
          </a>
          <a class="navbar-item">
            Credenciamento na Plataforma

          </a>
          <a class="navbar-item">
            Requisitos para utilização
          </a>
          <a onclick="redirecionarPesquisa('produto')" class="navbar-item">
            Banco de Preços de Produtos
          </a>
          <a class="navbar-item">
            Suporte Técnico
          </a>
        </div>
      </div>
      <div class="navbar-item">
        <a class="navbar-link" style="padding: 0 0px 0 0px">
          <img src="css\img\ic_box-delivery--empty.svg">
        </a>
        <a class="navbar-link" href="loginA.html">
          <img src="css\img\ic_cart.svg">
        </a>
      </div>
    </div>
  </div>

</div>
<!--------------------------------------Filtros de Pesquisa--------------->
<section class="section" style="padding: 0px;">
  <div class="container has-text-left">
    <div class="navbar">
      <div class="navbar-menu" style="justify-content: center !important;display: flex !important;">

        <div>
          <p class="navbar-item">
            <a onclick="redirecionarPesquisa('produto')" class="navbar-item" style=" color:#1a1a1a;border-radius:17px;height: 32px;">
              Pesquisas avançadas
            </a>
          </p>
        </div>
        <div>
          <p class="navbar-item">
            <a href="/leilao" class="navbar-item" style="color:#1a1a1a;border-radius:17px;height: 32px;">
              Ambiente de disputa
            </a>
          </p>
        </div>

        <div>
          <p class="navbar-item">
            <a class="navbar-item" style="color:#1a1a1a;border-radius:17px;height: 32px;">
              Banco de preços
            </a>
          </p>
        </div>
        <div>
          <p class="navbar-item">
            <a class="navbar-item" style="color:#1a1a1a;border-radius:17px;height: 32px;">
              Suporte Técnico
            </a>
          </p>
        </div>
        <!-- <div>
            <p class="textos-1">
              Assessoria Financeira
            <p>
              <i class="fas fa-angle-down"></i>
            </p>
            </p>
          </div> -->
      </div>
    </div>
  </div>
</section>

@endif
</div>