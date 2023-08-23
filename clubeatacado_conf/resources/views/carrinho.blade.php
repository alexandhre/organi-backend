@extends('layouts.site')
@include('layouts\_includes\topoCarrinho')

@section('content')

<section id="tabs" class="project-tab">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <section class="section">
                            <div class="container has-text-left">
                                <h1 class="titulos-1" style="width:447px;font-size:18px">Carrinho de Compras</h1><br>
                            </div>
                            <div class="container has-text-left">
                                @if (count($listaCarrinho) > 0)
                                @foreach($listaCarrinho as $key => $carrinho)
                                <div class="column">
                                    <div class="card">

                                        <div class="card-image">
                                            <figure class="image" style="height: 288px; width: 255px;">
                                                <img src="{{$carrinho->DS_FOTO_ANUNCIO_PRODUTO}}" style="height: 288px; width: 255px;" alt="Placeholder image">
                                            </figure>
                                        </div>
                                        <div class="card-content" style="padding:10px;box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.15);">
                                            <div class="content">
                                                <article class="media">

                                                    <div class="media-content">
                                                        <div class="field">
                                                            <p class="control">
                                                            <p class="subtitle is-bold is-6 is-left">{{$carrinho->DS_PRODUTO}}</p>
                                                            <font class="subtitle is-6" style="color: black;">R${{$carrinho->VL_PRODUTO_UNITARIO}}</font>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="media-right" style="margin-top:130px">                                           
                                            <span onclick="showModal('{{$carrinho->ID_ANUNCIO_PRODUTO}}')" id="myBtn_{{$carrinho->ID_ANUNCIO_PRODUTO}}" class="button gradiente" style="color:red;">Excluir &nbsp <img src="css\img\atoms-icons-04-functional-func-023-trash.png"></span>
                                            <div id="myModal_{{$carrinho->ID_ANUNCIO_PRODUTO}}" class="modal">
                                                <!-- Modal content -->
                                                <div class="modal-content" style="width: 50%;">
                                                    <span onclick="hideModal('{{$carrinho->ID_ANUNCIO_PRODUTO}}')" id="close" class="close">&times;</span>
                                                    <p style="margin-left: 260px;">Tem certeza que deseja excluir esse produto do carrinho?</p>
                                                    <button onclick="deletarProdutoCarrinho('{{$carrinho->ID_ANUNCIO_PRODUTO}}')" id="myBtn" class="button gradiente is-success" style="border:1px solid #17B330;height: 48px;width: 350px;border-radius:4px;margin-left: 260px;margin-top: 30px;">Excluir Produto</button>
                                                </div>
                                            </div>
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
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
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