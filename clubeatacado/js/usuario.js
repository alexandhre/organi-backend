function login() {

    if ($("#email").val() === '') {
        warning('É necessário informar o email!');
        $("#email").focus();
        return false;
    }

    DS_EMAIL = $("#email").val();
    DS_SENHA = $("#password").val();

    if (!validarEmail(DS_EMAIL)) {       
        return false;
    }

    if (!validarTamanhoSenha(DS_SENHA)) {       
        return false;
    }

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/login',
        dataType: "json",
        data: { "email": DS_EMAIL, "password": DS_SENHA},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {           
            if (data.message) {
                //limpar formulario
                error(data.response.erro.message);
            } else {
                //posteriormente implementar JWT               
                var dataBase64 = btoa(data.response.sucesso.message);
                sessionStorage.setItem('tend-compr', dataBase64); 

                window.location.href = '/home';
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) { 
            //limpar formulario           
            tratarErro(XMLHttpRequest,XMLHttpRequest.responseJSON.response.erro.message);
        }
    });

}

function cadastrar() {

    if ($("#nome").val() === '') {
        alert('É necessário informar o nome!');
        $("#nome").focus();
        return false;
    }

    DS_NOME = $("#nome").val();

    if ($("#email").val() === '') {
        alert('É necessário informar o email!');
        $("#email").focus();
        return false;
    }
    DS_EMAIL = $("#email").val();

    if ($("#senha").val() === '') {
        alert('É necessário informar a senha!');
        $("#senha").focus();
        return false;
    }

    DS_SENHA = $("#senha").val();
    DS_CONFIRMAR_SENHA = $("#confirmarSenha").val();
    IN_TERMOS = $('#termos').is(":checked");
    IN_COMPRADOR = $('#comprador').is(":checked");
    IN_FORNECEDOR = $('#fornecedor').is(":checked");

    validarEmail(DS_EMAIL);
    validarTamanhoSenha(DS_SENHA);
    validarSenhas(DS_SENHA, DS_CONFIRMAR_SENHA);
    validarTermoDeUso(IN_TERMOS);

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/register',
        dataType: "json",
        data: {
            "DS_NOME": DS_NOME,
            "DS_EMAIL": DS_EMAIL,
            "DS_SENHA": DS_SENHA,
            "IN_TERMOS": IN_TERMOS,
            "IN_COMPRADOR": IN_COMPRADOR,
            "IN_FORNECEDOR": IN_FORNECEDOR
        },
        success: function(data, textStatus, jqXHR) {
            //grecaptcha.reset();           
            if (data.response.erro) {                
                error(data.response.erro.message);
                //limpar formulario
            } else {
                success("Usuário cadastrado com sucesso!");
                var dataBase64 = btoa(data.response.sucesso.message);
                sessionStorage.setItem('tend-compr', dataBase64); 
                window.location.href = '/validarUsuario';
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            //limpar formulario
            tratarErro(XMLHttpRequest,XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}

function resetarSenha() {

    if ($("#email").val() === '') {
        warning('É necessário informar o email!');
        $("#email").focus();
        return false;
    }
    DS_EMAIL = $("#email").val();

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/enviarEmailRecuperarSenha',
        dataType: "json",
        data: {   
            "DS_EMAIL": DS_EMAIL
        },
        success: function(data, textStatus, jqXHR) {
            //grecaptcha.reset();           
            if (data.response.erro) {                
                error(data.response.erro.message);
                //limpar formulario
            } else {
                success("E-mail enviado com sucesso!");
                window.location.href = '/clubeatacado/login';
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            //limpar formulario
            tratarErro(XMLHttpRequest,XMLHttpRequest.responseJSON.response.erro.message);
        }
    });
}