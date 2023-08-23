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

    if (!validarSenha(DS_SENHA)) {       
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

                window.location.href = '/clubeatacado/home';
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) { 
            //limpar formulario           
            tratarErro(XMLHttpRequest,XMLHttpRequest.responseJSON.response.erro.message);
        }
    });

}

//colocar no arquivo utils
function validarEmail(email) {

    var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
    if (!reg.test(email)) {
        warning('Email Inválido!');
        $("#email").focus();
        return false;
    }
    return true;
}

//colocar no arquivo utils
function validarSenha(senha) {

    // if (senha.length < 8) {
    //     warning('Senha Inválida!');
    //     $("#password").focus();
    //     return false;
    // }
    return true;
}

/**
 * Tratar retorno API
 */ 
 function tratarErro(jqXHR, message){
	
	if (JSON.stringify(jqXHR.status) === 0) {
        alert('Não conectado. Por favor, verifique sua conexão com a rede/internet.');        
	}  else if (JSON.stringify(jqXHR.status) == 400) {
        error(message);        	    
	} else if (JSON.stringify(jqXHR.status) == 401) { 
        error('Sua sessão expirou. faça login novamente para continuar.');	    
		sessionStorage.clear();
		window.location.href = "/clubeatacado/login";
	} else if (JSON.stringify(jqXHR.status) == 404) {
        alert('Erro 404 - Serviço não encontrado. Caso o problema persistir solicite ajuda ao administrador do sistema.'); 		
	} else if (JSON.stringify(jqXHR.status) == 500) {
        error('Erro 500 (Internal Server Error). Caso o problema persistir solicite ajuda ao administrador do sistema.');             
	} else if (JSON.stringify(jqXHR.statusText) === 'parsererror') {
        alert('A análise JSON solicitada falhou. Caso o problema persistir solicite ajuda ao administrador do sistema.'); 		
	} else if (JSON.stringify(jqXHR.statusText) === 'timeout') {
        alert('Time out error. Caso o problema persistir solicite ajuda ao administrador do sistema.'); 		
	} else if (JSON.stringify(jqXHR.statusText) === 'abort') {
        alert('Ajax request aborted. Caso o problema persistir solicite ajuda ao administrador do sistema.'); 		
	} else {
        alert('Ocorreu um erro interno no Servidor Web Caso o problema persistir solicite ajuda ao administrador do sistema. \n' + JSON.stringify(jqXHR.statusText)); 		
	}
	
}