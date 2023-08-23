

//colocar no arquivo utils
function validarEmail(email) {

    var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
    if (!reg.test(email)) {
        warning('Email Inválido!');
        $("#email").focus();
        return false;
    }
}

//colocar no arquivo utils
function validarTamanhoSenha(senha) {

    if (senha.length < 8) {
        warning('Senha Inválida!');
        $("#senha").focus();
        return false;
    }
}

function validarSenhas(senha, confirmarSenha) {

    if (confirmarSenha != '' && senha != confirmarSenha) {
        warning('Senhas não conferem!');
        $("#senha").focus();
        return false;
    }
}

//colocar no arquivo utils
function validarTermoDeUso(IN_TERMOS) {

    if (!IN_TERMOS) {
        warning('Para continuar leia e aceite os termos de uso!');
        $("#termos").focus();
        return false;
    }
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