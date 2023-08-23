/**
 * Controler das mensagens de sistema
 */
iziToast.settings({
    timeout: 4000, // default timeout
    resetOnHover: true,
    // icon: '', // icon class
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
    onOpen: function () {
      console.log('callback abriu!');
    },
    onClose: function () {
      console.log("callback fechou!");
    }
});

function info(message){
    iziToast.info({
        position: "topCenter",
        title: 'Informação',
        message: message,
    });
}

function success(message){
    
    iziToast.success({
        position: "topCenter",
        title: '',
        message: message,
    });

}

function warning(message){
    
    iziToast.warning({
        position: "topCenter",
        title: 'Atenção!',
        message: message,
    });

}

function error(message){
    
    iziToast.error({
        position: "topCenter",
        title: 'Erro!',
        message: message,
    });

}


function formatarRealtoNumber(valorString){
     
    var compativelComParseFloat = valorString.replaceAll(".","");    
    compativelComParseFloat = compativelComParseFloat.replace(",",".");    
    var valor = parseFloat(compativelComParseFloat);      
    return valor;

}

/**
 * Tratar retorno API
 */ 
function tratarErro(jqXHR){
	
	if (JSON.stringify(jqXHR.status) === 0) {
        alert('Não conectado. Por favor, verifique sua conexão com a rede/internet.');        
	}  else if (JSON.stringify(jqXHR.status) == 400) {
        alert(JSON.stringify(jqXHR.responseJSON.message));	    
	} else if (JSON.stringify(jqXHR.status) == 401) { 
	    alert('Sua sessão expirou. faça login novamente para continuar.');						
		sessionStorage.clear();
		window.location.href = "index.html";
	} else if (JSON.stringify(jqXHR.status) == 404) {
        alert('Erro 404 - Serviço não encontrado. Caso o problema persistir solicite ajuda ao administrador do sistema.'); 		
	} else if (JSON.stringify(jqXHR.status) == 500) {
        alert('Erro 500 (Internal Server Error). Caso o problema persistir solicite ajuda ao administrador do sistema.');         
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


function validaEmail2(email) {


    var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
    if (reg.test(email)){
        //alert('validado');
        return true; }

    else{
        //    alert('nao validado');
        return false;
    }

}


function validaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}
