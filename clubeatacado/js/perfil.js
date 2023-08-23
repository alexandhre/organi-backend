function redirecionarPesquisa(pagina) {
    sessionStorage.setItem('pagina', pagina);
    window.location.href = '/clubeatacado/pesquisa';
}

function onload() {
    sessionStorage.setItem('numeroElementos', 0);
    var pagina = sessionStorage.getItem('pagina');
    switch (pagina) {
        case 'categoria':
            $('#filtro').css('display', 'none');
            $('#btn-ver-mais').attr('id', 'btn-mais-categoria');
            $('#lista').attr('id', 'listCategoria');            
            carregarCategorias();
            break;
        case 'promocao':
            $('#btn-ver-mais').attr('id', 'btn-mais-promocao');
            $('#lista').attr('id', 'listPromocao');
            $('#btn-mais-promocao').attr('onclick', 'carregarPromocoes()');            
            carregarPromocoes();
            break;
        case 'produto':
            $('#btn-ver-mais').attr('id', 'btn-mais-produto');
            $('#lista').attr('id', 'listProduto');
            $('#btn-mais-produto').attr('onclick', 'carregarProdutos()');            
            carregarProdutos();
            break;
        default:
    }
}

function carregarCategorias() {

    var numeroElementos = sessionStorage.getItem('numeroElementos');
    $('#btn-mais-categoria').css('display', 'none');
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/categoria',
        dataType: "json",
        data: { "numeroElementos": numeroElementos },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.message) {
                error(data.response.erro.message);
            } else {
                //posteriormente implementar JWT 
                sessionStorage.setItem('numeroElementos', parseInt(numeroElementos) + parseInt(9));
                $('#titulo').text(data.response.sucesso.message.titulo);
                $('#btn-mais-categoria').css('display', 'block');                
                appendCategoria('#listCategoria', data.response.sucesso.message.categorias);
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

function appendCategoria(idHtml, categoria) {

    if (categoria.length > 0) {        
        for (var i = 0; i < categoria.length; i++) {
            card_categoria = '';
            card_categoria = card_categoria + ' <div class="column">' +
                '<div class="card" style="box-shadow: 0 0px 0px #ffffff00">' +
                '<div class="card-image">' +
                '<figure class="card-home-medium">' +
                '<img src="css\\img\\rectangle-1.png" style="filter: brightness(60%);border-radius: 8px;" alt="Placeholder image">' +
                '</figure>' +
                '</div>' +
                '<div class="card-content" style="position:absolute;top:100px;left:14px">' +
                '<p class="imagem-titulo">' + categoria[i].DS_CATEGORIA_PRODUTO + '</p>' +
                '</div>' +
                '</div>' +
                '</div>';
            $(idHtml).append(card_categoria);
        }
    } else {
        sessionStorage.setItem('numeroElementos', 0);
        warning('Não há mais registros de categorias!');
        $('#recarregar-pagina').css('display', 'block'); 
        $('#btn-mais-categoria').css('display', 'none');               
    }
}

function carregarPromocoes() {

    var numeroElementos = sessionStorage.getItem('numeroElementos');
    $('#btn-mais-promocao').css('display', 'none');
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/promocao',
        dataType: "json",
        data: { "numeroElementos": numeroElementos },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.message) {
                error(data.response.erro.message);
            } else {
                //posteriormente implementar JWT 
                sessionStorage.setItem('numeroElementos', parseInt(numeroElementos) + parseInt(9));
                $('#titulo').text(data.response.sucesso.message.titulo);
                $('#btn-mais-promocao').css('display', 'block');
                armazenarLista('lista', data.response.sucesso.message.promocoes);
                appendPromocao('#listPromocao', data.response.sucesso.message.promocoes);
                preencherComboCategoria(data.response.sucesso.message.categorias);
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

function appendPromocao(idHtml, promocao) {

    if (promocao.length > 0) {       
        for (var i = 0; i < promocao.length; i++) {
            if (promocao[i].IN_PROMOCAO == 1) {
                card_promocao = '';
                card_promocao = card_promocao + '<div class="column">' +
                    '<div class="card" style="box-shadow: 0 0px 0px #ffffff00;background-color:#fafafa;">' +
                    '<div class="card-image">' +
                    '<figure class="image is-rounded" style="text-align: center;">' +
                    '<img class="is-rounded" style="height:66px; width:66px; display:initial" src="' + promocao[i].DS_FOTO_ANUNCIO_PRODUTO + '">' +
                    '</figure>' +
                    '<div class="content">' +
                    '<p class="subtitle is-6" style="text-align:center;">' + promocao[i].DS_PRODUTO + '</p>' +
                    '<p class="subtitle is-6 is-danger" style="text-align:center;font-size:12px"><strike>R$ ' + promocao[i].VL_PRODUTO_ANTIGO + '</strike></p>' +
                    '<p class="subtitle" style="text-align:center;font-size:16px;line-height:1.67">R$ ' + promocao[i].VL_PRODUTO_UNITARIO + '</p>' +
                    '<p class="subtitle is-8" style="text-align:center;font-size:12px;">' + promocao[i].VL_PESO_PACOTE_KG + '' + promocao[i].DS_UNIDADE_MEDIDA + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $(idHtml).append(card_promocao);
            }
        }
    } else {
        sessionStorage.setItem('numeroElementos', 0);
        warning('Não há mais registros de promoções!');
        $('#recarregar-pagina').css('display', 'block');        
    }
}

function carregarProdutos() {

    var numeroElementos = sessionStorage.getItem('numeroElementos');
    $('#btn-mais-produto').css('display', 'none');
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/produto',
        dataType: "json",
        data: { "numeroElementos": numeroElementos },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.message) {
                error(data.response.erro.message);
            } else {
                //posteriormente implementar JWT 
                sessionStorage.setItem('numeroElementos', parseInt(numeroElementos) + parseInt(9));
                $('#titulo').text(data.response.sucesso.message.titulo);
                $('#btn-mais-produto').css('display', 'block');
                armazenarLista('lista', data.response.sucesso.message.produtos);
                appendProduto('#listProduto', data.response.sucesso.message.produtos);
                preencherComboCategoria(data.response.sucesso.message.categorias);
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

function appendProduto(idHtml, produto) {

    if (produto.length > 0) {       
        for (var i = 0; i < produto.length; i++) {
            card_produto = '';
            card_produto = card_produto + '<div class="column">' +
                '<div class="card" style="box-shadow: 0 0px 0px #ffffff00">' +
                '<div class="card-image">' +
                '<figure class="card-home-medium">';
            if (produto[i].IN_PROMOCAO == 1) {
                card_produto = card_produto + '<div class="container" style="position:absolute; left:20px; width:106px;height:32px;background-color:#FFE500;z-index: 1;">' +
                    '<p class="subtitle is-danger is-6" style="position:absolute; top:8px;right:15px;width:75px;font-weight:bold;">OFERTAS</p>' +
                    '</div>';
            }
            card_produto = card_produto + '<div class="container" style="position:absolute; left:270px; width:106px;height:32px;z-index: 1;top: 5px;">' +
                '<a class="button gradiente"><img style="height:27x; width:30px" src="css\\img\\icons8-favorite-60.png"></a>' +
                '</div>' +
                '<img src="'+ produto[i].DS_FOTO_ANUNCIO_PRODUTO +'" style="filter: brightness(60%);border-radius: 8px;width: 350px;height: 158px;" alt="Placeholder image">' +
                '</figure>' +
                '</div>' +
                '<div class="card-content" style="position:absolute;top:100px;left:14px">' +
                '<p class="subtitle is-bold is-6 is-left" style="color: white;margin-bottom: 0.5rem;">'+ produto[i].DS_PRODUTO +'</p>';
            if (produto[i].IN_PROMOCAO == 1) {
                card_produto = card_produto + '<font class="subtitle is-8 is-danger" style="color: white;"><strike>R$'+ produto[i].VL_PRODUTO_ANTIGO +'</strike></font>' +
                    '<font class="subtitle is-6" style="color: white;">R$'+ produto[i].VL_PRODUTO_UNITARIO +' / '+ produto[i].DS_UNIDADE_MEDIDA +'</font>';
            } else {
                card_produto = card_produto + '<font class="subtitle is-6" style="color: white;">R$'+ produto[i].VL_PRODUTO_UNITARIO +' / '+ produto[i].DS_UNIDADE_MEDIDA +'</font>';
            }
            card_produto = card_produto + '</div>' +
                '</div>' +
                '</div>';
            $(idHtml).append(card_produto);
        }
    } else {
        sessionStorage.setItem('numeroElementos', 0);
        warning('Não há mais registros de produtos!');
        $('#recarregar-pagina').css('display', 'block');
        $('#btn-mais-produto').css('display', 'none');
    }
}

function armazenarLista(tipoLista, listaProduto){
    sessionStorage.setItem(tipoLista, JSON.stringify(listaProduto));
}

function preencherComboCategoria(categorias){
    
    if (categorias.length > 0) {
        card_categoria = '';
        card_categoria = card_categoria + '<option id="-1">Selecione</option>';                       
        for (var i = 0; i < categorias.length; i++) {            
            card_categoria = card_categoria + '<option value='+categorias[i].ID_CATEGORIA_PRODUTO+'>'+  categorias[i].DS_CATEGORIA_PRODUTO +'</option>';                       
        }
    } else {        
        card_categoria = card_categoria + '<option id="0">Sem registros!</option>';                   
    }  
    $('#categoria1').append(card_categoria);
    $('#categoria2').append(card_categoria);
    $('#categoria3').append(card_categoria);
}

function pesquisar() {

    var ID_CATEGORIA_1 = $('#categoria1').val();
    var ID_CATEGORIA_2 = $('#categoria2').val();
    var ID_CATEGORIA_3 = $('#categoria3').val();

    if(validarCategoriaPesquisa(ID_CATEGORIA_1, ID_CATEGORIA_2, ID_CATEGORIA_3)) {
        warning('Selecione ao menos uma categoria!');
        return false;
    }

    var VL_PRECO = $('#price-max').val(); 
    
    //mandar um array
    //colocar categoria na session storage

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/pesquisar',
        dataType: "json",
        data: { 
            "ID_CATEGORIA_1": ID_CATEGORIA_1,
            "ID_CATEGORIA_2": ID_CATEGORIA_2,
            "ID_CATEGORIA_3": ID_CATEGORIA_3,
            "VL_PRECO": VL_PRECO
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.message) {
                error(data.response.erro.message);
            } else {
                //posteriormente implementar JWT 
                //colocar categorias no cache
                var pagina = sessionStorage.getItem('pagina');
                if(pagina == 'promocao') {
                    $('#listPromocao').empty();
                    $('#btn-mais-promocao').css('display', 'none');
                    appendPromocao('#listPromocao', data.response.sucesso.message.produtos);
                } else if(pagina == 'produto') {
                    $('#listProduto').empty();
                    $('#btn-mais-produto').css('display', 'none');
                    appendProduto('#listProduto', data.response.sucesso.message.produtos);   
                }                
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

function validarCategoriaPesquisa(categoria1, categoria2, categoria3) {

    if(categoria1 == "Selecione" && categoria2 == "Selecione" && categoria3 == "Selecione"){
        return true
    }
    return false;
}

//colocar nos utils
function recarregarPagina() {
    location.reload();
}

function ordenarProdutos(tipoOrdenacao) {
    switch (tipoOrdenacao) {
        case 'barato':
            var listaProduto = JSON.parse(sessionStorage.getItem('lista'));
            listaProduto = listaProduto.sort((a, b) => (a.VL_PRODUTO_UNITARIO > b.VL_PRODUTO_UNITARIO ? 1 : -1))
            //chamar append
            break;
        case 'caro':
            break;
        case 'vendido':          
            break;
        case 'AZ':          
            break;
        case 'ZA':          
            break;
        default:
    }
}

function pesquisarIndex() {   
    if(window.location.pathname == '/clubeatacado/home') {
        window.location.href = '/clubeatacado/pesquisa';
        return false;
    }

    var DS_INPUT_PESQUISA = $('#inputPesquisa').val();

    if(DS_INPUT_PESQUISA == '') {
        warning('Campo de pesquisa vazio!');
        return false;
    }

    var pagina = sessionStorage.getItem('pagina');
    switch (pagina) {
        case 'categoria':                    
            pesquisarCategorias(DS_INPUT_PESQUISA);
            break;
        case 'promocao':
            pesquisarProdutos(DS_INPUT_PESQUISA);
            break; 
        case 'produto':
            pesquisarProdutos(DS_INPUT_PESQUISA);
            break;      
        default:
    }
}

function pesquisarCategorias(DS_INPUT_PESQUISA) {
  
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/pesquisarCategoria',
        dataType: "json",
        data: { 
            "DS_INPUT_PESQUISA": DS_INPUT_PESQUISA
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.message) {
                error(data.response.erro.message);
            } else {              
                $('#listCategoria').empty();    
                $('#btn-mais-categoria').css('display', 'none');          
                appendCategoria('#listCategoria', data.response.sucesso.message.categorias);             
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

function pesquisarProdutos(DS_INPUT_PESQUISA) {
  
    //implementar logica de só retornar valor para promoção se for promoção mesmo
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/pesquisarProdutoInput',
        dataType: "json",
        data: { 
            "DS_INPUT_PESQUISA": DS_INPUT_PESQUISA
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.message) {
                error(data.response.erro.message);
            } else {
                //posteriormente implementar JWT 
                //colocar categorias no cache
                var pagina = sessionStorage.getItem('pagina');
                if(pagina == 'promocao') {
                    $('#listPromocao').empty();
                    $('#btn-mais-promocao').css('display', 'none');
                    appendPromocao('#listPromocao', data.response.sucesso.message.produtos);
                } else if(pagina == 'produto') {
                    $('#listProduto').empty();
                    $('#btn-mais-produto').css('display', 'none');
                    appendProduto('#listProduto', data.response.sucesso.message.produtos);   
                }                
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}



