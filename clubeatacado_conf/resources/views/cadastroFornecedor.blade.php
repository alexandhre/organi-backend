@extends('layouts.site')
@include('layouts\_includes\topoFornecedor')

@section('content')
<section class="section">
    <div class="container has-text-left">
        <p class="titulos-1" style="font-size:24px;width: 379px;">Cadastramento de Fornecedores</p>
        <p class="textos-1" style="font-size:18px;width: 627px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Maecenas varius tortor nibh, sit amet tempor nibh finibus et.</p>
    </div>
    <br>

    <div class="container has-text-left">
    <div class="columns" style="padding-bottom: 100px;">
            <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                <div class="card" style="width: 1110px;margin-top: 20px">
                    <div class="card-content">
                        <div class="field has-text-centered" style=" background:#fafafa; margin-top: 24px">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Logotipo</label>
                            <img id="imageLogotipoPreview" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">                           
                            <div class="card-content col-md-12" style="clear: both;">
                                <div class="field has-text-centered" style="margin-top: 24px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imageLogotipo">
                                        <label class="custom-file-label" for="customFile">Anexar documento</label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="columns" style="padding-bottom: 680px;">
            <form class="column" method="post" action="{{ route('atualizarProdutor') }}">
                @csrf
                <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                    <input hidden type="text" name="logotipo" id="logotipo" class="custom-file-input" id="imageLogotipo">
                    <div class="card">
                        <div class="card-content">
                            <div class="form-group">
                                <label for="categoriaEmpresa">Categoria Empresa</label>
                                <select name="categoriaEmpresa" id="categoriaEmpresa" class="custom-select custom-select-sm">
                                    <option selected>Selecione</option>
                                    @foreach ($categorias as $categoria)
                                    @if($categoria->ID_CATEGORIA_EMPRESA == $dadosUsuario[0]->ID_CATEGORIA_EMPRESA)
                                    <option selected value="{{$categoria->ID_CATEGORIA_EMPRESA}}">{{$categoria->DS_CATEGORIA_EMPRESA}}</option>
                                    @else
                                    <option value="{{$categoria->ID_CATEGORIA_EMPRESA}}">{{$categoria->DS_CATEGORIA_EMPRESA}}</option>
                                    @endif
                                    @endforeach                                                                     
                                </select>
                                @if($errors->has('categoriaEmpresa'))
                                    <div style="color:red;" class="error">Selecione uma categoria!</div>
                                    @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="tipoNegocio">Tipo Negócio</label>
                                <select name="tipoNegocio" id="tipoNegocio" class="custom-select custom-select-sm">
                                    <option selected>Selecione</option>
                                    @foreach ($tipoNegocioLista as $tipoNegocio)
                                    @if($tipoNegocio->ID_TIPO_NEGOCIO == $dadosUsuario[0]->ID_TIPO_NEGOCIO)
                                    <option selected value="{{$tipoNegocio->ID_TIPO_NEGOCIO}}">{{$tipoNegocio->DS_TIPO_NEGOCIO}}</option>
                                    @else
                                    <option value="{{$tipoNegocio->ID_TIPO_NEGOCIO}}">{{$tipoNegocio->DS_TIPO_NEGOCIO}}</option>
                                    @endif
                                    @endforeach                                   
                                </select>
                                @if($errors->has('tipoNegocio'))
                                    <div style="color:red;" class="error">Selecione um tipo de negócio!</div>
                                    @endif
                            </div>
                            <br>
                            <div class="field has-text-left">
                                <label for="cnpj" class="label" style="color:#525763; font-weight:normal">CNPJ</label>
                                <div class="control">
                                    <input value="12121212121212" class="input" style="border-color:#8f8f8f;font-size: 16px; width:445px" type="text" name="cnpj" id="cnpj" value="{{$dadosUsuario[0]->NR_CNPJ}}" placeholder="Digite o CNPJ">
                                    @if($errors->has('cnpj'))
                                    <div style="color:red;" class="error">{{ $errors->first('cnpj') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="field has-text-left">
                                <label for="razaoSocial" class="label" style="color:#525763; font-weight:normal">Razão Social</label>
                                <div class="control">
                                    <input value="Razao" class="input" style="font-size: 16px; width:445px" type="text" name="razaoSocial" id="razaoSocial" value="{{$dadosUsuario[0]->DS_RAZAO_SOCIAL}}" placeholder="Escrever Informação">
                                    @if($errors->has('razaoSocial'))
                                    <div style="color:red;" class="error">{{ $errors->first('razaoSocial') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="field has-text-left">
                                <label for="nomeFantasia" class="label" style="color:#525763; font-weight:normal">Nome Fantasia</label>
                                <div class="control">
                                    <input value="Nome" class="input" style="font-size: 16px; width:445px" type="text" name="nomeFantasia" id="nomeFantasia" value="{{$dadosUsuario[0]->DS_NOME_FANTASIA}}" placeholder="Escrever Informação">
                                    @if($errors->has('nomeFantasia'))
                                    <div style="color:red;" class="error">{{ $errors->first('nomeFantasia') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="field has-text-left">
                                <label for="telefone" class="label" style="color:#525763; font-weight:normal">Celular</label>
                                <div class="control">
                                    <input value="12121212121212" class="input" style="font-size: 16px; width:445px" type="text" name="telefone" id="telefone" value="{{$dadosUsuario[0]->DS_TELEFONE}}" placeholder="Escrever Informação">
                                    @if($errors->has('telefone'))
                                    <div style="color:red;" class="error">{{ $errors->first('telefone') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="field has-text-left">
                                <label for="telefoneComercial" class="label" style="color:#525763; font-weight:normal">Telefone Comercial</label>
                                <div class="control">
                                    <input value="12121212121212" class="input" style="font-size: 16px; width:445px" type="text" name="telefoneComercial" id="telefoneComercial" value="{{$dadosUsuario[0]->DS_TELEFONE_COMERCIAL}}" placeholder="Escrever Informação">
                                    @if($errors->has('telefoneComercial'))
                                    <div style="color:red;" class="error">{{ $errors->first('telefoneComercial') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="field has-text-left">
                                <label for="dtFundacaoNascimento" class="label" style="color:#525763; font-weight:normal">Data de Nascimento / Fundação</label>
                                COLOCAR DISCLAIMER
                                <div class="control">
                                    <input value="12121212121212" class="input" style="font-size: 16px; width:445px" type="text" name="dtFundacaoNascimento" id="dtFundacaoNascimento" value="{{$dadosUsuario[0]->DT_NASCIMENTO_FUNDACAO}}" placeholder="Escrever Informação">
                                    @if($errors->has('dtFundacaoNascimento'))
                                    <div style="color:red;" class="error">{{ $errors->first('dtFundacaoNascimento') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="field has-text-left">
                                <label for="qtdEmpregados" class="label" style="color:#525763; font-weight:normal">Quantidade de Empregados</label>                                
                                <div class="control">
                                    <input value="123" class="input" style="font-size: 16px; width:445px" type="text" name="qtdEmpregados" id="qtdEmpregados" value="{{$dadosUsuario[0]->QT_EMPREGADOS}}" placeholder="Escrever Informação">
                                    @if($errors->has('qtdEmpregados'))
                                    <div style="color:red;" class="error">{{ $errors->first('qtdEmpregados') }}</div>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

        </div>

        <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">

            <div class="card">
                <div class="card-content">
                    <div class="field has-text-left">
                        <label for="representanteLegal" class="label" style="color:#525763; font-weight:normal">Representante Legal</label>
                        <div class="control">
                            <input value="representante" class="input" style="font-size: 16px; width:445px" type="text" name="representanteLegal" id="representanteLegal" value="{{$dadosUsuario[0]->DS_NOME}}" placeholder="Escrever Informação">
                            @if($errors->has('representanteLegal'))
                            <div style="color:red;" class="error">{{ $errors->first('representanteLegal') }}</div>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="field has-text-left">
                        <label for="RGRepresentanteLegal" class="label" style="color:#525763; font-weight:normal">RG do Representente Legal</label>
                        <div class="control">
                            <input value="123333823" class="input" style="font-size: 16px; width:445px" type="text" name="RGRepresentanteLegal" id="RGRepresentanteLegal" value="{{$dadosUsuario[0]->NR_RG}}" placeholder="Escrever Informação">
                            @if($errors->has('RGRepresentanteLegal'))
                            <div style="color:red;" class="error">{{ $errors->first('RGRepresentanteLegal') }}</div>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="field has-text-left">
                        <label for="EnderecoRepresentanteLegal" class="label" style="color:#525763; font-weight:normal">Endereço do Representante Legal</label>
                        <div class="control">
                            <input value="endereco representante" class="input" style="font-size: 16px; width:445px" type="text" name="EnderecoRepresentanteLegal" id="EnderecoRepresentanteLegal" value="{{$dadosUsuario[0]->DS_ENDERECO}}" placeholder="Escrever Informação">
                            @if($errors->has('EnderecoRepresentanteLegal'))
                            <div style="color:red;" class="error">{{ $errors->first('EnderecoRepresentanteLegal') }}</div>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="field has-text-left">
                        <label for="CPFRepresentante" class="label" style="color:#525763; font-weight:normal">CPF do Representante Legal</label>
                        <div class="control">
                            <input value="221121212" class="input" style="font-size: 16px; width:445px" type="text" name="CPFRepresentante" id="CPFRepresentante" value="{{$dadosUsuario[0]->NR_CPF}}" placeholder="Escrever Informação">
                            @if($errors->has('CPFRepresentante'))
                            <div style="color:red;" class="error">{{ $errors->first('CPFRepresentante') }}</div>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="field has-text-left">
                        <label for="dtRepresentante" class="label" style="color:#525763; font-weight:normal">Data de Nascimento do Representante
                            Legal</label>
                        <div class="control">
                            <input value="123" class="input" style="font-size: 16px; width:445px" type="text" name="dtRepresentante" id="dtRepresentante" value="{{$dadosUsuario[0]->DT_NASCIMENTO}}" placeholder="Escrever Informação">
                            @if($errors->has('dtRepresentante'))
                            <div style="color:red;" class="error">{{ $errors->first('dtRepresentante') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>               
    </div>
    </div>    
    <div class="Rectangle" style="height: 16px; margin: 40px 0 48px; background-color: #f6f8f9;"></div>

    <div class="container has-text-left">
        <h1 class="titulos-1" style=" width: 489px;">Dados Fornecedor</h1>
        <br>
    </div>
    <div class="container">
        <div class="columns" style="padding-bottom: 460px;">

            <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">

                <div class="card">
                    <div class="card-content">
                        <div class="field has-text-left has-icon-right">
                            <label for="endereco" class="label" style="color:#525763; font-weight:normal">Endereço Completo</label>
                            <div class="control has-icon-right">
                            <input value="endereco" class="input" style="font-size: 16px; width:445px" type="text" name="endereco" id="endereco" value="{{$dadosUsuario[0]->DS_ENDERECO_PRODUTOR}}" placeholder="Escrever Informação">
                            @if($errors->has('endereco'))
                            <div style="color:red;" class="error">{{ $errors->first('endereco') }}</div>
                            @endif                              
                            </div>
                        </div>
                        <br>
                        <div class="field has-text-left has-icon-right">
                            <label for="nrEndereco" class="label" style="color:#525763; font-weight:normal">Numero Endereço</label>
                            <div class="control has-icon-right">
                            <input value="123" class="input" style="font-size: 16px; width:445px" type="text" name="nrEndereco" id="nrEndereco" value="{{$dadosUsuario[0]->NR_ENDERECO}}" placeholder="Escrever Informação">
                            @if($errors->has('nrEndereco'))
                            <div style="color:red;" class="error">{{ $errors->first('nrEndereco') }}</div>
                            @endif                              
                            </div>
                        </div>
                        <br>
                        <div class="field has-text-left has-icon-right">
                            <label for="complemento" class="label" style="color:#525763; font-weight:normal">Complemento</label>
                            <div class="control has-icon-right">
                            <input value="complemento" class="input" style="font-size: 16px; width:445px" type="text" name="complemento" id="complemento" value="{{$dadosUsuario[0]->DS_COMPLEMENTO}}" placeholder="Escrever Informação">
                            @if($errors->has('complemento'))
                            <div style="color:red;" class="error">{{ $errors->first('complemento') }}</div>
                            @endif                              
                            </div>
                        </div>
                        <br>
                        <div class="field has-text-left">
                            <label for="pontoReferencia" class="label" style="color:#525763; font-weight:normal">Ponto de Referência</label>
                            <div class="control">
                            <input value="ponto de referencia" class="input" style="font-size: 16px; width:445px" type="text" name="pontoReferencia" id="pontoReferencia" value="{{$dadosUsuario[0]->DS_PONTO_REFERENCIA}}" placeholder="Escrever Informação">
                            @if($errors->has('pontoReferencia'))
                            <div style="color:red;" class="error">{{ $errors->first('pontoReferencia') }}</div>
                            @endif   
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                                                        <label for="cidade">Cidade</label>
                                                        <select name="id_cidade" id="id_cidade" class="custom-select custom-select-sm">
                                                            <option selected>Selecione</option>
                                                            @foreach ($cidades as $cidade)                                                            
                                                            <option value="{{$cidade->ID_CIDADE}}">{{$cidade->DS_CIDADE}}</option>                                                          
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if($errors->has('id_cidade'))
                                    <div style="color:red;" class="error">Selecione uma cidade!</div>
                                    @endif
                        <br>
                        <div class="field has-text-left">
                            <label for="agricultor" class="label" style="color:#525763; font-weight:normal">Enquadramento como Agricultor
                                Familiar</label>
                            <div class="control">
                            <input value="enquadramento" class="input" style="font-size: 16px; width:445px" type="text" name="agricultor" id="agricultor" value="{{$dadosUsuario[0]->DS_ENQUADRAMENTO_AGRICULTOR}}" placeholder="Escrever Informação">
                            @if($errors->has('agricultor'))
                            <div style="color:red;" class="error">{{ $errors->first('agricultor') }}</div>
                            @endif   
                            </div>
                        </div>
                        <br>
                        <div class="field has-text-left">
                            <label for="incra" class="label" style="color:#525763; font-weight:normal">Inscrição no INCRA</label>
                            <div class="control">
                            <input value="544545" class="input" style="font-size: 16px; width:445px" type="text" name="incra" id="incra" value="{{$dadosUsuario[0]->DS_INSCRICAO_INCRA}}" placeholder="Escrever Informação">
                            @if($errors->has('incra'))
                            <div style="color:red;" class="error">{{ $errors->first('incra') }}</div>
                            @endif   
                            </div>
                        </div>
                        <br>
                        <div class="field has-text-left">
                            <label for="cooperativa" class="label" style="color:#525763; font-weight:normal">Participante de Associação ou
                                Cooperativa? </label>
                            <div class="control">
                            <input type="checkbox" name="cooperativa" id="cooperativa" value="{{$dadosUsuario[0]->IN_COOPERATIVA_ASSOCIACAO}}" placeholder="Escrever Informação">
                            @if($errors->has('cooperativa'))
                            <div style="color:red;" class="error">{{ $errors->first('cooperativa') }}</div>
                            @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">

                <div class="card">
                    <div class="card-content">
                        <div class="field has-text-left">
                            <label for="cep" class="label" style="color:#525763; font-weight:normal">CEP</label>
                            <div class="control">
                            <input value="544545" class="input" style="font-size: 16px; width:445px" type="text" name="cep" id="cep" value="{{$dadosUsuario[0]->NR_CEP}}" placeholder="Escrever Informação">
                            @if($errors->has('cep'))
                            <div style="color:red;" class="error">{{ $errors->first('cep') }}</div>
                            @endif
                            </div>
                        </div>
                        <br>                       
                        <div class="field has-text-left">
                            <label for="territorio" class="label" style="color:#525763; font-weight:normal">Território de Identidade</label>
                            <div class="control">
                            <input value="Territorio" class="input" style="font-size: 16px; width:445px" type="text" name="territorio" id="territorio" value="{{$dadosUsuario[0]->DS_TERRITORIO_IDENTIDADE}}" placeholder="Escrever Informação">
                            @if($errors->has('territorio'))
                            <div style="color:red;" class="error">{{ $errors->first('territorio') }}</div>
                            @endif
                            </div>
                        </div>
                        <br>
                        <div class="field has-text-left">
                                <label for="tamanhoFabrica" class="label" style="color:#525763; font-weight:normal">Tamanho Fábrica (área) m²</label>                                
                                <div class="control">
                                    <input value="321" class="input" style="font-size: 16px; width:445px" type="text" name="tamanhoFabrica" id="tamanhoFabrica" value="{{$dadosUsuario[0]->DS_TAMANHO_FABRICA}}" placeholder="Escrever Informação">
                                    @if($errors->has('tamanhoFabrica'))
                                    <div style="color:red;" class="error">{{ $errors->first('tamanhoFabrica') }}</div>
                                    @endif
                                </div>
                        </div>                      
                        <br>
                        <div class="field has-text-left">
                            <label for="declaracaoFornecedor" class="label" style="color:#525763; font-weight:normal">O Fornecedor se Declara</label>
                            <div class="control">
                            <input value="Fornecedor" class="input" style="font-size: 16px; width:445px" type="text" name="declaracaoFornecedor" id="declaracaoFornecedor" value="{{$dadosUsuario[0]->DS_DECLARACAO_PRODUTOR}}" placeholder="Escrever Informação">
                                    @if($errors->has('declaracaoFornecedor'))
                                    <div style="color:red;" class="error">{{ $errors->first('declaracaoFornecedor') }}</div>
                                    @endif
                            </div>
                        </div>
                        <br>
                        <div class="field has-text-left">
                            <label for="pronafDaf" class="label" style="color:#525763; font-weight:normal">Declaração de Aptidão ao PRONAF –
                                DAF</label>
                            <div class="control">
                            <input value="PRONAF" class="input" style="font-size: 16px; width:445px" type="text" name="pronafDaf" id="pronafDaf" value="{{$dadosUsuario[0]->DS_DECLARACAO_PRONAF_DAF}}" placeholder="Escrever Informação">
                                    @if($errors->has('pronafDaf'))
                                    <div style="color:red;" class="error">{{ $errors->first('pronafDaf') }}</div>
                                    @endif
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <div class="field is-grouped">
            <button type="submit" class="button is-success" style="margin-top: 80px;margin-bottom: 80px; width:350px; height: 48px;">FINALIZAR
                CADASTRO</button>

        </div>
        </form>
    </div>


</section>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        sessionStorage.setItem('uploading_files_logotipo', JSON.stringify([])); 
    });
    $("#imageLogotipo").change(function() {      
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imageLogotipoPreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        uploadArquivo(this.files, 'logotipo');       
    });     
</script>
<script>  
    function convertPHPtoJS() {
        return @json($statusCode);
    }
    var statusCode = convertPHPtoJS();
    if(statusCode == 201){
        success('Fornecedor cadastrado com sucesso!');
    } else if(statusCode == 501){
        warning(@json(isset($errorMessage)));
    } else if(statusCode !== 0){        
        warning('Erro ao cadastrar fornecedor, entre em contato com o suporte!');
    }    
</script>
@endsection