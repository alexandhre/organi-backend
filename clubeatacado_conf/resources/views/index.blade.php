@extends('layouts.siteNovo')
@include('layouts\_includes\topoIndex')

@section('content')

<!--------------------------------------MODAL-------------->

<div id="modalRegistro" class="modal">
    <div class="modal-card" style="height: 691px; width: 406px;background-color: #FFFFFF;border-radius:8px;">
        <section class="modal-card-body">
            <div class="field">
                <div class="control has-icons-right" style="height:24px;padding: 12px 0 0 12px;">
                    <span onclick="fecharModal('Registro')" style="height: 24px; width: 24px;position:absolute;right:12px;cursor: pointer;">
                        <img src="css/img/atoms-icons-07-cross-close.png">
                    </span>
                </div>
            </div>
            <div class="container has-content-centered">
                <div class="content">
                    <div class="card-image">
                        <figure class="image">
                            <img src="css/img/Tendering.png" style="height: 24px; width: 94px;" alt="Placeholder logo">
                        </figure>
                    </div>
                    <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                        <div class="field">
                            <label>Nome</label>
                            <div class="control has-icons-right" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;">
                                Escreva seu nome
                                <span style="height: 24px; width: 24px;position:absolute;right:12px">
                                    <img src="css/img/ca-010-circle-account-user.png">
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <label>E-mail</label>
                            <div class="control has-icons-right" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;">
                                Escreva seu e-mail
                                <span style="height: 24px; width: 24px;position:absolute;right:12px">
                                    <img src="css/img/atoms-icons-03-documents-email.png">
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <label>Senha</label>
                            <div class="control has-icons-right" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;">
                                Escreva sua senha
                                <span style="height: 24px; width: 24px;position:absolute;right:12px">
                                    <img src="css/img/atoms-icons-04-functional-eye-see.png">
                                </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input type="checkbox" id="registroOK" name="scales"> &nbsp Registrando, aceito as <a style="color: #17B330;" href="#">Termos
                                    de uso</a>.</span>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input type="checkbox" id="comprador" name="scales"> &nbsp Sou comprador.</span>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input type="checkbox" id="forncedor" name="scales"> &nbsp Sou fornecedor.</span>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="buttons has-addons is-centered">
                        <div class="control">
                            <button class="button is-success" style="font-weight: bold;width:232px; height: 40px;">Registrar</button>
                        </div>
                    </div>
                    <div class="buttons has-addons is-centered">
                        <div class="control">
                            <button onclick="fecharModal('Registro');abrirModal('Login')" class="button gradiente" style="font-weight: bold;width:232px; height: 40px;">Já estou
                                registrado</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </section>
    </div>
</div>

