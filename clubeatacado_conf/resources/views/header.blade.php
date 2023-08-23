<!--------------------------------------barra de logo--------------->
<div class="container has-text-left">
  <nav class="navbar" style="background-color: #ffffff;min-height: 80px;">
    <div class="navbar-brand">
      <a href="/clubeatacado/home" class="navbar-item">
        <img src="css\img\Tendering.png" alt="Tendering: Logomarca" style="max-height: 40px;">
      </a>

    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">
      <div class="navbar-start">

        <form class="control has-icon" style="top:25px;margin-left:99px">
          <span class="icon" style="font-size:16px; color:black;top:3px;left:10px">
            <img src="css\img\magnifier-simple-line-icons.png">
          </span>
          <input class="input" style="left:10px;font-size:16px;width:581px;height:40px;border-radius:20px;" type="text" placeholder="Encontrar em Tendering">
        </form>

      </div>
    </div>

    <div class="navbar-end" style="margin:0 -90px 0 0">

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" style="color:#17B330; padding:0 0 0 0">
          <img src="css\img\icons8-thunder-32.png" style="height:15px;width:15px;" />&nbsp Acesso Rápido
        </a>
        <div class="navbar-dropdown" style="margin-left:-120px;">
          <a class="navbar-item">
            Cadastramento de Fornecedores
          </a>
          <a class="navbar-item">
            Credenciamento na Plataforma

          </a>
          <a class="navbar-item">
            Requisitos para utilização
          </a>
          <a class="navbar-item">
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
  </nav>
</div>
@if (session('id'))
<div class="Rectangle">
    <div class="navbar-start" style="min-height:40px;background-color:#17b33000;">
      <div class="navbar-item" style="justify-content: center !important;display: flex !important;">

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
@endif
<!--------------------------------------Filtros de Pesquisa--------------->
<section class="section">
  <div class="container has-text-left">
    <div class="navbar">
      <div class="navbar-menu" style="justify-content: center !important;display: flex !important;">

        <div class="navbar-item ">
          <a class="navbar-item" style=" color:#1a1a1a;background-color:#E8FCEC;border-radius:17px;height: 32px; width: 185px;">
            Pesquisas avançadas
          </a>
        </div>
        <div class="navbar-item ">
          <a class="navbar-item" style="color:#1a1a1a;background-color:#E8FCEC;border-radius:17px;height: 32px; width: 185px;">
            Ambiente de disputa
          </a>
        </div>

        <div class="navbar-item ">
          <a class="navbar-item" style="color:#1a1a1a;background-color:#E8FCEC;border-radius:17px;height: 32px; width: 185px;">
            Banco de preços
          </a>
        </div>
        <div class="navbar-item ">
          <a class="navbar-item" style="color:#1a1a1a;background-color:#E8FCEC;border-radius:17px;height: 32px; width: 185px;">
            Suporte técnico
          </a>
        </div>
        <div class="navbar-item ">
          <a class="navbar-item" style="color:#1a1a1a;background-color:#E8FCEC;border-radius:17px;height: 32px; width: 185px;">
            Assessoria financeira
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

