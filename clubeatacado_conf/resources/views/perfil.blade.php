@extends('layouts.site')
@include('layouts\_includes\topoLeilao')
@include('layouts\_includes\topoIndex')

@section('content')

<section id="tabs" class="project-tab">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-cadastro-tab" data-toggle="tab" href="#nav-cadastro" role="tab" aria-controls="nav-cadastro" aria-selected="true">Meu Cadastro</a>
                        <a class="nav-item nav-link" id="nav-compras-tab" data-toggle="tab" href="#nav-compras" role="tab" aria-controls="nav-compras" aria-selected="false">Minhas compras</a>
                        <a class="nav-item nav-link" id="nav-lances-tab" data-toggle="tab" href="#nav-lances" role="tab" aria-controls="nav-lances" aria-selected="false">Meus Lances</a>
                        <a class="nav-item nav-link" id="nav-favoritos-tab" data-toggle="tab" href="#nav-favoritos" role="tab" aria-controls="nav-favoritos" aria-selected="false">Meus Favoritos</a>
                        <a class="nav-item nav-link" id="nav-produtos-tab" data-toggle="tab" href="#nav-produtos" role="tab" aria-controls="nav-produtos" aria-selected="false">Meus Produtos</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-cadastro" role="tabpanel" aria-labelledby="nav-cadastro-tab">
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Dados Cadastrais</h1><br>
                            </div>
                            <br>
                            <div class="container">
                                <div class="columns">
                                    <form class="row col-md-12" method="post" action="{{ route('atualizarComprador') }}">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="col-md-12 p-3" style="z-index: 1;">
                                                <div class="card-content">
                                                    <div class="form-group">
                                                        <label for="nome">Nome</label>
                                                        <input type="text" class="form-control" name="nome" id="nome" value="{{$dadosUsuario[0]->DS_NOME}}" placeholder="Digite o nome">
                                                        @if($errors->has('nome'))
                                                        <div class="error">{{ $errors->first('nome') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="sobrenome">Sobrenome</label>
                                                        <input type="text" class="form-control" name="sobrenome" id="sobrenome" value="{{$dadosUsuario[0]->DS_SOBRENOME}}" placeholder="Digite o sobrenome">
                                                        @if($errors->has('sobrenome'))
                                                        <div class="error">{{ $errors->first('sobrenome') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cpf">CPF</label>
                                                        <input type="text" class="form-control" name="cpf" id="cpf" value="{{$dadosUsuario[0]->NR_CPF}}" placeholder="Digite o CPF">
                                                        @if($errors->has('cpf'))
                                                        <div class="error">{{ $errors->first('cpf') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" value="{{$dadosUsuario[0]->DS_EMAIL}}" placeholder="Digite o Email">
                                                        @if($errors->has('email'))
                                                        <div class="error">{{ $errors->first('email') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gmail">GMAIL</label>
                                                        <input type="text" class="form-control" name="gmail" id="gmail" value="{{$dadosUsuario[0]->DS_GMAIL}}" placeholder="Digite o email GMAIL">
                                                        @if($errors->has('gmail'))
                                                        <div class="error">{{ $errors->first('gmail') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="ddd">DDD</label>
                                                        <input maxlength="3" type="text" class="form-control" name="ddd" id="ddd" value="{{$dadosUsuario[0]->NR_DDD_TELEFONE}}" placeholder="Digite o DDD">
                                                        @if($errors->has('ddd'))
                                                        <div class="error">{{ $errors->first('ddd') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="telefone">Telefone</label>
                                                        <input type="text" class="form-control" name="telefone" id="telefone" value="{{$dadosUsuario[0]->NR_TELEFONE}}" placeholder="Digite o telefone">
                                                        @if($errors->has('telefone'))
                                                        <div class="error">{{ $errors->first('telefone') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12 p-3" style="z-index: 1;">
                                                <div class="card-content">
                                                    <div class="form-group">
                                                        <label for="endereco">Endereço</label>
                                                        <input type="text" class="form-control" name="endereco" id="endereco" value="{{$dadosUsuario[0]->DS_ENDERECO_COMPRADOR}}" placeholder="Digite o Endereço">
                                                        @if($errors->has('endereco'))
                                                        <div class="error">{{ $errors->first('endereco') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="nr_endereco">Numero Endereço</label>
                                                        <input type="text" class="form-control" name="nr_endereco" id="nr_endereco" value="{{$dadosUsuario[0]->NR_ENDERECO_COMPRADOR}}" placeholder="Digite o Número do Endereço">
                                                        @if($errors->has('nr_endereco'))
                                                        <div class="error">{{ $errors->first('nr_endereco') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="complemento">Complemento</label>
                                                        <input type="text" class="form-control" name="complemento" id="complemento" value="{{$dadosUsuario[0]->DS_COMPLEMENTO_COMPRADOR}}" placeholder="Digite o Complemento">
                                                        @if($errors->has('complemento'))
                                                        <div class="error">{{ $errors->first('complemento') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cep">CEP</label>
                                                        <input type="text" class="form-control" name="cep" id="cep" value="{{$dadosUsuario[0]->NR_CEP_COMPRADOR}}" placeholder="Digite o CEP">
                                                        @if($errors->has('cep'))
                                                        <div class="error">{{ $errors->first('cep') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cidade">Cidade</label>
                                                        <select name="id_cidade" id="id_cidade" class="custom-select custom-select">
                                                            <option selected>Selecione</option>
                                                            @foreach ($cidades as $cidade)
                                                            @if($cidade->ID_CIDADE == $dadosUsuario[0]->ID_CIDADE_COMPRADOR)
                                                            <option selected value="{{$cidade->ID_CIDADE}}">{{$cidade->DS_CIDADE}}</option>
                                                            @else
                                                            <option value="{{$cidade->ID_CIDADE}}">{{$cidade->DS_CIDADE}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="facebook">Facebook</label>
                                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{$dadosUsuario[0]->DS_FACEBOOK}}" placeholder="Digite o Facebook">
                                                        @if($errors->has('facebook'))
                                                        <div class="error">{{ $errors->first('facebook') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="instagram">Instagram</label>
                                                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{$dadosUsuario[0]->DS_INSTAGRAM}}" placeholder="Digite o Instagram">
                                                        @if($errors->has('instagram'))
                                                        <div class="error">{{ $errors->first('instagram') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" style="z-index: 1;" class="button gradiente is-success px-5 mt-4 mx-auto">Salvar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="Rectangle" style="height: 16px; margin: 40px 0 48px; background-color: #f6f8f9;"></div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="nav-compras" role="tabpanel" aria-labelledby="nav-compras-tab">

                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Compras</h1><br>
                            </div>
                            <br>
                            <div class="container has-text-left">
                                @if (count($listaComprasUsuario) > 0)
                                @foreach($listaComprasUsuario as $key => $compra)
                                <div class="card" style="border: solid 1px #e6e6e6;border-radius:8px">
                                    <div class="card-content">
                                        <div class="content" style="background-color:#ccc;border-top-left-radius: 8px;border-top-right-radius: 8px;">
                                            <div class="columns">
                                                <div class="column is-3">
                                                    <ul style="list-style: none;margin:20px 0 20px 30px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Compra realizada</li>
                                                        <li class="subtitle is-6 is-bold is-left">{{$compra->DT_PEDIDO}}</li>
                                                    </ul>
                                                </div>
                                                <div class="column is-2">
                                                    <ul style="list-style: none;margin:20px 0 20px -70px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Total</li>
                                                        <li class="subtitle is-6 is-bold is-left">R$ {{$compra->VL_ITEM}}</li>
                                                    </ul>
                                                </div>
                                                <div class="column">
                                                    <ul style="list-style: none;margin:20px 0 20px -120px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Nº do pedido</li>
                                                        <li class="subtitle is-6 is-bold is-left">{{$compra->ID_PEDIDO}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <nav class="level" style="margin:20px 10px 20px 30px">
                                            <!-- Left side -->
                                            @if($compra->ENTREGA_FEITA = 1)
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <p class="subtitle is-5">
                                                        <span class="subtitle is-left is-6">Entrega feita em {{$compra->DT_ENTREGA}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            @else
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <p class="subtitle is-5">
                                                        <span class="subtitle is-left is-6">Entrega Prevista para {{$compra->DT_ENTREGA}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            @endif

                                            <!-- Right side -->
                                            <div class="level-right">
                                                <a href="/recuperarAnuncio/{{$compra->ID_ANUNCIO_PRODUTO}}" class="button gradiente is-outline" style="font-weight:bold;border:0.5px solid;width:165px;height:40px;">REPETIR COMPRA</a>
                                            </div>
                                        </nav>
                                        <div class="media" style="margin:20px 0 20px 30px">
                                            <div class="media-left">
                                                <div class="columns has-text-left">
                                                    <div class="column">
                                                        <figure class="image">
                                                            <img class="image" src="css\img\alok.png" style="height: 70px; width: 64px">
                                                        </figure>
                                                    </div>
                                                    <div class="column">
                                                        <figure class="image">
                                                            <img class="image" src="css\img\alok.png" style="height: 70px; width: 64px">
                                                        </figure>
                                                    </div>
                                                    <div class="column">
                                                        <figure class="image">
                                                            <img class="image" src="css\img\alok.png" style="height: 70px; width: 64px">
                                                        </figure>
                                                    </div>
                                                    <div class="column">
                                                        <figure class="image">
                                                            <img class="image" src="css\img\alok.png" style="height: 70px; width: 64px">
                                                        </figure>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                                @else
                                <div class="container has-text-left">
                                    <h1 class="titulos-1" style="width:447px;font-size:18px">Não há registros vinculados!</h1><br>
                                </div>
                                <br>
                                @endif
                            </div>

                        </section>
                    </div>
                    <div class="tab-pane fade" id="nav-lances" role="tabpanel" aria-labelledby="nav-lances-tab">
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Leilões</h1><br>
                            </div>
                            <br>
                            <div class="container has-text-left">
                                <div class="columns has-text-left">
                                    @if (count($leiloes) > 0)
                                    @foreach($leiloes as $key => $leilao)
                                    <a onclick="abrirDetalheLeilao('{{$leilao->ID_LEILAO}}')" href="#">
                                        <div style="width: 103.33%" class="column">
                                            <div class="card">
                                                <div class="card-image">
                                                    <figure class="image">
                                                        @if(isset($leilao->DS_FOTO_PRODUTO))
                                                        <img src="{{$leilao->DS_FOTO_PRODUTO}}" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                        @endif
                                                    </figure>
                                                </div>

                                                <div class="card-content">

                                                    <div class="content">
                                                        <article class="media">

                                                            <div class="media-content">
                                                                <div class="field">
                                                                    <p class="control">
                                                                        @if ($leilao->IN_LEILAO == 1)
                                                                    <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffc1077a;color:#000000;padding:5px">
                                                                        Encerra em {{$leilao->VL_DIAS_FALTANTES}} dias 🔥 </p>
                                                                    </p>
                                                                    @elseif ($leilao->IN_LEILAO == 0)
                                                                    <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffcccc;color:#000000;padding:5px">
                                                                        Leilão Encerrado 🔥 </p>
                                                                    </p>
                                                                    @elseif ($leilao->IN_LEILAO == 2)
                                                                    <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ccffdc;color:#000000;padding:5px">
                                                                        Leilão começa em {{$leilao->VL_DIAS_FALTANTES}} dias🔥 </p>
                                                                    </p>
                                                                    @endif
                                                                    <p class="control">
                                                                    <p class="subtitle is-5 is-left">{{$leilao->DS_ANUNCIO_PRODUTO}}</p>
                                                                    </p>
                                                                    <p class="control">
                                                                    <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Maior Lance Atual</p>
                                                                    </p>
                                                                    <p class="control">
                                                                    <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ {{$leilao->VL_LANCE_MAIOR}}</p>
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </article>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    @else
                                    <div class="container has-text-left">
                                        <h1 class="titulos-1" style="width:447px;font-size:18px">Não há registros vinculados!</h1><br>
                                    </div>
                                    <br>
                                    @endif

                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="nav-favoritos" role="tabpanel" aria-labelledby="nav-favoritos-tab">
                        <!--------------------------------------LEILÃO--------------->
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Leilão</h1><br>
                            </div>

                            @if (count($leiloesFavoritos) > 0)
                                    @foreach($leiloesFavoritos as $key => $produto)
                                    <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                        <figure class="media-left">
                                            <p class="image">
                                                @if(isset($produto->DS_FOTO_PRODUTO))
                                                <img class="image" src="{{$produto->DS_FOTO_PRODUTO}}" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                                @endif

                                            </p>
                                        </figure>
                                        <div class="media-content">
                                            <div class="field" style="padding:8px;">
                                                <p class="control">
                                                @if ($produto->IN_LEILAO == 1)
                                                <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffc1077a;color:#000000;padding:5px">
                                                    Encerra em {{$produto->VL_DIAS_FALTANTES}} dias 🔥 </p>
                                                </p>
                                                @elseif ($produto->IN_LEILAO == 0)
                                                <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffcccc;color:#000000;padding:5px">
                                                    Leilão Encerrado 🔥 </p>
                                                </p>
                                                @elseif ($produto->IN_LEILAO == 2)
                                                <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ccffdc;color:#000000;padding:5px">
                                                    Leilão começa em {{$produto->VL_DIAS_FALTANTES}} dias🔥 </p>
                                                </p>
                                                @endif
                                                <p class="control">
                                                <p class="subtitle is-5 is-left">{{$produto->DS_ANUNCIO_PRODUTO}}</p>
                                                </p>
                                                <p class="control">
                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Maior Lance Atual</p>
                                                </p>
                                                <p class="control">
                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ {{$produto->VL_LANCE_MAIOR}}</p>
                                                </p>
                                            </div>

                                        </div>
                                        <div class="media-right" style="margin-top:130px">
                                            <a href="/editarAnuncio/{{$produto->ID_ANUNCIO_PRODUTO}}">
                                                <span class="button gradiente"><img src="css\img\bt-link.png"></span>
                                            </a>
                                            <span onclick="showModal('{{$produto->ID_LEILAO}}')" id="myBtn_{{$produto->ID_LEILAO}}" class="button gradiente" style="color:red;">Excluir &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                            <div id="myModal_{{$produto->ID_LEILAO}}" class="modal">
                                                <!-- Modal content -->
                                                <div class="modal-content" style="width: 50%;">
                                                    <span onclick="hideModal('{{$produto->ID_LEILAO}}')" id="close" class="close">&times;</span>
                                                    <p style="margin-left: 260px;">Tem certeza que deseja excluir esse produto?</p>
                                                    <button onclick="deletarProduto('{{$produto->ID_ANUNCIO_PRODUTO}}')" id="myBtn" class="button gradiente is-success" style="border:1px solid #17B330;height: 48px;width: 350px;border-radius:4px;margin-left: 260px;margin-top: 30px;">Excluir Produto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    </a>
                                    @endforeach
                                @else
                                    <div class="container has-text-left">
                                        <h1 class="titulos-1" style="width:447px;font-size:18px">Não há registros vinculados!</h1><br>
                                    </div>
                                <br>
                                @endif
                        </section>

                        <!--------------------------------------ECOMMERCE--------------->
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Ecommerce</h1><br>
                            </div>
                            <div class="container has-text-left">
                                @if (count($produtosFavoritos) > 0)
                                @foreach($produtosFavoritos as $key => $produto)
                                <div class="column">
                                    <div class="card">

                                        <div class="card-image">
                                            <figure class="image" style="height: 288px; width: 255px;">
                                                <img src="{{$produto->DS_FOTO_ANUNCIO_PRODUTO}}" style="height: 288px; width: 255px;" alt="Placeholder image">
                                            </figure>
                                        </div>

                                        <div class="card-content" style="padding:10px;box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15);">

                                            <div class="content">
                                                <article class="media">

                                                    <div class="media-content">
                                                        <div class="field">
                                                            <p class="control">
                                                            <p class="subtitle is-bold is-6 is-left">{{$produto->DS_PRODUTO}}</p>
                                                            @if ($produto->IN_PROMOCAO == 1)
                                                            @if(isset($produto->VL_PRODUTO_ANTIGO))
                                                            <font class="subtitle is-8 is-danger" style="color: red;"><strike>R${{$produto->VL_PRODUTO_ANTIGO}}</strike></font>
                                                            @else
                                                            <font class="subtitle is-8 is-danger" style="color: red;"><strike>R$ 0,00</strike></font>
                                                            @endif
                                                            @if(isset($produto->VL_PRODUTO_UNITARIO))
                                                            <font class="subtitle is-6" style="color: black;">R${{$produto->VL_PRODUTO_UNITARIO}} / {{$produto->DS_UNIDADE_MEDIDA}}</font>
                                                            @else
                                                            <font class="subtitle is-6" style="color: black;">R$0,00 / {{$produto->DS_UNIDADE_MEDIDA}}</font>
                                                            @endif
                                                            @else
                                                            <font class="subtitle is-6" style="color: black;">R${{$produto->VL_PRODUTO_UNITARIO}} / {{$produto->DS_UNIDADE_MEDIDA}}</font>
                                                            @endif
                                                            </p>
                                                        </div>
                                                        <nav class="level">
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
                                                        </nav>
                                                    </div>
                                                </article>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="container has-text-left">
                                    <h1 class="titulos-1" style="width:447px;font-size:18px">Não há registros vinculados!</h1><br>
                                </div>
                                <br>
                                @endif
                            </div>
                        </section>

                    </div>
                    <div class="tab-pane fade" id="nav-produtos" role="tabpanel" aria-labelledby="nav-produtos-tab">
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Meus Leilões</h1><br>
                            </div>
                            <br>
                            <div class="container has-text-left">
                                @if (count($leiloes) > 0)
                                    @foreach($leiloes as $key => $leilao)
                                    <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                        <figure class="media-left">
                                            <p class="image">
                                                @if(isset($leilao->DS_FOTO_PRODUTO))
                                                <img class="image" src="{{$leilao->DS_FOTO_PRODUTO}}" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                                @endif

                                            </p>
                                        </figure>
                                        <div class="media-content">
                                            <div class="field" style="padding:8px;">
                                                <p class="control">
                                                    @if ($leilao->IN_LEILAO == 1)
                                                <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffc1077a;color:#000000;padding:5px">
                                                    Encerra em {{$leilao->VL_DIAS_FALTANTES}} dias 🔥 </p>
                                                </p>
                                                @elseif ($leilao->IN_LEILAO == 0)
                                                <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffcccc;color:#000000;padding:5px">
                                                    Leilão Encerrado 🔥 </p>
                                                </p>
                                                @elseif ($leilao->IN_LEILAO == 2)
                                                <p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ccffdc;color:#000000;padding:5px">
                                                    Leilão começa em {{$leilao->VL_DIAS_FALTANTES}} dias🔥 </p>
                                                </p>
                                                @endif
                                                <p class="control">
                                                <p class="subtitle is-5 is-left">{{$leilao->DS_ANUNCIO_PRODUTO}}</p>
                                                </p>
                                                <p class="control">
                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Maior Lance Atual</p>
                                                </p>
                                                <p class="control">
                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ {{$leilao->VL_LANCE_MAIOR}}</p>
                                                </p>
                                            </div>

                                        </div>
                                        <div class="media-right" style="margin-top:130px">
                                            <a href="/editarAnuncio/{{$leilao->ID_ANUNCIO_PRODUTO}}">
                                                <span class="button gradiente"><img src="css\img\bt-link.png"></span>
                                            </a>
                                            <span onclick="showModal('{{$leilao->ID_LEILAO}}')" id="myBtn_{{$leilao->ID_LEILAO}}" class="button gradiente" style="color:red;">Excluir &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                            <div id="myModal_{{$leilao->ID_LEILAO}}" class="modal">
                                                <!-- Modal content -->
                                                <div class="modal-content" style="width: 50%;">
                                                    <span onclick="hideModal('{{$leilao->ID_LEILAO}}')" id="close" class="close">&times;</span>
                                                    <p style="margin-left: 260px;">Tem certeza que deseja excluir esse produto?</p>
                                                    <button onclick="deletarProduto('{{$leilao->ID_ANUNCIO_PRODUTO}}')" id="myBtn" class="button gradiente is-success" style="border:1px solid #17B330;height: 48px;width: 350px;border-radius:4px;margin-left: 260px;margin-top: 30px;">Excluir Produto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    </a>
                                    @endforeach
                                @else
                                    <div class="container has-text-left">
                                        <h1 class="titulos-1" style="width:447px;font-size:18px">Não há registros vinculados!</h1><br>
                                    </div>
                                <br>
                                @endif
                            </div>
                        </section>
                        <!--------------------------------------ECOMMERCE--------------->
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Produtos</h1><br>
                            </div>

                            <div class="container has-text-left">
                                @if (count($produtos) > 0)
                                @foreach($produtos as $key => $produto)
                                <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                    <figure class="media-left">
                                        <p class="image">
                                            <img class="image" src="{{$produto->DS_FOTO_ANUNCIO_PRODUTO}}" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="field" style="padding:8px;">

                                            <p class="control">
                                            <p class="subtitle is-5 is-left" style="width:226px;">{{$produto->DS_PRODUTO}}</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;font-family:'Open Sans';line-height: 0;">R$ {{$produto->VL_PRODUTO_UNITARIO}}</p>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right" style="margin-top:135px">
                                        <a href="/editarAnuncio/{{$produto->ID_ANUNCIO_PRODUTO}}">
                                            <span class="button gradiente"><img src="css\img\bt-link.png"></span>
                                        </a>
                                        <span onclick="showModal('{{$produto->ID_ANUNCIO_PRODUTO}}')" id="myBtn_{{$produto->ID_ANUNCIO_PRODUTO}}" class="button gradiente" style="color:red;">Excluir &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                        <div id="myModal_{{$produto->ID_ANUNCIO_PRODUTO}}" class="modal">
                                            <!-- Modal content -->
                                            <div class="modal-content" style="width: 50%;">
                                                <span onclick="hideModal('{{$produto->ID_ANUNCIO_PRODUTO}}')" id="close" class="close">&times;</span>
                                                <p style="margin-left: 260px;">Tem certeza que deseja excluir esse produto?</p>
                                                <button onclick="deletarProduto('{{$produto->ID_ANUNCIO_PRODUTO}}')" id="myBtn" class="button gradiente is-success" style="border:1px solid #17B330;height: 48px;width: 350px;border-radius:4px;margin-left: 260px;margin-top: 30px;">Excluir Produto</button>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                                @else
                                <div class="container has-text-left">
                                    <h1 class="titulos-1" style="width:447px;font-size:18px">Não há registros vinculados!</h1><br>
                                </div>
                                <br>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
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
<script>
    var statusCode = JSON.parse("{{ json_encode(isset($statusCode)) }}");
    if (statusCode == 201) {
        alert('Usuário atualizado com sucesso!');
        //trocar por success
    }
</script>
<script>
    function showModal(id) {
        sessionStorage.setItem('idModal', id);
        var modal = document.getElementById("myModal_" + id);
        modal.style.display = "block";
    }

    function hideModal(id) {
        var modal = document.getElementById("myModal_" + id);
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        var idModal = sessionStorage.getItem('idModal');
        var modal = document.getElementById("myModal_" + idModal);
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection