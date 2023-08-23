function cadastrarAnuncio() {
    var produtoNovo = false;
    var idProdutoNovo = 0;
    if($('#produtoNovo').attr('class') == 'collapse show'){
        produtoNovo = true;

        if($("#nomeProduto").val() == ''){
            warning('Escolha um nome para o produto!');
            return false;
        }

        if($("#tipo_produto").val() == 0){
            warning('Selecione um tipo de produto!');
            return false;
        }
    } else {
        idProdutoNovo = $("#produto_novo").val();
    }
    var uploading_files_anuncio = JSON.parse(sessionStorage.getItem('uploading_files_anuncio'));
    if(uploading_files_anuncio.length == 0){
        warning('Faça de upload de fotos para o anuncio do produto!');
        return false;
    }

    var uploading_files_anexo = JSON.parse(sessionStorage.getItem('uploading_files_anexo'));
    if(uploading_files_anexo.length == 0){
        warning('Faça de upload de anexos para o produto!');
        return false;
    }

    if($("#tagProduto").val() == ''){
        warning('Preencha o campo de tags no formato indicado!');
        return false;
    }

    var listaTags = $("#tagProduto").val().split(";");
    if(listaTags.length > 5){
        warning('O numero maximo de tags é 5!');
        return false;
    }

    for (var i = 0; i < listaTags.length; i++) {
        listaTags[i] = listaTags[i].trim();
        if(listaTags[i].length > 10){
            warning('Uma tag não pode ter mais de 10 caracteres!');
            return false;
        }
    }    

    if($("#tipo_anuncio").val() == 0){
        warning('Selecione um tipo de anuncio!');
        return false;
    }    

    if($("#leilao").prop("checked")){
        if($("#loja").val() == ''){
            $('#loja').focus();
            warning('Preencha o campo de loja!');
            return false;
        }

        if($("#vendedor").val() == ''){
            $('#vendedor').focus();
            warning('Preencha o campo de vendedor!');
            return false;
        }

        if($("#identificacao").val() == ''){
            $('#identificacao').focus();
            warning('Preencha o campo de identificação!');
            return false;
        }

        if($("#informacoes").val() == ''){
            $('#informacoes').focus();
            warning('Preencha o campo de informações!');
            return false;
        }

        if($("#condicoesGerais").val() == ''){
            $('#condicoesGerais').focus();
            warning('Preencha o campo de condições gerais!');
            return false;
        }

        if($("#acessorios").val() == ''){
            $('#acessorios').focus();
            warning('Preencha o campo de acessórios!');
            return false;
        }

        if($("#dt_inicio").val() == ''){
            $('#dt_inicio').focus();
            warning('Preencha o campo de data de inicio!');
            return false;
        }
       
        if($("#dt_fim").val() == ''){
            $('#dt_fim').focus();
            warning('Preencha o campo de data fim!');
            return false;
        }
    }

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/cadastrarAnuncio',
        dataType: "json",
        data: {
            "nomeProduto": $("#nomeProduto").val(),
            "produtoNovo": produtoNovo,
            "idProdutoNovo": idProdutoNovo,
            "tagProduto": $("#tagProduto").val(),
            "descricao": $("#descricao").val(),
            "tipo_anuncio": $("#tipo_anuncio").val(),
            "tipo_produto": $("#tipo_produto").val(),
            "codigo": $("#codigo").val(),
            "qtd_disponivel": $("#qtd_disponivel").val(),
            "qtd_minima": $("#qtd_minima").val(),
            "capacidade_fornecimento": $("#capacidade_fornecimento").val(),
            "unidade_medida": $("#unidade_medida").val(),
            "ncm_2017": $("#ncm_2017").val(),
            "cpc_21": $("#cpc_21").val(),
            "nome_cientifico": $("#nome_cientifico").val(),
            "icc_fao_2016": $("#icc_fao_2016").val(),
            "icc_fao_v1": $("#icc_fao_v1").val(),
            "fao_commodities": $("#fao_commodities").val(),
            "alteracoes_2018": $("#alteracoes_2018").val(),
            "cd_produto": $("#cd_produto").val(),
            "adulto": $("#adulto").prop("checked"),
            "infantil": $("#infantil").prop("checked"),
            "masculino": $("#masculino").prop("checked"),
            "feminino": $("#feminino").prop("checked"),
            "vl_unitario": $("#vl_unitario").val(),
            "vl_preco_antigo": $("#vl_preco_antigo").val(),
            "desconto": $("#desconto").val(),
            "altura_pacote": $("#altura_pacote").val(),
            "largura_pacote": $("#largura_pacote").val(),
            "comprimento_pacote": $("#comprimento_pacote").val(),
            "qtd_item_pacote": $("#qtd_item_pacote").val(),
            "peso_pacote": $("#peso_pacote").val(),
            "nome_pacote": $("#nome_pacote").val(),
            "transporte": $("#transporte").val(),
            "garantia": $("#garantia").val(),
            "promocao": $("#promocao").prop("checked"),
            "leilao": $("#leilao").prop("checked"),
            "uploading_files_anuncio": uploading_files_anuncio, 
            "uploading_files_anexo": uploading_files_anexo,
            "loja": $("#loja").val(),   
            "vendedor": $("#vendedor").val(),   
            "identificacao": $("#identificacao").val(),   
            "informacoes": $("#informacoes").val(),    
            "condicoesGerais": $("#condicoesGerais").val(),    
            "acessorios": $("#acessorios").val(),         
            "dt_inicio": $("#dt_inicio").val(),  
            "dt_fim": $("#dt_fim").val(),  
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.response.sucesso.message.error) {
                //limpar formulario
                error(data.response.sucesso.message.message);
            } else {
                success(data.response.sucesso.message.message);
                //location.reload();
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //limpar formulario           
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });

}