<div id="modalLogin" class="modal">
    <div class="modal-card" style="height: 444px; width: 406px;background-color: #FFFFFF;border-radius:8px;">
        <section class="modal-card-body">
            <div class="field">
                <div class="control has-icons-right" style="height:24px;padding: 12px 0 0 12px;">
                    <span onclick="fecharModal('Login')" style="height: 24px; width: 24px;position:absolute;right:12px;cursor: pointer;">
                        <img src="css/img/atoms-icons-07-cross-close.png">
                    </span>
                </div>
            </div>
            <div class="container has-content-centered">
                <div class="content">
                    <div class="card-image">
                        <figure class="image">
                            <img src="css/img/Tendering.png" style="height: 24px; width: 94px;" alt="Placeholder logo">
                        </figure>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">

                            <div class="field" style="padding: 25px 0 0;width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <div class="control has-icons-left">
                                    <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px;" value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email" type="email" name="email">
                                    <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color:#313030">{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group row" style="margin: 5% 0%;">
                                <div class="col-md-6">
                                    <div class="field" style="width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="width: 95%; display: inline-flex">
                                            <div class="control has-icons-left has-icons-right">
                                                <input id="password" type="password" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px; width: 100%;" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                <span class="icon is-small is-left" style="height: 27px; width: 20px; ">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color:black">{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="icon is-small" style="position: absolute; margin-left: -5%">
                                            <a onclick="showpassword()"><i class="fa fa-eye-slash" id="eyeslashlogin"></i></a>
                                            <a onclick="showpassword()"><i class="fa fa-eye" id="eyelogin" style="display: none"></i></a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="field">
                                @if (session('alert'))
                                <div class="message is-warning" id="alerta">
                                    <div class="message-header">
                                        {{ session('alert') }}
                                    </div>

                                </div>
                                @endif
                                <div class="control" style="font-size:12px;color:#868C99">
                                    <label class="checkbox">
                                        <a style="color: #23A7FB" href="/usuario/esquecisenha">Esqueci a minha senha</a>.
                                    </label>
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                        <div class="buttons has-addons is-centered">
                            <div class="control">
                                <button class="button is-success" style="font-weight: bold;width:232px; height: 40px;">Entrar</button>
                            </div>
                        </div>
                    </form>
                    <div class="buttons has-addons is-centered">
                        <div class="control">
                            <button onclick="fecharModal('Login');abrirModal('Registro')" class="button gradiente" style="font-weight: bold;width:232px; height: 40px;">Registrar</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </section>
    </div>
</div>

<!--------------------------------------CATEGORIAS--------------->
<section class="section">
    <div class="container has-text-left">
        <p class="titulos-1">Categorias</p>
        <p class="textos-1" style="width:620px">Aqui você encontrará as categorias que te ajudarão a encontrar os produtos
            ideais para o seu comercio com as últimas novidades!</p>
    </div>
    <br>
    <div class="container has-text-left">
        <div class="columns">
            @foreach($categorias as $key => $categoria)
            @if ($key <= 2) <div class="column">
                <div class="card" style="box-shadow: 0 0px 0px #ffffff00">
                    <div class="card-image">
                        <figure class="card-home-medium">
                            <img src="css\img\{{$categoria->DS_FOTO_CATEGORIA_PRODUTO}}" style="border-radius: 8px;" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="card-content" style="position:absolute;top:100px;left:14px">
                        <p style="font-weight: 100;" class="imagem-titulo">{{$categoria->DS_CATEGORIA_PRODUTO}}</p>
                    </div>
                </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    <br>
    <section class="section has-text-centered">
        <button onclick="redirecionarPesquisa('categoria')" class="button is-outlined is-success" style="width: 232px;margin-left: 20px"> Ver
            Mais Categorias</button>
    </section>
    <br>
    <hr class="hr5">
</section>
<!--------------------------------------CATEGORIAS--------------->

<!--------------------------------------PROMOÇÕES--------------->
<section class="section">
    <div class="container has-text-left">
        <p class="titulos-1">Promoções da Semana</p>
        <p class="textos-1" style="width:620px">Não perca mais tempo, aqui estão as últimas ofertas em promoção. Uma
            excelente oportunidade de economizar!</p>
    </div>
    <br>
    <div class="container has-text-left">
        <div class="columns">
            @foreach($listaAnuncioProduto as $key => $produto)
            <a href="/recuperarAnuncio/{{$produto->ID_ANUNCIO_PRODUTO}}">
                @if ($produto->IN_PROMOCAO == 1)
                @if ($key <= 2) <div class="column">
                    <div class="card" style="box-shadow: 0 0px 0px #ffffff00">
                        <div class="card-image">
                            <figure class="card-home-medium">
                                <img src="css\img\rectangle-2.png" style="border-radius: 8px;" alt="Placeholder image">
                            </figure>
                        </div>

                        <div class="card-content" style="position:absolute;top:100px;left:14px">
                            <p class="imagem-titulo">{{$produto->DS_PRODUTO}}</p>
                            <p style="color: red;" class="imagem-sub-titulo">De <strike>R$ {{$produto->VL_PRODUTO_ANTIGO}}</strike> Por <span style="font-size: 20px;">R$ {{$produto->VL_PRODUTO_UNITARIO}}</span></p>
                            <!-- <p class="subtitle is-8" style="text-align:center;font-size:12px;">{{$produto->VL_PESO_PACOTE_KG}}{{$produto->DS_UNIDADE_MEDIDA}}</p> -->
                        </div>
                    </div>
        </div>
        @endif
        @endif
        </a>
        @endforeach
    </div>
    </div>
    <br>
    <section class="section has-text-centered">
        <button onclick="redirecionarPesquisa('promocao')" class="button is-outlined is-success" style="width: 232px;margin-left: 20px"> Ver
            Mais Promoções</button>
    </section>
    <br>
    <hr class="hr5">
</section>
<!--------------------------------------PROMOÇÕES--------------->

<!--------------------------------------QUALIDADE--------------->
<section class="section">
    <div class="container has-text-left">
        <p class="titulos-1">Qualidade ao melhor preço</p>
        <p class="textos-1" style="width:620px">Nós separamos os produtos que são tendência no mercado, exclusivamente
            para você</p>
    </div>
    <br>
    <div class="container has-text-left">
        <div class="columns">
            @foreach($listaAnuncioProduto as $key => $produto)
            <a href="/recuperarAnuncio/{{$produto->ID_ANUNCIO_PRODUTO}}">
                @if ($key <= 2) 
                <div class="column">
                    <div class="card" style="box-shadow: 0 0px 0px #ffffff00">
                        <div class="card-image">
                            <figure class="card-home-medium">
                                @if ($produto->IN_PROMOCAO == 1)
                                <div class="container" style="position:absolute; border-radius: 10px; width:106px;height:32px;background-color:#FFE500;z-index: 1;">
                                    <p class="subtitle is-danger is-6" style="position:absolute; top:8px;right:15px;width:75px;font-weight:bold;">OFERTAS</p>
                                </div>
                                @endif
                                <img src="css\img\rectangle-2.png" style="border-radius: 8px;" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content" style="position:absolute;top:100px;left:14px">
                            <p class="imagem-titulo">{{$produto->DS_PRODUTO}}</p>
                            <p style="color: red;" class="imagem-sub-titulo">De <strike>R$ {{$produto->VL_PRODUTO_ANTIGO}}</strike> Por <span style="font-size: 20px;">R$ {{$produto->VL_PRODUTO_UNITARIO}}</span></p>
                            <div class="container" style="position:absolute;border-radius: 24px;z-index: 1;left: 240px;bottom: 10px;">
                                <div class="level-left">
                                    <div class="level-item">
                                        @if ($produto->FLAG_FAVORITO == 1)
                                        <a onclick="favoritarAnuncio('{{$produto->ID_ANUNCIO_PRODUTO}}')" class="button gradiente"><img id="imgFavorito{{$produto->ID_ANUNCIO_PRODUTO}}" style="height:27x; width:30px" src="css\img\16.png">
                                        </a>
                                        @else
                                        <a onclick="favoritarAnuncio('{{$produto->ID_ANUNCIO_PRODUTO}}')" class="button gradiente"><img id="imgFavorito{{$produto->ID_ANUNCIO_PRODUTO}}" style="height:27x; width:30px" src="css\img\icons8-favorite-60.png">
                                        </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endif
        </a>
        @endforeach
    </div>
    </div>
    <br>
    <section class="section has-text-centered">
        <button onclick="redirecionarPesquisa('produto')" class="button is-outlined is-success" style="width: 232px;margin-left: 20px"> Ver
            Mais Produtos</button>
    </section>
    <br>
    <hr class="hr5">
</section>
<!--------------------------------------QUALIDADE--------------->

<!--------------------------------------PROMOÇÃO--------------->
<section class="section" >
    <div class="container has-text-left">
        <div class="columns has-text-left">
            <div class="column is-4" style="margin-top: 200px;">
                <p class="titulos-1" style="line-height: 30px;">Promoção em destaque</p><br>
                <p class="textos-1">Não perca mais tempo, aqui estão as últimas ofertas em promoção. Uma
                    excelente oportunidade de economizar!
                </p>
            </div>
            <div class="column destaque">
                <a href="/recuperarAnuncio/{{$listaAnuncioProduto[0]->ID_ANUNCIO_PRODUTO}}">
                    <div class="card" style="box-shadow: 0 0px 0px #ffffff00">
                        <div class="card-image">
                            <figure class="image" style="width:730px;height:688px;border-radius:4px">
                                <img style="filter: brightness(60%);width:730px;height:688px;border-radius:4px" src="css\img\cesta.jpg" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content" style="position:absolute;bottom:40px;left:40px">
                            <p class="imagem-titulo" style="font-family:'Roboto';">{{$listaAnuncioProduto[0]->DS_PRODUTO}}</p>
                            <p class="imagem-sub-titulo" style="font-family:'Roboto';">{{$listaAnuncioProduto[0]->DS_DETALHE_PRODUTO}}</p> <BR>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <hr class="hr5">
</section>
<br>
<br>
<br>
<!--------------------------------------PORTAL--------------->

<section class="section">
    <div class="container has-text-left">
        <p class="titulos-1">Tendering, um portal de compras da agricultura familiar</p>
        <p class="textos-1" style="width: 825px;">Um serviço digital de leilão reverso que opere na forma de market place
            dedicado a produtos provenientes da agricultura familiar, onde processos licitatórios (de órgãos públicos e de
            empresas privadas) serão cadastrados e amplamente publicados com a posterior coleta de propostas de fornecedores
            também cadastrados e com documentações validadas na plataforma.
        </p>
    </div>


    <div class="container has-text-left" style="margin-top:74px;">

        <div class="card" style="box-shadow: 0 0px 0px #ffffff00">
            <div class="card-image">
                <figure class="IMAGE">
                    <img src="css\img\rectangle-3.png" style="height:360px; width:1110px;border-radius: 16px;" alt="Placeholder image">
                </figure>
            </div>
        </div>
    </div>
</section>
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
@endsection