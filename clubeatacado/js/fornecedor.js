function uploadArquivo(inputfiles, tipoOperacao) {      
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
        const fileSize = inputfiles[i].size / 1024 / 1024; // in MiB
        if (fileSize > 15) {
            warning('Arquivo tem que ser menor que 15 MB');
            return false;
        }
    }    
    var uploadingFiles = [];
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: "POST",
        url: '/clubeatacado/uploadImage',      
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
                        $('#logotipo').val(data.responseFotos.fotos[i]);
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