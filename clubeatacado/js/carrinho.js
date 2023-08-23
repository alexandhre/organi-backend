function deletarProdutoCarrinho(idAnuncioProduto) {
    var myFormData = new FormData();
    myFormData.append('idAnuncioProduto', idAnuncioProduto);
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/deletarProdutoCarrinho',
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data, textStatus, jqXHR) {
            if (data.response.sucesso.message.error) {
                //limpar formulario
                error('Erro ao deletar produto do carrinho, entre em contato com o suporte!');
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
