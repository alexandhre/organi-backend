@extends('layouts.site')

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
                                    <form class="column" method="post" action="{{ route('atualizarComprador') }}">
                                    @csrf
                                    <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                                        <div class="card" style="z-index: 1;">
                                            <div class="card-content">
                                                <div class="form-group">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control" name="nome" id="nome" value="{{$dadosUsuario[0]->DS_NOME}}" placeholder="Digite o nome">
                                                    @if($errors->has('nome'))
                                                        <div class="error">{{ $errors->first('nome') }}</div>
                                                    @endif 
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="sobrenome">Sobrenome</label>
                                                    <input type="text" class="form-control" name="sobrenome" id="sobrenome" value="{{$dadosUsuario[0]->DS_SOBRENOME}}" placeholder="Digite o sobrenome">
                                                    @if($errors->has('sobrenome'))
                                                        <div class="error">{{ $errors->first('sobrenome') }}</div>
                                                    @endif 
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="cpf">CPF</label>
                                                    <input type="text" class="form-control" name="cpf" id="cpf" value="{{$dadosUsuario[0]->NR_CPF}}" placeholder="Digite o CPF">
                                                    @if($errors->has('cpf'))
                                                        <div class="error">{{ $errors->first('cpf') }}</div>
                                                    @endif 
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="{{$dadosUsuario[0]->DS_EMAIL}}" placeholder="Digite o Email">
                                                    @if($errors->has('email'))
                                                        <div class="error">{{ $errors->first('email') }}</div>
                                                    @endif                                                    
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="gmail">GMAIL</label>
                                                    <input type="text" class="form-control" name="gmail" id="gmail" value="{{$dadosUsuario[0]->DS_GMAIL}}" placeholder="Digite o email GMAIL">
                                                    @if($errors->has('gmail'))
                                                        <div class="error">{{ $errors->first('gmail') }}</div>
                                                    @endif 
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="ddd">DDD</label>
                                                    <input type="text" class="form-control" name="ddd" id="ddd" value="{{$dadosUsuario[0]->NR_DDD_TELEFONE}}" placeholder="Digite o DDD">
                                                    @if($errors->has('ddd'))
                                                        <div class="error">{{ $errors->first('ddd') }}</div>
                                                    @endif 
                                                </div>
                                                <br>
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
                                    <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                                        <div class="card" style="z-index: 1;">
                                            <div class="card-content">
                                                <div class="form-group">
                                                    <label for="endereco">Endereço</label>
                                                    <input type="text" class="form-control" name="endereco" id="endereco" value="{{$dadosUsuario[0]->DS_ENDERECO_COMPRADOR}}" placeholder="Digite o Endereço">
                                                    @if($errors->has('endereco'))
                                                        <div class="error">{{ $errors->first('endereco') }}</div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="nr_endereco">Numero Endereço</label>
                                                    <input type="text" class="form-control" name="nr_endereco" id="nr_endereco" value="{{$dadosUsuario[0]->NR_ENDERECO_COMPRADOR}}" placeholder="Digite o Número do Endereço">
                                                    @if($errors->has('nr_endereco'))
                                                        <div class="error">{{ $errors->first('nr_endereco') }}</div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="complemento">Complemento</label>
                                                    <input type="text" class="form-control" name="complemento" id="complemento" value="{{$dadosUsuario[0]->DS_COMPLEMENTO_COMPRADOR}}" placeholder="Digite o Complemento">
                                                    @if($errors->has('complemento'))
                                                        <div class="error">{{ $errors->first('complemento') }}</div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="cep">CEP</label>
                                                    <input type="text" class="form-control" name="cep" id="cep" value="{{$dadosUsuario[0]->NR_CEP_COMPRADOR}}" placeholder="Digite o CEP">
                                                    @if($errors->has('cep'))
                                                        <div class="error">{{ $errors->first('cep') }}</div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="cidade">Cidade</label>
                                                    <select name="id_cidade" id="id_cidade" class="custom-select custom-select-sm">
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
                                                <br>
                                                <div class="form-group">
                                                    <label for="facebook">Facebook</label>
                                                    <input type="text" class="form-control" name="facebook" id="facebook" value="{{$dadosUsuario[0]->DS_FACEBOOK}}" placeholder="Digite o Facebook">
                                                    @if($errors->has('facebook'))
                                                        <div class="error">{{ $errors->first('facebook') }}</div>
                                                    @endif
                                                </div>
                                                <br>
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
                                    <button type="submit" style="z-index: 1;" class="btn btn-primary">Salvar</button>
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
                                <div class="card" style="border: solid 1px #e6e6e6;border-radius:8px">

                                    <div class="card-content">
                                        <div class="content" style="background-color:#ccc;border-top-left-radius: 8px;border-top-right-radius: 8px;">
                                            <div class="columns">
                                                <div class="column is-3">
                                                    <ul style="list-style: none;margin:20px 0 20px 30px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Compra realizada</li>
                                                        <li class="subtitle is-6 is-bold is-left">2 de junho 2022</li>
                                                    </ul>
                                                </div>
                                                <div class="column is-2">
                                                    <ul style="list-style: none;margin:20px 0 20px -70px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Total</li>
                                                        <li class="subtitle is-6 is-bold is-left">R$ 376,50</li>
                                                    </ul>
                                                </div>
                                                <div class="column">
                                                    <ul style="list-style: none;margin:20px 0 20px -120px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Nº do pedido</li>
                                                        <li class="subtitle is-6 is-bold is-left">40.332.111</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <nav class="level" style="margin:20px 10px 20px 30px">
                                            <!-- Left side -->
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <p class="subtitle is-5">
                                                        <span class="subtitle is-left is-6">Entregada 4 de junho</span>
                                                    </p>
                                                </div>

                                            </div>
                                            <!-- Right side -->
                                            <div class="level-right">
                                                <button class="button gradiente is-outline" style="font-weight:bold;border:0.5px solid;width:165px;height:40px;">REPETIR COMPRA</button>
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
                                <div class="card" style="border: solid 1px #e6e6e6;border-radius:8px">
                                    <div class="card-content">
                                        <div class="content" style="background-color:#ccc;border-top-left-radius: 8px;border-top-right-radius: 8px;">
                                            <div class="columns">
                                                <div class="column is-3">
                                                    <ul style="list-style: none;margin:20px 0 20px 30px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Compra realizada</li>
                                                        <li class="subtitle is-6 is-bold is-left">2 de junho 2022</li>
                                                    </ul>
                                                </div>
                                                <div class="column is-2">
                                                    <ul style="list-style: none;margin:20px 0 20px -70px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Total</li>
                                                        <li class="subtitle is-6 is-bold is-left">R$ 376,50</li>
                                                    </ul>
                                                </div>
                                                <div class="column">
                                                    <ul style="list-style: none;margin:20px 0 20px -120px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Nº do pedido</li>
                                                        <li class="subtitle is-6 is-bold is-left">40.332.111</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <nav class="level" style="margin:20px 10px 20px 30px">
                                            <!-- Left side -->
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <p class="subtitle is-5">
                                                        <span class="subtitle is-left is-6">Entregada 4 de junho</span>
                                                    </p>
                                                </div>

                                            </div>
                                            <!-- Right side -->
                                            <div class="level-right">
                                                <button class="button gradiente is-outline" style="font-weight:bold;border:0.5px solid;width:165px;height:40px;">REPETIR COMPRA</button>
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
                                <div class="card" style="border: solid 1px #e6e6e6;border-radius:8px">

                                    <div class="card-content">
                                        <div class="content" style="background-color:#ccc;border-top-left-radius: 8px;border-top-right-radius: 8px;">
                                            <div class="columns">
                                                <div class="column is-3">
                                                    <ul style="list-style: none;margin:20px 0 20px 30px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Compra realizada</li>
                                                        <li class="subtitle is-6 is-bold is-left">2 de junho 2022</li>
                                                    </ul>
                                                </div>
                                                <div class="column is-2">
                                                    <ul style="list-style: none;margin:20px 0 20px -70px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Total</li>
                                                        <li class="subtitle is-6 is-bold is-left">R$ 376,50</li>
                                                    </ul>
                                                </div>
                                                <div class="column">
                                                    <ul style="list-style: none;margin:20px 0 20px -120px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Nº do pedido</li>
                                                        <li class="subtitle is-6 is-bold is-left">40.332.111</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <nav class="level" style="margin:20px 10px 20px 30px">
                                            <!-- Left side -->
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <p class="subtitle is-5">
                                                        <span class="subtitle is-left is-6">Entregada 4 de junho</span>
                                                    </p>
                                                </div>

                                            </div>
                                            <!-- Right side -->
                                            <div class="level-right">
                                                <button class="button gradiente is-outline" style="font-weight:bold;border:0.5px solid;width:165px;height:40px;">REPETIR COMPRA</button>
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
                                <div class="card" style="border: solid 1px #e6e6e6;border-radius:8px">

                                    <div class="card-content">
                                        <div class="content" style="background-color:#ccc;border-top-left-radius: 8px;border-top-right-radius: 8px;">
                                            <div class="columns">
                                                <div class="column is-3">
                                                    <ul style="list-style: none;margin:20px 0 20px 30px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Compra realizada</li>
                                                        <li class="subtitle is-6 is-bold is-left">2 de junho 2022</li>
                                                    </ul>
                                                </div>
                                                <div class="column is-2">
                                                    <ul style="list-style: none;margin:20px 0 20px -70px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Total</li>
                                                        <li class="subtitle is-6 is-bold is-left">R$ 376,50</li>
                                                    </ul>
                                                </div>
                                                <div class="column">
                                                    <ul style="list-style: none;margin:20px 0 20px -120px">
                                                        <li class="subtitle is-6 is-left" style="width: max-content;line-height:0px;">Nº do pedido</li>
                                                        <li class="subtitle is-6 is-bold is-left">40.332.111</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <nav class="level" style="margin:20px 10px 20px 30px">
                                            <!-- Left side -->
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <p class="subtitle is-5">
                                                        <span class="subtitle is-left is-6">Entregada 4 de junho</span>
                                                    </p>
                                                </div>

                                            </div>
                                            <!-- Right side -->
                                            <div class="level-right">
                                                <button class="button gradiente is-outline" style="font-weight:bold;border:0.5px solid;width:165px;height:40px;">REPETIR COMPRA</button>
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

                            </div>

                        </section>
                    </div>
                    <div class="tab-pane fade" id="nav-lances" role="tabpanel" aria-labelledby="nav-lances-tab">
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Em processo</h1><br>
                            </div>
                            <br>
                            <div class="container has-text-left">
                                <div class="columns has-text-left">
                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Finzalizados</h1><br>
                            </div>
                            <br>


                            <div class="container has-text-left">
                                <div class="columns has-text-left">
                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="width: max-content;font-family:'Open Sans';height: 24px;border-radius:12px;background-color:#ffcf0d;color:#000000;padding:5px">
                                                                    FINALIZADO</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #000000;font-family:'Open Sans';">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="width: max-content;font-family:'Open Sans';height: 24px;border-radius:12px;background-color:#ffcf0d;color:#000000;padding:5px">
                                                                    FINALIZADO</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #000000;font-family:'Open Sans';">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                    </div>
                                    <div class="column">
                                    </div>
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
                            <br>


                            <div class="container has-text-left">
                                <div class="columns has-text-left">
                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="card">

                                            <div class="card-image">

                                                <figure class="image">

                                                    <img src="css\img\fitness.png" style="height: 184px; width: 255px;" alt="Placeholder image">
                                                </figure>
                                            </div>

                                            <div class="card-content">

                                                <div class="content">
                                                    <article class="media">

                                                        <div class="media-content">
                                                            <div class="field">
                                                                <p class="control">
                                                                <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                                    ENCERRA EM 2 DIAS 🔥</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-7 is-left" style="font-family:'Open Sans';color: #808080;">Preço atual</p>
                                                                </p>
                                                                <p class="control">
                                                                <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;">R$ 10.500,00</p>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>

                        <!--------------------------------------ECOMMERCE--------------->
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Ecommerce</h1><br>
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
                                                    <img src="css\img\fitness.png" style="height: 288px; width: 255px;" alt="Placeholder image">
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
                                                                        <a class="button gradiente"><img style="height:27x; width:30px" src="css\img\icons8-favorite-60.png"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                                                    <div class="level-item">
                                                                        <a><img style="height:28px; width:28px" src="css\img\icons8-minus-50.png"></a>
                                                                        <span class="subtitle is-bold" style="font-size:16px;color:#1a1a1a;"> &nbsp 3 &nbsp </span>
                                                                        <a><img style="height:28px; width:28px" src="css\img\icons8-plus-50.png"></a>
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
                                                    <img src="css\img\fitness.png" style="height: 288px; width: 255px;" alt="Placeholder image">
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
                                                                        <a class="button gradiente"><img style="height:27x; width:30px" src="css\img\icons8-favorite-60.png"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                                                    <div class="level-item">

                                                                        <a><img style="height:34px; width:34px" src="css\img\general-icons-32-px-ic-plus-circle.png"></a>
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
                                                    <img src="css\img\fitness.png" style="height: 288px; width: 255px;" alt="Placeholder image">
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
                                                                        <a class="button gradiente"><img style="height:27x; width:30px" src="css\img\icons8-favorite-60.png"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                                                    <div class="level-item">

                                                                        <a><img style="height:34px; width:34px" src="css\img\general-icons-32-px-ic-plus-circle.png"></a>
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
                                                    <img src="css\img\fitness.png" style="height: 288px; width: 255px;" alt="Placeholder image">
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
                                                                        <a class="button gradiente"><img style="height:27x; width:30px" src="css\img\icons8-favorite-60.png"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="level-right" style="background-color:#f2f2f2;border-radius:75px">
                                                                    <div class="level-item">

                                                                        <a><img style="height:34px; width:34px" src="css\img\general-icons-32-px-ic-plus-circle.png"></a>
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
                    </div>
                    <div class="tab-pane fade" id="nav-produtos" role="tabpanel" aria-labelledby="nav-produtos-tab">
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Leilão</h1><br>
                            </div>
                            <br>


                            <div class="container has-text-left">
                                <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                    <figure class="media-left">
                                        <p class="image">
                                            <img class="image" src="css\img\alok.png" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="field" style="padding:8px;">
                                            <p class="control">
                                            <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                ENCERRA EM 2 DIAS 🔥</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;line-height: 0;">R$ 10.500,00</p>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right" style="margin-top:130px">
                                        <span class="button gradiente"><img src="css\img\bt-link.png"></span><span class="button gradiente" style="color:red;">Eliminar &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                    </div>
                                </article>

                                <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                    <figure class="media-left">
                                        <p class="image">
                                            <img class="image" src="css\img\alok.png" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="field" style="padding:8px;">
                                            <p class="control">
                                            <p class="subtitle is-8 is-bold" style="font-family:'Open Sans';width: max-content;height: 24px;border-radius:12px;background-color:#ccfffc;color:#000000;padding:5px">
                                                ENCERRA EM 2 DIAS 🔥</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-5 is-left">Lorem ipsum dolor sit amet, consectetur</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-2 is-left is-bold" style="font-family:'Open Sans';width: 188px;color: #17B330;line-height: 0;">R$ 10.500,00</p>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right" style="margin-top:135px">
                                        <span class="button gradiente"><img src="css\img\bt-link.png"></span><span class="button gradiente" style="color:red;">Eliminar &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                    </div>
                                </article>

                            </div>

                        </section>

                        <!--------------------------------------ECOMMERCE--------------->
                        <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Ecommerce</h1><br>
                            </div>

                            <div class="container has-text-left">
                                <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                    <figure class="media-left">
                                        <p class="image">
                                            <img class="image" src="css\img\alok.png" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="field" style="padding:8px;">

                                            <p class="control">
                                            <p class="subtitle is-5 is-left" style="width:226px;">Lorem ipsum dolor sit amet, consectetur</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;font-family:'Open Sans';line-height: 0;">R$ 10.500,00</p>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right" style="margin-top:135px">
                                        <span class="button gradiente"><img src="css\img\bt-link.png"></span><span class="button gradiente" style="color:red;">Eliminar &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                    </div>
                                </article>

                                <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                    <figure class="media-left">
                                        <p class="image">
                                            <img class="image" src="css\img\alok.png" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="field" style="padding:8px;">
                                            <p class="control">
                                            <p class="subtitle is-5 is-left" style="width:226px;">Lorem ipsum dolor sit amet, consectetur</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;font-family:'Open Sans';line-height: 0;">R$ 10.500,00</p>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right" style="margin-top:135px">
                                        <span class="button gradiente"><img src="css\img\bt-link.png"></span><span class="button gradiente" style="color:red;">Eliminar &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                    </div>
                                </article>

                                <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                    <figure class="media-left">
                                        <p class="image">
                                            <img class="image" src="css\img\alok.png" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="field" style="padding:8px;">
                                            <p class="control">
                                            <p class="subtitle is-5 is-left" style="width:226px;">Lorem ipsum dolor sit amet, consectetur</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;font-family:'Open Sans';line-height: 0;">R$ 10.500,00</p>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right" style="margin-top:135px">
                                        <span class="button gradiente"><img src="css\img\bt-link.png"></span><span class="button gradiente" style="color:red;">Eliminar &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                    </div>
                                </article>

                                <article class="media" style="box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15); border-radius: 8px;">
                                    <figure class="media-left">
                                        <p class="image">
                                            <img class="image" src="css\img\alok.png" style="height: 184px; width: 259px;border-radius: 8px 0 0 8px;">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="field" style="padding:8px;">
                                            <p class="control">
                                            <p class="subtitle is-5 is-left" style="width:226px;">Lorem ipsum dolor sit amet, consectetur</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-7 is-left" style="color: #808080;font-family:'Open Sans';">Preço atual</p>
                                            </p>
                                            <p class="control">
                                            <p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;font-family:'Open Sans';line-height: 0;">R$ 10.500,00</p>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right" style="margin-top:135px">
                                        <span class="button gradiente"><img src="css\img\bt-link.png"></span><span class="button gradiente" style="color:red;">Eliminar &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                    </div>
                                </article>

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
    var jobs = JSON.parse("{{ json_encode($statusCode) }}");
    console.log(jobs);
</script>
@endsection