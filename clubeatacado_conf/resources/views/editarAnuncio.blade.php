@extends('layouts.site')
@include('layouts\_includes\topoAnuncio')

@section('content')

<section class="section">
    <div class="container has-text-left">
        <h1 class="subtitle" style="width:447px;font-size:24px;font-weight:bold;text-align:left;">Editar produto
        </h1><br>
        <div class="columns">
            <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                <div class="card" style="width: 1110px;margin-top: 20px">
                    <div class="card-content">
                        <div class="field has-text-centered" style=" background:#fafafa; margin-top: 24px">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Pode subir até 4 fotografias</label>
                            <img id="imagePreview1" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview2" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview3" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                            <img id="imagePreview4" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
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
                <input type="hidden" value="{{$anuncio[0]->ID_PRODUTO}}" id="idProduto" name="idProduto"></input>
                <input type="hidden" value="{{$anuncio[0]->ID_ANUNCIO_PRODUTO}}" id="idAnuncio" name="idAnuncio"></input>
                @if(count($leilaoProduto) > 0)
                <input type="hidden" value="{{$leilaoProduto[0]->ID_LEILAO}}" id="idLeilao" name="idLeilao"></input>
                <input type="hidden" value="{{$leilaoProduto[0]->ID_LEILAO_PRODUTO}}" id="idLeilaoProduto" name="idLeilaoProduto"></input>
                @else
                <input type="hidden" value="0" id="idLeilao" name="idLeilao"></input>
                <input type="hidden" value="0" id="idLeilaoProduto" name="idLeilaoProduto"></input>
                @endif

                <div class="field has-text-left" style="width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome do produto</label>
                    <div class="control">
                        <input maxlength="100" value="{{$anuncio[0]->DS_ANUNCIO_PRODUTO}}" id="nomeProduto" name="nomeProduto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>

                <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                    <label class="label" style="color:#444; font-weight:normal">Descrição</label>
                    <div class="control">
                        <textarea maxlength="100" id="descricao" name="descricao" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">{{$anuncio[0]->DS_DETALHE_PRODUTO}}</textarea>
                    </div>
                </div>

                <div class="field has-text-left" style="width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Tags do produto</label>
                    <div class="control">
                        <input maxlength="500" value="{{$anuncio[0]->DS_TAGS}}" id="tagProduto" name="tagProduto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Exemplo: tag1;tag2;tag3">
                        </input>
                    </div>
                </div>

                <div class="field has-text-left" style="margin-top: 32px; width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-weight:normal">Tipo Produto</label>
                    <div class="control has-icons-right" style="margin-top: 25px">
                        <select name="tipo_produto" id="tipo_produto" class="custom-select custom-select-sm">
                            <option selected>Selecione</option>
                            @foreach($listaTipoProduto as $key => $tipoProduto)
                            @if($anuncio[0]->ID_TIPO_PRODUTO == $tipoProduto->ID_TIPO_PRODUTO)
                            <option value="{{$tipoProduto->ID_TIPO_PRODUTO}}" selected>{{$tipoProduto->DS_TIPO_PRODUTO}}</option>
                            @else
                            <option value="{{$tipoProduto->ID_TIPO_PRODUTO}}">{{$tipoProduto->DS_TIPO_PRODUTO}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 32px; width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-weight:normal">Tipo Anuncio</label>
                    <div class="control has-icons-right" style="margin-top: 25px">
                        <select name="tipo_anuncio" id="tipo_anuncio" class="custom-select custom-select-sm">
                            <option selected>Selecione</option>
                            @foreach($listaTipoAnuncio as $key => $tipoAnuncio)
                            @if($anuncio[0]->ID_TIPO_ANUNCIO == $tipoAnuncio->ID_TIPO_ANUNCIO)
                            <option value="{{$tipoAnuncio->ID_TIPO_ANUNCIO}}" selected>{{$tipoAnuncio->DS_TIPO_ANUNCIO}}</option>
                            @else
                            <option value="{{$tipoAnuncio->ID_TIPO_ANUNCIO}}">{{$tipoAnuncio->DS_TIPO_ANUNCIO}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código
                        identificador</label>
                    <div class="control">
                        <input maxlength="20" value="{{$anuncio[0]->ID_ANUNCIO_PRODUTO}}" id="codigo" name="codigo" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Quantidade Disponivel</label>
                    <div class="control">
                        <input type="number" min="0" step="1" value="{{$anuncio[0]->QT_DISPONIVEL}}" id="qtd_disponivel" name="qtd_disponivel" class="input" style="background-color: #fafafa; font-size: 16px;" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Quantidade Minima</label>
                    <div class="control">
                        <input type="number" min="0" step="1" value="{{$anuncio[0]->QT_MINIMA_PEDIDO}}" id="qtd_minima" name="qtd_minima" class="input" style="background-color: #fafafa; font-size: 16px;" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Capacidade de Fornecimento</label>
                    <div class="control">
                        <input type="number" min="0" step="1" value="{{$anuncio[0]->DS_CAPACIDADE_FORNECIMENTO}}" id="capacidade_fornecimento" name="capacidade_fornecimento" class="input" style="background-color: #fafafa; font-size: 16px;" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Unidade de Medida</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->DS_UNIDADE_MEDIDA}}" id="unidade_medida" name="unidade_medida" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código NCM 2017</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->CD_NCM_2017}}" id="ncm_2017" name="ncm_2017" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código CPC 21</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->CD_CPC_21}}" id="cpc_21" name="cpc_21" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome Cientifico</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->DS_NOME_CIENTIFICO}}" id="nome_cientifico" name="nome_cientifico" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código ICC FAO 2016</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->CD_ICC_FAO_2006}}" id="icc_fao_2016" name="icc_fao_2016" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código ICC FAO V1</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->CD_ICC_FAO_V1}}" id="icc_fao_v1" name="icc_fao_v1" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código FAO Commodities</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->CD_FAO_COMMODITIES_1990}}" id="fao_commodities" name="fao_commodities" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código Alterações 2018</label>
                    <div class="control">
                        <input maxlength="50" value="{{$anuncio[0]->CD_ALTERACOES_2018}}" id="alteracoes_2018" name="alteracoes_2018" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Código do Produto</label>
                    <div class="control">
                        <input maxlength="20" value="{{$anuncio[0]->CD_PRODUTO}}" id="cd_produto" name="cd_produto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Classificação</label>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                @if ($anuncio[0]->IN_ADULTO == 1)
                                <input checked type="checkbox" id="adulto" name="adulto"> &nbsp Adulto.</span>
                            @else
                            <input type="checkbox" id="adulto" name="adulto"> &nbsp Adulto.</span>
                            @endif
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                @if ($anuncio[0]->IN_INFANTIL == 1)
                                <input checked type="checkbox" id="infantil" name="infantil"> &nbsp Infantil.</span>
                            @else
                            <input type="checkbox" id="infantil" name="infantil"> &nbsp Infantil.</span>
                            @endif
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
                                @if ($anuncio[0]->IN_MASCULINO == 1)
                                <input checked type="checkbox" id="masculino" name="masculino"> &nbsp Masculino.</span>
                            @else
                            <input type="checkbox" id="masculino" name="masculino"> &nbsp Masculino.</span>
                            @endif
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                @if ($anuncio[0]->IN_FEMININO == 1)
                                <input checked type="checkbox" id="feminino" name="feminino"> &nbsp Feminino.</span>
                            @else
                            <input type="checkbox" id="feminino" name="feminino"> &nbsp Feminino.</span>
                            @endif
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
                        <input maxlength="50" onkeyup="formatarMoeda('vl_unitario')" value="{{$anuncio[0]->VL_PRODUTO_UNITARIO}}" id="vl_unitario" name="vl_unitario" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Preço
                        antigo</label>
                    <div class="control">
                        <input maxlength="50" onkeyup="formatarMoeda('vl_preco_antigo')" value="{{$anuncio[0]->VL_PRODUTO_ANTIGO}}" id="vl_preco_antigo" name="vl_preco_antigo" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Desconto Sugerido</label>
                    <div class="control">
                        <input maxlength="50" onkeyup="formatarMoeda('desconto')" value="{{$anuncio[0]->VL_DESCONTO}}" id="desconto" name="desconto" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Altura do Pacote</label>
                    <div class="control">
                        <input maxlength="50" onkeyup="formatarMoeda('altura_pacote')" value="{{$anuncio[0]->VL_ALTURA_PACOTE}}" id="altura_pacote" name="altura_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Largura do Pacote</label>
                    <div class="control">
                        <input maxlength="50" onkeyup="formatarMoeda('largura_pacote')" value="{{$anuncio[0]->VL_LARGURA_PACOTE}}" id="largura_pacote" name="largura_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Comprimento do Pacote</label>
                    <div class="control">
                        <input maxlength="50" onkeyup="formatarMoeda('comprimento_pacote')" value="{{$anuncio[0]->VL_COMPRIMENTO_PACOTE}}" id="comprimento_pacote" name="comprimento_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Quantidade itens no Pacote</label>
                    <div class="control">
                        <input type="number" min="0" step="1" value="{{$anuncio[0]->QT_ITEM_PACOTE}}" id="qtd_item_pacote" name="qtd_item_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Peso do Pacote</label>
                    <div class="control">
                        <input maxlength="50" onkeyup="formatarMoeda('peso_pacote')" value="{{$anuncio[0]->VL_PESO_PACOTE_KG}}" id="peso_pacote" name="peso_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome do Pacote</label>
                    <div class="control">
                        <input maxlength="100" value="{{$anuncio[0]->DS_PACOTE}}" id="nome_pacote" name="nome_pacote" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                        </input>
                    </div>
                </div>
                <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                    <label class="label" style="color:#444; font-weight:normal">Detalhes do Transporte</label>
                    <div class="control">
                        <textarea maxlength="1024" id="transporte" name="transporte" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">{{$anuncio[0]->DS_DETALHES_TRANSPORTE}}</textarea>
                    </div>
                </div>
                <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                    <label class="label" style="color:#444; font-weight:normal">Detalhes da Garantia</label>
                    <div class="control">
                        <textarea maxlength="1024" id="garantia" name="garantia" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">{{$anuncio[0]->DS_GARANTIA}}</textarea>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Promoção?</label>
                    <div class="field">
                        <div class="control" style="font-size:14px;color:#444444">
                            <span style="height: 24px; width: 24px;">
                                @if ($anuncio[0]->IN_PROMOCAO == 1)
                                <input checked type="checkbox" id="promocao" name="promocao"> &nbsp Sim.</span>
                            @else
                            <input type="checkbox" id="promocao" name="promocao"> &nbsp Sim.</span>
                            @endif
                            </span>
                        </div>
                    </div>
                </div>
                <p>
                    <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                            <label class="label has-text-left" style="cursor: pointer;color:#444; font-size: 14px;font-weight:normal">Leilão?</label>
                        </div>
                    </a>
                </p>
                @if ($anuncio[0]->FLAG_LEILAO == 1)
                <div class="collapse show" id="collapseExample">
                    @else
                    <div class="collapse" id="collapseExample">
                        @endif
                        <div class="card card-body">
                            <div class="field">
                                <div class="control" style="font-size:14px;color:#444444">
                                    <span style="height: 24px; width: 24px;">
                                        @if ($anuncio[0]->FLAG_LEILAO == 1)
                                        <input checked type="checkbox" id="leilao" name="leilao"> &nbsp Sim.</span>
                                    @else
                                    <input type="checkbox" id="leilao" name="leilao"> &nbsp Sim.</span>
                                    @endif
                                    </span>
                                </div>
                            </div>
                            @if(count($leilaoProduto) > 0)
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome da Loja</label>
                                <div class="control">
                                    <input maxlength="50" value="{{$leilaoProduto[0]->DS_LOJA}}" id="loja" name="loja" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                                    </input>
                                </div>
                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome do Vendedor</label>
                                <div class="control">
                                    <input type="text" maxlength="50" value="{{$leilaoProduto[0]->DS_VENDEDOR}}" id="vendedor" name="vendedor" class="input" style="background-color: #fafafa; font-size: 16px;" placeholder="Escrever informação">
                                    </input>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Identificação</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="identificacao" name="identificacao" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">{{$leilaoProduto[0]->DS_IDENTIFICACAO}}</textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Informações</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="informacoes" name="informacoes" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">{{$leilaoProduto[0]->DS_INFORMACOES}}</textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Condições Gerais</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="condicoesGerais" name="condicoesGerais" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">{{$leilaoProduto[0]->DS_CONDICOES_GERAIS}}</textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Acessórios</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="acessorios" name="acessorios" style="font-size: 16px;" class="textarea" placeholder="Escrever informação">{{$leilaoProduto[0]->DS_ACESSORIOS}}</textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Data Inicio</label>
                                <div class="control">
                                    <input disabled value="{{$leilaoProduto[0]->DT_INICIO}}" id="dt_inicio" name="dt_inicio" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                                    </input>
                                    <button onclick="editarData('Inicio')" class="button is-success" style="font-weight: bold;width:60px; height: 40px;">Editar</button>
                                </div>
                                <br>
                                <div id="editarDataInicio" style="display:none;" class="control">
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="31" id="dt_inicio_dia" name="dt_inicio_dia" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="12" id="dt_inicio_mes" name="dt_inicio_mes" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" min="0" step="1" id="dt_inicio_ano" name="dt_inicio_ano" class="input" style="background-color: #fafafa; font-size: 16px;width: 95px;" type="number">
                                    </input>
                                </div>
                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">

                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Data Fim</label>
                                <div class="control">
                                    <input disabled value="{{$leilaoProduto[0]->DT_FIM}}" id="dt_fim" name="dt_fim" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                                    </input>
                                    <button onclick="editarData('Fim')" class="button is-success" style="font-weight: bold;width:60px; height: 40px;">Editar</button>
                                </div>
                                <br>
                                <div id="editarDataFim" style="display:none;" class="control">
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="31" id="dt_fim_dia" name="dt_fim_dia" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="12" id="dt_fim_mes" name="dt_fim_mes" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" min="0" step="1" id="dt_fim_ano" name="dt_fim_ano" class="input" style="background-color: #fafafa; font-size: 16px;width: 95px;" type="number">
                                    </input>
                                </div>
                            </div>
                            @else
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome da Loja</label>
                                <div class="control">
                                    <input maxlength="50" value="" id="loja" name="loja" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                                    </input>
                                </div>
                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Nome do Vendedor</label>
                                <div class="control">
                                    <input type="text" maxlength="50" value="" id="vendedor" name="vendedor" class="input" style="background-color: #fafafa; font-size: 16px;" placeholder="Escrever informação">
                                    </input>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Identificação</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="identificacao" name="identificacao" style="font-size: 16px;" class="textarea" placeholder="Escrever informação"></textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Informações</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="informacoes" name="informacoes" style="font-size: 16px;" class="textarea" placeholder="Escrever informação"></textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Condições Gerais</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="condicoesGerais" name="condicoesGerais" style="font-size: 16px;" class="textarea" placeholder="Escrever informação"></textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="width: 730px;margin-top: 48px">
                                <label class="label" style="color:#444; font-weight:normal">Acessórios</label>
                                <div class="control">
                                    <textarea maxlength="2048" id="acessorios" name="acessorios" style="font-size: 16px;" class="textarea" placeholder="Escrever informação"></textarea>
                                </div>
                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Data Inicio</label>
                                <div class="control">
                                    <input disabled value="" id="dt_inicio" name="dt_inicio" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                                    </input>
                                    <button onclick="editarData('Inicio')" class="button is-success" style="font-weight: bold;width:60px; height: 40px;">Editar</button>
                                </div>
                                <br>
                                <div id="editarDataInicio" style="display:none;" class="control">
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="31" id="dt_inicio_dia" name="dt_inicio_dia" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="12" id="dt_inicio_mes" name="dt_inicio_mes" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" min="0" step="1" id="dt_inicio_ano" name="dt_inicio_ano" class="input" style="background-color: #fafafa; font-size: 16px;width: 95px;" type="number">
                                    </input>
                                </div>
                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">

                            </div>
                            <div class="field has-text-left" style="margin-top: 24px;width: 445px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#444; font-size: 14px;font-weight:normal">Data Fim</label>
                                <div class="control">
                                    <input disabled value="" id="dt_fim" name="dt_fim" class="input" style="background-color: #fafafa; font-size: 16px;" type="text" placeholder="Escrever informação">
                                    </input>
                                    <button onclick="editarData('Fim')" class="button is-success" style="font-weight: bold;width:60px; height: 40px;">Editar</button>
                                </div>
                                <br>
                                <div id="editarDataFim" style="display:none;" class="control">
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="31" id="dt_fim_dia" name="dt_fim_dia" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" min="0" step="1" max="12" id="dt_fim_mes" name="dt_fim_mes" class="input" style="background-color: #fafafa; font-size: 16px;width: 70px;" type="number">
                                    </input>
                                    /
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" min="0" step="1" id="dt_fim_ano" name="dt_fim_ano" class="input" style="background-color: #fafafa; font-size: 16px;width: 95px;" type="number">
                                    </input>
                                </div>
                            </div>
                            @endif

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
                        <label class="label has-text-left" style="color:#525763; font-weight:normal">Pode subir até 4 anexos</label>
                        <img id="imageAnexo1" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                        <img id="imageAnexo2" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                        <img id="imageAnexo3" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
                        <img id="imageAnexo4" class="subir-foto" src="css/img/atoms-icons-02-channel-photo-image.png" alt="subir foto" style="width: 123px;height: 123px;padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
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
                    <button onclick="editarAnuncio()" class="button is-success" style="font-weight: bold;width:223px; height: 40px;">Salvar</button>
                </div>
            </div>
        </div>