function validarTags(nome){
    return !!nome.match(/[a-z][a-z]*;[a-z]][a-z]*/);
}

function readURL(input, fieldSessionStorage, fieldImgSrc, tipoOperacao) {
    guardarImagensAnuncio(input.files, tipoOperacao);
    var qtd_images = sessionStorage.getItem(fieldSessionStorage);
    if (input.files && input.files.length == 1) {
        qtd_images = incrementQtdImages(qtd_images, fieldSessionStorage);
        setPreviewImage(input.files[0], qtd_images, fieldImgSrc);
    } else if (input.files.length > 1) {
        for (var i = 0; i < input.files.length; i++) {
            qtd_images = incrementQtdImages(qtd_images, fieldSessionStorage);
            setPreviewImage(input.files[i], qtd_images, fieldImgSrc);
        }
    }    
}

function incrementQtdImages(qtd_images, fieldSessionStorage) {
    qtd_images = parseInt(qtd_images) + 1;
    sessionStorage.setItem(fieldSessionStorage, qtd_images);
    return qtd_images;
}

function setPreviewImage(inputFile, qtd_images, fieldImgSrc) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#' + fieldImgSrc + qtd_images).attr('src', e.target.result);
    }
    reader.readAsDataURL(inputFile);
}

function guardarImagensAnuncio(inputfiles, tipoOperacao) {   
    //jogar isso num metodo e utilizar o padrão fail first
    for (var i = 0; i < inputfiles.length; i++) {
        if (inputfiles[i].type.match('image/png')
        || inputfiles[i].type.match('image/jpg')
        || inputfiles[i].type.match('image/jpeg')
        ) {
            var myFormData = new FormData();
            files = Object.values(inputfiles);
            files.forEach(function (file) {
                myFormData.append('myFiles[]', file);
            });           
        } else {
            error('Tipo de arquivo não suportado, apenas imagens do tipo PNG, JPG e JPEG são aceitas!');
            return false;
        }
    }    
    var uploadingFiles = JSON.parse(sessionStorage.getItem('uploading_files_' + tipoOperacao));
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/uploadImage',      
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {            
            if (data.responseFotos.erro) {
                //limpar formulario
                error('Erro ao enviar a(s) foto(s), tente novamente e caso o erro persista entre em contato com o suporte!');
            } else {
                if(data.responseFotos.fotos.length > 0){
                    for (var i = 0; i < data.responseFotos.fotos.length; i++) {
                        uploadingFiles.push(data.responseFotos.fotos[i]);
                    }
                    sessionStorage.setItem('uploading_files_' + tipoOperacao, JSON.stringify(uploadingFiles));
                }
                //success(data.response.sucesso.message.message);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //limpar formulario           
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    }); 
}

