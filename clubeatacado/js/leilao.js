function validarTags(nome) {
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

function abrirDetalheLeilao(idLeilao) {
    sessionStorage.setItem('idLeilao', idLeilao);
    window.location.href = "/clubeatacado/detalheLeilao";
}

function recuperarDetalheLeilao() {
    var idLeilao = sessionStorage.getItem('idLeilao');
    var myFormData = new FormData();
    myFormData.append('idLeilao', idLeilao);
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/recuperarDetalheLeilao',
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
                sessionStorage.setItem('idLeilao', data.response.sucesso.message.leilao[0].ID_LEILAO);
                appendDetalheLeilao(data.response.sucesso.message.leilao);
                appendLeiloes('#listLeiloes', data.response.sucesso.message.leiloes);
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

function appendLeiloes(idHtml, leiloes) {

    if (leiloes.length > 0) {
        for (var i = 0; i < leiloes.length; i++) {
            card_leiloes = '';
            card_leiloes = card_leiloes + ' <a onclick="abrirDetalheLeilao(' + leiloes[i].ID_LEILAO + ')" href="#">' +
                '<div class="column">' +
                '<div class="card">' +
                '<div class="card-image" style="height: 288px; width: 350px;">' +
                '<figure class="image">' +
                '<img src="' + leiloes[i].DS_FOTO_PRODUTO + '" style="height: 288px; width: 350px;" alt="Placeholder image">' +
                '</figure>' +
                '</div>' +
                '<div class="card-content">' +
                '<div class="content">' +
                '<article class="media">' +
                '<div class="media-content">' +
                '<div class="field">' +
                '<p class="control has-icon-right">';
                if (leiloes[i].IN_LEILAO == 1) {
                    card_leiloes = card_leiloes + '<p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffc1077a;color:#000000;padding:5px">' + 
                        'Encerra em ' + leiloes[i].VL_DIAS_FALTANTES + ' dias 🔥' +
                    '</p>';                            
                } else if (leiloes[i].IN_LEILAO  == 0) {
                    card_leiloes = card_leiloes + '<p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ffcccc;color:#000000;padding:5px">' +
                        'Leilão Encerrado 🔥 </p>' +
                    '</p>';                
                } else if (leiloes[i].IN_LEILAO  == 2){
                    card_leiloes = card_leiloes + '<p class="subtitle is-8 is-bold" style="width: max-content;height: 24px;border-radius:12px;background-color:#ccffdc;color:#000000;padding:5px">' +
                        'Leilão começa em ' + leiloes[i].VL_DIAS_FALTANTES + ' dias🔥 </p>' +
                    '</p>';          
                }                
                card_leiloes = card_leiloes + '</p>' +
                '<p class="control">' +
                '<p class="subtitle is-5 is-left">' + leiloes[i].DS_ANUNCIO_PRODUTO + '</p>' +
                '</p>' +
                '<p class="control">' +
                '<p class="subtitle is-7 is-left" style="color: #808080;">Preço atual</p>' +
                '</p>' +
                '<p class="control">' +
                '<p class="subtitle is-2 is-left is-bold" style="width: 188px;color: #17B330;">R$ ' + leiloes[i].VL_PRECO_INICIAL + '</p>' +
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
            $(idHtml).append(card_leiloes);
        }
    } else {
        sessionStorage.setItem('numeroElementos', 0);
        warning('Não há mais registros relacionados de leilão!');
    }
}

function appendDetalheLeilao(leilao) {

    if (leilao.length > 0) {               
        $('#loja').text(leilao[0].DS_LOJA);
        $('#vendedor').text(leilao[0].DS_VENDEDOR);
        $('#descricao').text(leilao[0].DS_DETALHE_PRODUTO);
        $('#identificacao').text(leilao[0].DS_IDENTIFICACAO);
        $('#info').text(leilao[0].DS_INFORMACOES);
        $('#condicoesGerais').text(leilao[0].DS_CONDICOES_GERAIS);
        $('#acessorios').text(leilao[0].DS_ACESSORIOS);
        $('#lances').text(leilao[0].QTD_LANCES + ' propostas recebidas 🔥');
        $('#tituloLeilao').text(leilao[0].DS_ANUNCIO_PRODUTO);
        $('#descLeilao').text(leilao[0].DS_DETALHE_PRODUTO);
        moment.locale('pt');
        var dataAtual = moment(new Date());
        var inicio = moment(leilao[0].DT_INICIO);//now
        var fim = moment(leilao[0].DT_FIM);  

        var duracaoInicio = moment.duration(dataAtual.diff(inicio));
        var diasInicio = duracaoInicio.asDays();

        var duracaoFim = moment.duration(dataAtual.diff(fim));
        var diasFim = duracaoFim.asDays();

        if(diasInicio > 0 && diasFim < 0){
            $('#dt_fim_leilao').css('background-color', '#ffc1077a');
            sessionStorage.setItem('dtFim', leilao[0].DT_FIM);
            $('#expira').text('Expira em: ');
            $('#dt_fim_leilao').text('O leilão finaliza em ' + moment(leilao[0].DT_FIM).format('LLL') + ' ');    
            $("#myBtn").css("display","block");        
        } else if(diasInicio < 0 && diasFim < 0){
            $('#dt_fim_leilao').css('background-color', '#ccffdc');
            sessionStorage.setItem('dtFim', leilao[0].DT_INICIO);
            $('#expira').text('Começa em: ');
            $('#dt_fim_leilao').text('O leilão começa em ' + moment(leilao[0].DT_INICIO).format('LLL') + ' ');            
        } else if(diasInicio > 0 && diasFim > 0){
            sessionStorage.setItem('dtFim', leilao[0].DT_FIM);
            $('#dt_fim_leilao').css('background-color', '#ffcccc');
            $('#dt_fim_leilao').text('O leilão finalizou em ' + moment(leilao[0].DT_FIM).format('LLL') + ' ');            
        }              
        countdown();
        var VL_LANCE_MAIOR = leilao[0].VL_LANCE_MAIOR == null || leilao[0].VL_LANCE_MAIOR == '' ? '0,00' : leilao[0].VL_LANCE_MAIOR;
        $('#maiorValorLance').text('R$ ' + VL_LANCE_MAIOR);
    }
}

function countdown() {

    var dtFim = sessionStorage.getItem('dtFim');
    var now = new Date();
    // Altere a data do seu evento aqui
    var eventDate = new Date(dtFim);
    var currentTiime = now.getTime();
    var eventTime = eventDate.getTime();
    var remTime = eventTime - currentTiime;
    // calculando o dia, hora, minuto e segundo
    var d = Math.floor(remTime / (1000 * 60 * 60 * 24));
    var h = Math.floor((remTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var m = Math.floor((remTime % (1000 * 60 * 60)) / (1000 * 60));
    var s = Math.floor((remTime % (1000 * 60)) / 1000);
    document.getElementById("days").textContent = d;
    document.getElementById("days").innerText = d;
    document.getElementById("hours").textContent = h;
    document.getElementById("minutes").textContent = m;
    document.getElementById("seconds").textContent = s;
    setTimeout(countdown, 1000);

    // Verifica se acabou o período do evento
    if (remTime < 0) {
        clearInterval(countdown);
        //document.getElementById("demogrande").innerHTML = "<small>Leilão Expirado</small>";
        document.getElementById("days").innerHTML = "00";
        document.getElementById("hours").innerHTML = "00";
        document.getElementById("minutes").innerHTML = "00";
        document.getElementById("seconds").innerHTML = "00";        
    }
}

function enviarLanceLeilao() {
    if ($('#inputLance').val() == '') {
        warning('Digite o valor do lance!');
        return false;
    }
    var myFormData = new FormData();
    myFormData.append('lance', $('#inputLance').val()); 
    myFormData.append('idLeilao', sessionStorage.getItem('idLeilao'));
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/enviarLanceLeilao',
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.response.sucesso.message.error) {
                //limpar formulario
                error('Erro ao enviar o lance do leilão, entre em contato com o suporte!');
            } else {
                success(data.response.sucesso.message.message);
                $('#close').click();                
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //limpar formulario           
            tratarErro(XMLHttpRequest, XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

function deletarProduto(idAnuncioProduto) {
    var myFormData = new FormData();
    myFormData.append('idAnuncioProduto', idAnuncioProduto);
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/deletarProduto',
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.response.sucesso.message.error) {
                //limpar formulario
                error('Erro ao deletar produto, entre em contato com o suporte!');
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