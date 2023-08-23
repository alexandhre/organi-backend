@extends('layouts.site')
@include('layouts\_includes\topoAnuncio')

@section('content')

<section class="section">
    <div class="container has-text-left">
        <h1 class="subtitle" style="width:447px;font-size:24px;font-weight:bold;text-align:left;">Subir novo produto
        </h1><br>
        <div class="columns">
            <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                <div class="card" style="width: 1110px;margin-top: 20px">
                    <div class="card-content">
                        <div class="field has-text-centered" style=" background:#fafafa; margin-top: 24px">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Pode subir
                                até 16 fotografias</label>
                            <img id="imagePreview1" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview2" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview3" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview4" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview5" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview6" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview7" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview8" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview9" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview10" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview11" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview12" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview13" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview14" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview15" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview16" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <div class="card-content col-md-12" style="clear: both;">
                                <div class="field has-text-centered" style="margin-top: 24px">
                                    <div class="custom-file">
                                        <input type="file" multiple class="custom-file-input" id="imgAnuncio">
                                        <label class="custom-file-label" for="customFile">Anexar documento</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field has-text-left" style="margin-top: 50px;line-height: 30px;">
                            <i class="fas fa-arrow-right" style="color: #17b330"></i><span class="subtitle is-7" style="color: #868C99;padding-left: 10px;">Os produtos falsificados estão proibidos
                                no Tendering.</span><br>
                            <i class="fas fa-arrow-right" style="color: #17b330"></i><span class="subtitle is-7" style="color: #868C99;padding-left: 10px;">Os produtos com imágens múltiples de alta
                                calidad obtém a maioria das vendas.</span><br>
                            <i class="fas fa-arrow-right" style="color: #17b330"></i><span class="subtitle is-7" style="color: #868C99;padding-left: 10px;">Adiciona imagens que sejam de, pelo
                                menos, 800x800 píxeles.</span><br>
                            <i class="fas fa-arrow-right" style="color: #17b330"></i><span class="subtitle is-7" style="color: #868C99;padding-left: 10px;">Não coloque imagens de outros
                                comerciantes, ou se eliminarão seus produtos.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="width: 920px;top: 385px;">
            <div class="card-content">
                <div class="field" style="margin-top: 25px; width: 597px">
                    <p class="subtitle is-6" style="color:#525763; text-align:left; font-weight:bold">Caracteristicas do Produto</p>
                </div>
                <div class="field has-text-left" style="width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome do produto</label>
                    <div class="control">
                        <input value="Nome" id="nomeProduto" name="nomeProduto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>

                <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                    <label class="label" style="color:#444; font-weight:normal">Descrição</label>
                    <div class="control">
                        <textarea id="descricao" name="descricao" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">Descricao</textarea>
                    </div>
                </div>    
                
                <div class="field has-text-left" style="width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Tags do produto</label>
                    <div class="control">
                        <input value="produto1;produto2" id="tagProduto" name="tagProduto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Exemplo: tag1;tag2;tag3">
                        </input>
                    </div>
                </div>

                <div class="field has-text-left" style="margin-top: 32px; width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-weight:normal">Tipo Produto</label>
                    <div class="control has-icons-right" style="margin-top: 25px">
                        <select name="tipo_produto" id="tipo_produto" class="custom-select custom-select-sm">
                            <option selected>Selecione</option>
                            <option value="0" selected>Tipo Produto</option>
                        </select>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 32px; width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-weight:normal">Tipo Anuncio</label>
                    <div class="control has-icons-right" style="margin-top: 25px">
                        <select name="tipo_anuncio" id="tipo_anuncio" class="custom-select custom-select-sm">
                            <option selected>Selecione</option>
                            <option value="1" selected>Tipo Anuncio</option>
                        </select>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código
                        identificador</label>
                    <div class="control">
                        <input value="123" id="codigo" name="codigo" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Quantidade Disponivel</label>
                    <div class="control">
                        <input value="456" id="qtd_disponivel" name="qtd_disponivel" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Quantidade Minima</label>
                    <div class="control">
                        <input value="789" id="qtd_minima" name="qtd_minima" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Capacidade de Fornecimento</label>
                    <div class="control">
                        <input value="12" id="capacidade_fornecimento" name="capacidade_fornecimento" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Unidade de Medida</label>
                    <div class="control">
                        <input value="34" id="unidade_medida" name="unidade_medida" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código NCM 2017</label>
                    <div class="control">
                        <input value="56" id="ncm_2017" name="ncm_2017" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código CPC 21</label>
                    <div class="control">
                        <input value="78" id="cpc_21" name="cpc_21" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome Cientifico</label>
                    <div class="control">
                        <input value="90" id="nome_cientifico" name="nome_cientifico" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código ICC FAO 2016</label>
                    <div class="control">
                        <input value="13" id="icc_fao_2016" name="icc_fao_2016" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código ICC FAO V1</label>
                    <div class="control">
                        <input value="24" id="icc_fao_v1" name="icc_fao_v1" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código FAO Commodities</label>
                    <div class="control">
                        <input value="35" id="fao_commodities" name="fao_commodities" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código Alterações 2018</label>
                    <div class="control">
                        <input value="46" id="alteracoes_2018" name="alteracoes_2018" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código do Produto</label>
                    <div class="control">
                        <input value="57" id="cd_produto" name="cd_produto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Classificação</label>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input checked type="checkbox" id="adulto" name="adulto"> &nbsp Adulto.</span>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input checked type="checkbox" id="infantil" name="infantil"> &nbsp Infantil.</span>
                            </span>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Gênero</label>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input checked type="checkbox" id="masculino" name="masculino"> &nbsp Masculino.</span>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input type="checkbox" id="feminino" name="feminino"> &nbsp Feminino.</span>
                            </span>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <div class="card" style="width: 920px; margin-top: 90px;top: 310px;">
            <div class="card-content">
                <div class="field" style="margin-top: 25px; width: 597px">
                    <p class="subtitle is-6" style="color:#525763; text-align:left; font-weight:bold">Preço</p>
                    <p class="subtitle is-7" style="color:#868C99; text-align:left; font-weight:normal">Você por
                        escolher o preço unitário do produto ou colocar o o valor de acordo com a quantidade do
                        pedido a ser feita.</p>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Preço
                        unitario</label>
                    <div class="control">
                        <input value="123" id="vl_unitario" name="vl_unitario" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Preço
                        antigo</label>
                    <div class="control">
                        <input value="321" id="vl_preco_antigo" name="vl_preco_antigo" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Desconto Sugerido</label>
                    <div class="control">
                        <input value="123" id="desconto" name="desconto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Altura do Pacote</label>
                    <div class="control">
                        <input value="456" id="altura_pacote" name="altura_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Largura do Pacote</label>
                    <div class="control">
                        <input value="654" id="largura_pacote" name="largura_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Comprimento do Pacote</label>
                    <div class="control">
                        <input value="789" id="comprimento_pacote" name="comprimento_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Quantidade itens no Pacote</label>
                    <div class="control">
                        <input value="987" id="qtd_item_pacote" name="qtd_item_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Peso do Pacote</label>
                    <div class="control">
                        <input value="111" id="peso_pacote" name="peso_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome do Pacote</label>
                    <div class="control">
                        <input value="nome pacote" id="nome_pacote" name="nome_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                    <label class="label" style="color:#444; font-weight:normal">Detalhes do Transporte</label>
                    <div class="control">
                        <textarea id="transporte" name="transporte" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">Transporte</textarea>
                    </div>
                </div>
                <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                    <label class="label" style="color:#444; font-weight:normal">Detalhes da Garantia</label>
                    <div class="control">
                        <textarea id="garantia" name="garantia" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">Garantia</textarea>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Promoção?</label>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                <input checked type="checkbox" id="promocao" name="promocao"> &nbsp Sim.</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card" style="width: 635px; margin-top: 96px;top: 230px;">
            <div class="card-content">
                <div class="field" style="margin-top: 25px; width: 597px">
                    <p class="subtitle is-2" style="color:#525763; text-align:left; font-weight:bold">Anexos</p>
                    <p class="subtitle is-5" style="color:#868C99; text-align:left;line-height: 1.78; font-weight:normal">Lorem ipsum
                        dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor
                        nibh finibus et. Aenean eu enim justo.</p>
                </div>
                <div class="field has-text-centered" style="margin-top: 24px;background:#fafafa; ">
                <label class="label has-text-left" style="color:#525763; font-weight:normal">Pode subir
                                até 8 anexos</label>

                    <img id="imageAnexo1" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <img id="imageAnexo2" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <img id="imageAnexo3" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <img id="imageAnexo4" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <img id="imageAnexo5" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <img id="imageAnexo6" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <img id="imageAnexo7" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <img id="imageAnexo8" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                    <div class="card-content col-md-12" style="clear: both;">
                                <div class="field has-text-centered" style="margin-top: 24px">
                                    <div class="custom-file">
                                        <input multiple type="file" class="custom-file-input" id="imgAnexo">
                                        <label class="custom-file-label" for="customFile">Anexar documento</label>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

        <div class="buttons has-addons is-left" style="margin-top: 250px">
            <div class="control">
                <button onclick="cadastrarAnuncio()" class="button is-success" style="font-weight: bold;width:223px; height: 40px;">Seguinte Passo</button>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        sessionStorage.setItem('qtd_images_anuncio', 0);
        sessionStorage.setItem('qtd_images_anexo', 0);
        sessionStorage.setItem('imagensAnuncio', 0); 
        sessionStorage.setItem('uploading_files_anuncio', JSON.stringify([])); 
        sessionStorage.setItem('uploading_files_anexo', JSON.stringify([])); 
    });
    $("#imgAnuncio").change(function() {
        var qtd_images_anuncio = sessionStorage.getItem('qtd_images_anuncio');   
        if(qtd_images_anuncio >= 16){
            warning('Atingiu o numero máximo de uploads!');
        } else {              
            readURL(this,'qtd_images_anuncio', 'imagePreview', 'anuncio');
        }       
    }); 
    $("#imgAnexo").change(function() {
        var qtd_images_anexo = sessionStorage.getItem('qtd_images_anexo');   
        if(qtd_images_anexo >= 8){
            warning('Atingiu o numero máximo de uploads!');
        } else {              
            readURL(this, 'qtd_images_anexo', 'imageAnexo', 'anexo');
        }       
    }); 
</script>
@endsection