</section>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        sessionStorage.setItem('qtd_images_anuncio', 0);
        sessionStorage.setItem('qtd_images_anexo', 0);
        sessionStorage.setItem('imagensAnuncio', 0);
        sessionStorage.setItem('uploading_files_anuncio', JSON.stringify([]));
        sessionStorage.setItem('uploading_files_anexo', JSON.stringify([]));
    });
    $("#imgAnuncio").change(function() {
        var qtd_images_anuncio = sessionStorage.getItem('qtd_images_anuncio');
        if (qtd_images_anuncio >= 4) {
            warning('Atingiu o numero máximo de uploads!');
        } else {
            readURL(this, 'qtd_images_anuncio', 'imagePreview', 'anuncio');
        }
    });
    $("#imgAnexo").change(function() {
        var qtd_images_anexo = sessionStorage.getItem('qtd_images_anexo');
        if (qtd_images_anexo >= 4) {
            warning('Atingiu o numero máximo de uploads!');
        } else {
            readURL(this, 'qtd_images_anexo', 'imageAnexo', 'anexo');
        }
    });

    function behaviour() {
        $("#dt_fim").val(moment($("#dt_fim").val()).format('DD/MM/YYYY'));
        $("#dt_inicio").val(moment($("#dt_inicio").val()).format('DD/MM/YYYY'));
    }

    $('input[id=dt_fim]').on('input', behaviour);
    $('input[id=dt_inicio]').on('input', behaviour); //Bind your function to the event

    behaviour();
</script>
<script>
    function formatarMoeda(field) {
        var elemento = document.getElementById(field);
        var valor = elemento.value;

        valor = valor + '';
        valor = parseInt(valor.replace(/[\D]+/g, ''));
        valor = valor + '';
        valor = valor.replace(/([0-9]{2})$/g, ",$1");

        if (valor.length > 6) {
            valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }

        elemento.value = valor;
        if (valor == 'NaN') elemento.value = '';
    }

    function editarData(data) {
        $("#editarData" + data).css('display', 'block');
    }
</script>
@endsection