function editarAnuncio() {
    var uploading_files_anuncio = JSON.parse(sessionStorage.getItem('uploading_files_anuncio'));    

    var uploading_files_anexo = JSON.parse(sessionStorage.getItem('uploading_files_anexo'));

    if($("#tagProduto").val() == ''){
        warning('Preencha o campo de tags no formato indicado!');
        return false;
    }

    var listaTags = $("#tagProduto").val().split(";");
    if(listaTags.length > 5){
        warning('O numero maximo de tags é 5!');
        return false;
    }

    for (var i = 0; i < listaTags.length; i++) {
        listaTags[i] = listaTags[i].trim();
        if(listaTags[i].length > 10){
            warning('Uma tag não pode ter mais de 10 caracteres!');
            return false;
        }
    }

    var dt_inicio = 0;
    var dt_fim = 0;
    var propLeilao = $("#leilao").prop("checked");
    
    if($("#dt_inicio_dia").val() == '' && $("#dt_inicio_mes").val() == '' && $("#dt_inicio_ano").val() == ''){             
        dt_inicio = $('#dt_inicio').val();
    } else {
        if($("#dt_inicio_dia").val() > 31){
            $("#dt_inicio_dia").focus();
            warning('Não pode haver dia maior que 31!');
            return false;
        }
        if($("#dt_inicio_mes").val() > 12){
            $("#dt_inicio_mes").focus();
            warning('Não pode haver mês maior que 12!');
            return false;
        }    
        dt_inicio = $("#dt_inicio_dia").val() + "/" + $("#dt_inicio_mes").val() + "/" + $("#dt_inicio_ano").val();
    }

    if($("#dt_fim_dia").val() == '' && $("#dt_fim_mes").val() == '' && $("#dt_fim_ano").val() == ''){             
        dt_fim = $('#dt_fim').val();
    } else {
        if($("#dt_fim_dia").val() > 31){
            $("#dt_fim_dia").focus();
            warning('Não pode haver dia maior que 31!');
            return false;
        }
        if($("#dt_fim_mes").val() > 12){
            $("#dt_fim_mes").focus();
            warning('Não pode haver mês maior que 12!');
            return false;
        }    
        dt_fim = $("#dt_fim_dia").val() + "/" + $("#dt_fim_mes").val() + "/" + $("#dt_fim_ano").val();
    }

    if(!$("#leilao").prop("checked")){
        $("#loja").val('');
        $("#vendedor").val('');
        $("#identificacao").val('');
        $("#informacoes").val('');
        $("#condicoesGerais").val('');
        $("#acessorios").val('');
        $("#dt_inicio").val('NULL');
        $("#dt_fim").val('NULL');
    }
    
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/atualizarAnuncio',
        dataType: "json",
        data: {
            "nomeProduto": $("#nomeProduto").val(),            
            "idProduto": $("#idProduto").val(),
            "idAnuncio": $("#idAnuncio").val(),
            "idLeilaoProduto": $("#idLeilaoProduto").val(),
            "idLeilao": $("#idLeilao").val(),
            "tipo_produto": $("#tipo_produto").val(),
            "tagProduto": $("#tagProduto").val(),
            "descricao": $("#descricao").val(),
            "tipo_anuncio": $("#tipo_anuncio").val(),
            "codigo": $("#codigo").val(),
            "qtd_disponivel": $("#qtd_disponivel").val(),
            "qtd_minima": $("#qtd_minima").val(),
            "capacidade_fornecimento": $("#capacidade_fornecimento").val(),
            "unidade_medida": $("#unidade_medida").val(),
            "ncm_2017": $("#ncm_2017").val(),
            "cpc_21": $("#cpc_21").val(),
            "nome_cientifico": $("#nome_cientifico").val(),
            "icc_fao_2016": $("#icc_fao_2016").val(),
            "icc_fao_v1": $("#icc_fao_v1").val(),
            "fao_commodities": $("#fao_commodities").val(),
            "alteracoes_2018": $("#alteracoes_2018").val(),
            "cd_produto": $("#cd_produto").val(),
            "adulto": $("#adulto").prop("checked"),
            "infantil": $("#infantil").prop("checked"),
            "masculino": $("#masculino").prop("checked"),
            "feminino": $("#feminino").prop("checked"),
            "vl_unitario": $("#vl_unitario").val(),
            "desconto": $("#desconto").val(),
            "altura_pacote": $("#altura_pacote").val(),
            "largura_pacote": $("#largura_pacote").val(),
            "comprimento_pacote": $("#comprimento_pacote").val(),
            "qtd_item_pacote": $("#qtd_item_pacote").val(),
            "peso_pacote": $("#peso_pacote").val(),
            "nome_pacote": $("#nome_pacote").val(),
            "transporte": $("#transporte").val(),
            "garantia": $("#garantia").val(),
            "promocao": $("#promocao").prop("checked"),
            "leilao": propLeilao,
            "loja": $("#loja").val(),   
            "vendedor": $("#vendedor").val(),   
            "identificacao": $("#identificacao").val(),   
            "informacoes": $("#informacoes").val(),    
            "condicoesGerais": $("#condicoesGerais").val(),    
            "acessorios": $("#acessorios").val(),         
            "dt_inicio": dt_inicio,  
            "dt_fim": dt_fim,      
            "uploading_files_anuncio": uploading_files_anuncio, 
            "uploading_files_anexo": uploading_files_anexo,                    
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.response.sucesso.message.error) {
                //limpar formulario
                error(data.response.sucesso.message.message);
            } else {
                success(data.response.sucesso.message.message);
                location.reload();
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //limpar formulario           
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

//------------------------------------------------------------------------------------------------------//
//Detalhe Anuncio
function recuperarDetalheAnuncio() {
    var pathname = window.location.pathname; 
    const pathNameArray = pathname.split("/");
 
    var idAnuncio = pathNameArray[3];
    var myFormData = new FormData();
    myFormData.append('idAnuncio', idAnuncio);
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/recuperarDetalheAnuncio',
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.message) {
                //limpar formulario
                error('Erro ao enviar a(s) foto(s), tente novamente e caso o erro persista entre em contato com o suporte!');
            } else {
                sessionStorage.setItem('idAnuncio', data.response.sucesso.message.anuncio[0].ID_ANUNCIO_PRODUTO);
                appendDetalheAnuncio(data.response.sucesso.message.anuncio);
                appendAnuncios('#listAnuncios', data.response.sucesso.message.anuncios);
                appendFotos('#listFotos', '#listCurrentSlide', data.response.sucesso.message.fotos);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //limpar formulario           
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

let slideIndex = 1;
function appendFotos(idHtmlFotos, idHtmlCurrentSlide, fotos) {

    if (fotos.length > 0) {
        for (var i = 0; i < fotos.length; i++) {
            card_fotos = '';
            card_fotos = card_fotos + '  <div style="opacity: 1;" class="mySlides fade">' +
                '<div class="numbertext">' + (i + 1) + ' / ' + fotos.length + '</div>' +
                '<img src="' + fotos[i].DS_FOTO_ANUNCIO_PRODUTO + '" style="width:100%">' +
                '</div>';
            $(idHtmlFotos).append(card_fotos);
            card_current_slide = '';
            card_current_slide = card_current_slide + '<span class="dot" onclick="currentSlide(' + (i + 1) + ')"></span>';
            $(idHtmlCurrentSlide).append(card_current_slide);

        }
    }
    showSlides(slideIndex);
}

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

function abrirDetalheAnuncio(idAnuncio) {
    sessionStorage.setItem('idAnuncio', idAnuncio);
    window.location.href = "/detalheAnuncio";
}

function appendAnuncios(idHtml, anuncios) {

    if (anuncios.length > 0) {
        for (var i = 0; i < anuncios.length; i++) {
            card_anuncios = '';
            card_anuncios = card_anuncios + ' <a onclick="abrirDetalheAnuncio(' + anuncios[i].ID_ANUNCIO_PRODUTO + ')" href="#">' +
                '<div class="column">' +
                '<div class="card">' +
                '<div class="card-image" style="height: 288px; width: 350px;">' +
                '<figure class="image">' +
                '<img src="' + anuncios[i].DS_FOTO_PRODUTO + '" style="height: 288px; width: 350px;" alt="Placeholder image">' +
                '</figure>' +
                '</div>' +
                '<div class="card-content">' +
                '<div class="content">' +
                '<article class="media">' +
                '<div class="media-content">' +
                '<div class="field">' +
                '<p class="control has-icon-right">';
                '</p>' +
                '<p class="control">' +
                '<p class="subtitle is-5 is-left">' + anuncios[i].DS_ANUNCIO_PRODUTO + '</p>' +
                '</p>' +
                '<p class="control">' +
                '<p class="subtitle is-7 is-left" style="color: #808080;">Preço atual</p>' +
                '</p>' +
                '<p class="control">' +
                '<p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;">R$ ' + anuncios[i].VL_PRECO_INICIAL + '</p>' +
                '</p>' +
                '</div>' +
                '</div>' +
                '<div class="media-right" style="margin-left:0px;margin-top:16px;">' +
                '<nav class="level is-mobile">' +
                '<div class="level-left">' +
                '<a class="level-item">' +
                '<span class="icon"><img src="css\\img\\icons8-favorite-60.png"></span>' +
                '</a>' +
                '<a class="level-item">' +
                '<span class="icon"><img src="css\\img\\icons-general-share-32.png"></span>' +
                '</a>' +
                '</div>' +
                '</nav>' +
                '</div>' +
                '</article>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</a>';
            $(idHtml).append(card_anuncios);
        }
    } else {
        sessionStorage.setItem('numeroElementos', 0);
    }
}

function appendTags(anuncio){
    if (anuncio[0].DS_TAGS != null) {
        var card_tags = '';
        const tagsArray = anuncio[0].DS_TAGS.split(";");
        for(var i = 0; i < tagsArray.length; i++){
            card_tags = card_tags + '<div class="media-left" style="width: 81px;height: 22px;background-color:red;">'+
            '<span class="subtitle is-8" style="color:#ffffff;padding:8px">'+tagsArray[i]+'</span>'+
            '</div>';
        }
        $('#tags').append(card_tags);
    }
}

function appendDetalheAnuncio(anuncio) {

    if (anuncio.length > 0) {  
        appendTags(anuncio);
        $('#ds_produto').text(anuncio[0].DS_PRODUTO);
        $('#vl_produto').text('R$' + anuncio[0].VL_PRODUTO_UNITARIO);
        $('#descricao').text(anuncio[0].DS_DETALHE_PRODUTO);
        $('#desc').text(anuncio[0].DS_DETALHE_PRODUTO);
        $('#produtor').text(anuncio[0].DS_PRODUTOR);
        if(anuncio[0].VL_PRODUTO_ANTIGO != null){
            var card_detalhe_anuncio = '';
            card_detalhe_anuncio = card_detalhe_anuncio + ' <font class="subtitle is-6">Antes</font>';
            '<font idclass="subtitle is-8 is-danger"><strike>R$'+anuncio[0].VL_PRODUTO_ANTIGO+'</strike></font>';
            '<font class="subtitle is-8 is-danger" style="background-color:#ffe500;">10% de desconto</font>';
            $('#vl_antigo').append(card_detalhe_anuncio);
        }
        $('#info').text(anuncio[0].DS_INFORMACOES);
        $('#condicoesGerais').text(anuncio[0].DS_CONDICOES_GERAIS);
        $('#acessorios').text(anuncio[0].DS_ACESSORIOS);
        $('#lances').text(anuncio[0].QTD_LANCES + ' propostas recebidas 🔥');
        $('#tituloLeilao').text(anuncio[0].DS_ANUNCIO_PRODUTO);
        $('#descLeilao').text(anuncio[0].DS_DETALHE_PRODUTO);
    }
}