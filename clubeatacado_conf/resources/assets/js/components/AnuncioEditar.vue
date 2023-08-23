<template>
    <div class="column">
        <section class="section1" id="section1" style=" display:block">

            <div class="container has-text-centered">

                <div class="columns">

                    <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">

                        <div class="card" style="width: 920px; background:#fafafa; margin-top: 20px">
                            <div class="card-content">

                                <div class="field has-text-centered" style="padding-left: 30px;margin-top: 24px">
                                    <label class="label has-text-left" style="color:#525763; font-weight:normal">Pode subir até 5
                                        fotografias</label>
                                    <div class="file is-white is-boxed" style="margin-top: 25px;margin-left: 60px">
                                        
                                        <div class="upload-image is-pulled-left  " >
                                            <label for="file" class="label-file-img" >
                                                <img id="uploadicon1" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">

                                                    <img id="imagem1" src="">
                                                </div>
                                                <a id="close1" class="button-close close" name="uploadImage"
                                                   style="display:none; " v-on:click="remover(1)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open1" class="button-open open" style="position: static;
    margin-top: -20px;
    margin-left: 110px;" name="uploadImage"
                                                ><i class="fa fa-plus-circle fa-2x"
                                                    aria-hidden="true" ></i></a>
                                            </label>
                                            <p id="filename1" class="file-name"></p>
                                            <input id="file" name="image1" type="file" class="input-file"
                                                   @change="onFileChanged1">
                                            <div id="horizontal1" class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input id="input1" type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <div class="upload-image is-pulled-left " >
                                            <label for="file2" class="label-file-img">
                                                <img id="uploadicon2" class="upload-icon" src="/clubeatacado/images/photo.png">

                                                <div class="image-wrapper">
                                                    <img id="imagem2" src="">
                                                </div>
                                                <a id="close2" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(2)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open2" class="button-open open" name="uploadImage"
                                                   style="display:block; position: static;
    margin-top: -20px;
    margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                             aria-hidden="true"></i></a>
                                            </label>

                                            <p class="file-name"></p>
                                            <input id="file2" name="image2" type="file" class="input-file"
                                                   @change="onFileChanged2">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <div class="upload-image is-pulled-left " >
                                            <label for="file3" class="label-file-img" >
                                                <img id="uploadicon3" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">
                                                    <img id="imagem3" src="">
                                                </div>
                                                <a id="close3" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(3)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open3" class="button-open open" name="uploadImage"
                                                   style="display:block; position: static;
    margin-top: -20px;
    margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                             aria-hidden="true"></i></a>
                                            </label>
                                            <p class="file-name"></p>
                                            <input id="file3" type="file" class="input-file" name="image3"
                                                   @change="onFileChanged3">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <div class="upload-image is-pulled-left " >
                                            <label for="file4" class="label-file-img">
                                                <img id="uploadicon4" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">
                                                    <img id="imagem4" src="">
                                                </div>
                                                <a id="close4" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(4)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open4" class="button-open open" name="uploadImage"
                                                   style="display:block; position: static;
                                                        margin-top: -20px;
                                                        margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                             aria-hidden="true"></i></a>
                                            </label>
                                            <p class="file-name"></p>
                                            <input id="file4" type="file" class="input-file" name="image4"
                                                   @change="onFileChanged4">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <div class="upload-image is-pulled-left "  >
                                            <label for="file5" class="label-file-img">
                                                <img id="uploadicon5" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">
                                                    <img id="imagem5" src="">
                                                </div>
                                                <a id="close5" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(5)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open5" class="button-open open"  name="uploadImage"
                                                   style="display:block; position: static;
    margin-top: -20px;
    margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                             aria-hidden="true"></i></a>
                                            </label>
                                            <p class="file-name"></p>
                                            <input id="file5" type="file" class="input-file" name="image5"
                                                   @change="onFileChanged5">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="field has-text-centered" style="padding-left: 30px;margin-top: 24px">
                                    <label label class="label has-text-left" style="color:#525763; font-weight:normal">Certificado de qualidade</label>
                                    <div  class="file is-white is-boxed" style="margin-top: 25px;margin-left: 60px">
                                       <div class="upload-image is-pulled-left  " >
                                            <label for="file6" class="label-file-img" >
                                                <img id="uploadicon6" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">

                                                    <img id="imagem6" src="">
                                                </div>
                                                <a id="close6" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(6)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open6" class="button-open open" style="position: static;margin-top: -20px;margin-left: 110px;" name="uploadImage"
                                                ><i class="fa fa-plus-circle fa-2x"
                                                    aria-hidden="true" ></i></a>
                                            </label>
                                            <p id="filename6" class="file-name"></p>
                                            <input id="file6" name="image6" type="file" class="input-file"
                                                   @change="onFileChanged6">
                                            <div id="horizontal1" class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input id="input6" type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <div class="upload-image is-pulled-left  " >
                                            <label for="file7" class="label-file-img" >
                                                <img id="uploadicon7" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">

                                                    <img id="imagem7" src="">
                                                </div>
                                                <a id="close7" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(7)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open7" class="button-open open" style="position: static;
    margin-top: -20px;
    margin-left: 110px;" name="uploadImage"
                                                ><i class="fa fa-plus-circle fa-2x"
                                                    aria-hidden="true" ></i></a>
                                            </label>
                                            <p id="filename7" class="file-name"></p>
                                            <input id="file7" name="image7" type="file" class="input-file"
                                                   @change="onFileChanged7">
                                            <div id="horizontal1" class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input id="input7" type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <!-- <div class="upload-image is-pulled-left " >
                                            <label for="file7" class="label-file-img">
                                                <img id="uploadicon7" class="upload-icon" src="/clubeatacado/images/photo.png">

                                                <div class="image-wrapper">
                                                    <img id="imagem7" src="">
                                                </div>
                                                <a id="close7" class="button-close close" name="uploadImage"
                                                   style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                                                                                   aria-hidden="true" v-on:click="remover(7)"></i></a>
                                                <a id="open7" class="button-open open" name="uploadImage"
                                                   style="display: block;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                                                                                  aria-hidden="true"></i></a>
                                            </label>

                                            <p id="filename7" class="file-name"></p>
                                            <input id="file7" name="image7" type="file" class="input-file"
                                                   @change="onFileChanged7">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div> -->
                                        <div class="upload-image is-pulled-left  " >
                                            <label for="file8" class="label-file-img" >
                                                <img id="uploadicon8" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">

                                                    <img id="imagem8" src="">
                                                </div>
                                                <a id="close8" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(8)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open8" class="button-open open" style="position: static;
    margin-top: -20px;
    margin-left: 110px;" name="uploadImage"
                                                ><i class="fa fa-plus-circle fa-2x"
                                                    aria-hidden="true" ></i></a>
                                            </label>
                                            <p id="filename8" class="file-name"></p>
                                            <input id="file8" name="image8" type="file" class="input-file"
                                                   @change="onFileChanged8">
                                            <div id="horizontal1" class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input id="input8" type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <!-- <div class="upload-image is-pulled-left " >
                                            <label for="file8" class="label-file-img" >
                                                <img id="uploadicon8" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">
                                                    <img id="imagem8" src="">
                                                </div>
                                                <a id="close8" class="button-close close" name="uploadImage"
                                                   style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                                                                                   aria-hidden="true" v-on:click="remover(8)"></i></a>
                                                <a id="open8" class="button-open open" name="uploadImage"
                                                   style="display: block;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                                                                                  aria-hidden="true"></i></a>
                                            </label>
                                            <p class="file-name"></p>
                                            <input id="file8" type="file" class="input-file" name="image8"
                                                   @change="onFileChanged8">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div> -->
                                        <div class="upload-image is-pulled-left  " >
                                            <label for="file9" class="label-file-img" >
                                                <img id="uploadicon9" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">

                                                    <img id="imagem9" src="">
                                                </div>
                                                <a id="close9" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(9)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open9" class="button-open open" style="position: static;
    margin-top: -20px;
    margin-left: 110px;" name="uploadImage"
                                                ><i class="fa fa-plus-circle fa-2x"
                                                    aria-hidden="true" ></i></a>
                                            </label>
                                            <p id="filename9" class="file-name"></p>
                                            <input id="file9" name="image9" type="file" class="input-file"
                                                   @change="onFileChanged9">
                                            <div id="horizontal1" class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input id="input9" type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <!-- <div class="upload-image is-pulled-left " >
                                            <label for="file9" class="label-file-img">
                                                <img id="uploadicon9" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">
                                                    <img id="imagem9" src="">
                                                </div>
                                                <a id="close9" class="button-close close" name="uploadImage"
                                                   style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                                                                                   aria-hidden="true" v-on:click="remover(9)"></i></a>
                                                <a id="open9" class="button-open open" name="uploadImage"
                                                   style="display: block;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                                                                                  aria-hidden="true"></i></a>
                                            </label>
                                            <p class="file-name"></p>
                                            <input id="file9" type="file" class="input-file" name="image9"
                                                   @change="onFileChanged9">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div> -->
                                        <div class="upload-image is-pulled-left  " >
                                            <label for="file10" class="label-file-img" >
                                                <img id="uploadicon10" class="upload-icon" src="/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">

                                                    <img id="imagem10" src="">
                                                </div>
                                                <a id="close10" class="button-close close" name="uploadImage"
                                                   style="display:none;" v-on:click="remover(10)"><i class="fa fa-times-circle fa-2x"
                                                                            aria-hidden="true" ></i></a>
                                                <a id="open10" class="button-open open" style="position: static;
    margin-top: -20px;
    margin-left: 110px;" name="uploadImage"
                                                ><i class="fa fa-plus-circle fa-2x"
                                                    aria-hidden="true" ></i></a>
                                            </label>
                                            <p id="filename10" class="file-name"></p>
                                            <input id="file10" name="image10" type="file" class="input-file"
                                                   @change="onFileChanged10">
                                            <div id="horizontal1" class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input id="input10" type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div>
                                        <!-- <div class="upload-image is-pulled-left "  >
                                            <label for="file10" class="label-file-img">
                                                <img id="uploadicon10" class="upload-icon" src="https://testetendering.myappnow.com.br/clubeatacado/images/photo.png">
                                                <div class="image-wrapper">
                                                    <img id="imagem10" src="">
                                                </div>
                                                <a id="close10" class="button-close close" name="uploadImage"
                                                   style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                                                                                   aria-hidden="true" v-on:click="remover(10)"></i></a>
                                                <a id="open10" class="button-open open" name="uploadImage"
                                                   style="display: block;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                                                                                  aria-hidden="true"></i></a>
                                            </label>
                                            <p class="file-name"></p>
                                            <input id="file10" type="file" class="input-file" name="image10"
                                                   @change="onFileChanged10">
                                            <div class="horizontal-line"></div>
                                            <div class="under-block">
                                                <input type="submit" value="Upload" style="display: none" class="input-submit">
                                            </div>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 920px; background:#fafafa; margin-top: 90px">
                    <div class="card-content">
                        <div class="field has-text-left"
                             style="margin-left: 30px; margin-top: 24px; width: 290px;">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Nome do produto</label>
                            <div class="control has-icons-left" style="margin-top: 25px">
                                <input class="input"
                                       style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#dbdbdb;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px;"
                                       type="text" id="nome" maxlength="50">
                                <span class="icon is-small is-left" style="height: 27px; width: 20px; position:static;">
                                <i class="fas fa-star" style="position:absolute; margin-top: -20%"></i>
                            </span>
                            </div>
                        </div>

                        <div class="field has-text-left" style="padding-left: 30px;width: 55%;margin-top: 48px">
                            <label class="label" style="color:#525763; font-weight:normal">Descrição</label>
                            <div class="control">
                                <textarea class="textarea" maxlength="100" style="background-color:#E5E8ED;" id="descricao"></textarea>
                            </div>
                        </div>
                        <div style="display: flex;">
                            <div class="field has-text-left"
                                 style="margin-left: 30px; margin-top: 25px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
    
                                <label class="label has-text-left" style="color:#525763; font-weight:normal">Categoria</label>
                                <div class="" style="margin-top: 25px; " id="categoria">
                                    <v-select   placeholder="Categorias"
                                                :options="result"
                                                @input="autCcomleteProd"
                                                :value=" this.cat"
                                    ></v-select>
                                </div>
                            </div>
                            <div class="field has-text-left"
                                 style="margin-left: 30px; margin-top: 25px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#525763; font-weight:normal">Código identificador</label>
                                <div class="control has-icons-left" style="margin-top: 25px">
                                    <v-select   placeholder="Produtos"
                                                id="prod"
                                                :options="resultProd"
                                                @input="addProd"
                                                :value="this.prod"

                                    ></v-select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 920px; background:#fafafa; margin-top: 90px">
                    <div class="card-content">
                        <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 597px">
                            <p class="subtitle is-6" style="color:#525763; font-weight:bold">Preço</p>
                            <p class="subtitle is-7" style="color:#868C99; font-weight:normal">Você por escolher o preço unitário do
                                produto ou colocar o valor de acordo com a quantidade do pedido a ser feita.</p>
                        </div>
                        <div class="field has-text-left"
                             style="margin-left: 30px; margin-top: 25px; width: 290px;">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Preço unitario ou rango</label>
                            <div class="control has-icons-left" style="margin-top: 25px">
                                <money class="input"  style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px 0px;border-color:#dbdbdb;" placeholder="" id="preco" v-model="price" v-bind="money"></money>

                                <!--<input  class="input"  style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px 0px;border-color:#dbdbdb;"-->
                                        <!--type="number" id="preco" placeholder="R$20,00">-->

                                <!--<input class="input"-->
                                <!--&gt;-->
                                <span class="icon is-small is-left" style="height: 27px; width: 20px; position:static;">
                                <i class="far fa-money-bill-alt" style="position: absolute;margin-top: -20%;"></i>
                              </span>
                            </div>
                        </div>

                        <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 597px">
                            <p class="subtitle is-6" style="color:#525763; font-weight:normal">Preço de acordo com a quantidade pedida
                            </p>
                            <div v-for="(item, index) in rangoVal">

                                <div class="columns" style="margin-top: 1%">
                                    <div class="column">
                                        <div class="field has-text-left">
                                            <div class="subtitle is-6" style="color:#868C99; font-weight:normal">De</div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="field has-text-left" style="margin-left: -130px; width: 80px;  color: #dbdbdb">
                                            <div class="" style="width:100%;border: 0px solid transparent; margin-top: 0px">
                                                <select style="font-size: 16px; border-width: 0px 0px 1px 0px; background:#fafafa" :id="'qtInicial'+index" v-model="item.QT_INICIAL">
                                                    <option v-for="p in 1000"
                                                            :value="p">
                                                        {{p}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="field has-text-left" style="margin-left: -170px;">
                                            <div class="subtitle is-6" style="color:#868C99; font-weight:normal">Até</div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="field has-text-left" style="margin-left: -290px; width: 80px;  color: #dbdbdb">
                                            <div class="" style="width:100%;border: 0px solid transparent;margin-top: 0px">
                                                <select style="font-size: 16px; border-width: 0px 0px 1px 0px; background:#fafafa"  :id="'qtFinal'+ index" v-model="item.QT_FINAL">
                                                    <option v-for="p in 1000"
                                                            :value="p">
                                                        {{p}}
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="field has-text-left"
                                     style="width: 290px;">
                                    <div class="control has-icons-left">
                                        <money class="input" style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px 0px;border-color:#dbdbdb;"  placeholder="R$20,00"  :id="'rangoPreco' + index" v-model="item.VL_PRODUTO" v-bind="money"></money>

                                        <!--<input class="input"-->
                                               <!--style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px 0px;border-color:#dbdbdb;"-->
                                               <!--type="number"-->
                                               <!--:id="'rangoPreco' + index"-->
                                               <!--v-model="item.VL_PRODUTO"-->
                                        <!--&gt;-->
                                        <span class="icon is-small is-left" style="height: 27px; width: 20px; position:static;">
                                <i class="far fa-money-bill-alt" style="position: absolute;margin-top: -20%;"></i>
                              </span>
                                    </div>
                                </div>
                            </div>


                            <div class="field has-text-left" style="margin-top: 1%">
                                <label class="label"><a style="font-size: 16px; color:#23A7FB" v-on:click="addRangpPreco()">Adicionar outro rango de
                                    preços</a></label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card" style="width: 920px; background:#fafafa; margin-top: 24px">
                    <div class="card-content" style="display: flex;">
                        <div class="field has-text-left"
                             style="margin-left: 30px; margin-top: 24px; width: 290px;">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Quantidade em Stock</label>
                            <div class="control has-icons-left" style="margin-top: 25px">
                                <input class="input"
                                       style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px 0px;border-color:#dbdbdb;"
                                       type="text" id="stock">
                                <span class="icon is-small is-left" style="height: 27px; width: 20px; position:static;">
                                    <i class="fas fa-th-large" style="position: absolute;margin-top: -20%;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field has-text-left"
                             style="margin-left: 30px; margin-top: 24px; width: 290px;">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Pedido mínimo do
                                produto</label>
                            <div class="control has-icons-left" style="margin-top: 25px">
                                <input class="input"
                                       style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px 0px;border-color:#dbdbdb;"
                                       type="text" id="minimo">
                                <span class="icon is-small is-left" style="height: 27px; width: 20px; position:static;">
                                     <i class="fas fa-list" style="position: absolute;margin-top: -20%;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 920px; background:#fafafa; margin-top: 20px">
                    <div class="card-content">

                        <div class="field has-text-centered" style="padding-left: 30px;margin-top: 24px">
                            <label class="label has-text-left" style="color:#525763; font-weight:normal">Cores
                                disponiveis</label>
                            <div class="columns is-multiline is-centered">
                                <div id="material" class="column is-2" v-for="item in cores" style="width: 12.6667%">

                                    <div class="card is-shady" style="background: transparent">

                                        <div style="height: 50px; margin-bottom: inherit;" >
                                            <input  class="is-checkradio" :id="item[0]" type="checkbox" style="display: none"/>
                                            <label class="button"
                                                   :style="{background: item[1] }"
                                                   :id="item[1].substring(1, item[1].length)"
                                                   style="width: 60px; height: 60px; border-radius: 100px; border-color: transparent;border-width: 2px;"
                                                   :for="item[0]"
                                                   v-on:click="selectColor(item[1])"><i
                                                    id="a"
                                                    class="fas fa-check"
                                                    style="position: absolute; left: 20px; bottom: 20px;
                                                        color: #ffffff;background-color: #08e9fd7a;
                                                                width: 20px;
                                                                height: 20px;
                                                                border-radius: 100px; display:none;"></i>
                                            </label>
                                        </div>
                                        <div style="background: transparent">
                                            {{item[0]}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="columns">
                            <div class="column"
                                 style="width: 18%; margin-left: -250px;position: relative;right: 200px">
                                <div class="field has-text-centered">
                                    <label class="label"><a style="font-size: 14px; color:#23A7FB"
                                                            v-on:click="showModal()"><u>Adicionar cor</u></a></label>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="card" style="width: 920px; background:#fafafa; margin-top: 20px">
                    <div class="card-content">
                        <div class="card"
                             style="background-color: #fafafa; box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);width: 65%;">
                            <div class="card-content">
                                <label class="label has-text-left"
                                       style="color:#525763; font-weight:normal">Tamanhos</label>
                                <div class="columns">

                                    <div class="column has-text-left" style="background-color: #fafafa;">
                                        <div class="field is-horizontal">
                                            <div class="field-body">
                                                <div class="field">
                                                    <div class="control">
                                                        <div class="field">
                                                            <input class="is-checkradio is-info" id="check1" type="checkbox"
                                                                   name="exampleCheckboxInfo" checked="checked"
                                                                   v-model="toggle[0].tamanho"
                                                                   true-value="PP"
                                                                   false-value="0">
                                                            <label for="check1">PP</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-body" style="margin-right: 0px;">
                                                <div class="field">
                                                    <div class="control has-icons-left">
                                                        <input class="input"
                                                               style="position:static; box-shadow:inset 0 -1px 0px #D6DCE4;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;margin-left: -50px;" type="text" placeholder="PP"
                                                               id="pp" maxlength="50">
                                                        <span class="icon is-left"
                                                              style="height: 30px; margin-left: -100%; width: 20px; position:static;">
														<i class="fas fa-newspaper"></i>
													</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="field is-horizontal">
                                            <div class="field-body">
                                                <div class="field">
                                                    <div class="control">
                                                        <div class="field">
                                                            <input class="is-checkradio is-info" id="check2" type="checkbox"
                                                                   name="exampleCheckboxInfo"
                                                                   v-model="toggle[1].tamanho"
                                                                   true-value="P"
                                                                   false-value="0">
                                                            <label for="check2">P</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-body" style="margin-right: 0px;">
                                                <div class="field">
                                                    <div class="control has-icons-left">
                                                        <input class="input"
                                                               style="position:static; box-shadow:inset 0 -1px 0px #D6DCE4;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;margin-left: -50px;" type="text" placeholder="P" id="P" maxlength="50"
                                                        >
                                                        <span class="icon is-left"
                                                              style="height: 30px; margin-left: -100%; width: 20px; position:static;">
														<i class="fas fa-newspaper"></i>
													</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="field is-horizontal">
                                            <div class="field-body">
                                                <div class="field">
                                                    <div class="control">
                                                        <div class="field">
                                                            <input class="is-checkradio is-info" id="check3" type="checkbox"
                                                                   name="exampleCheckboxInfo"
                                                                   v-model="toggle[2].tamanho"
                                                                   true-value="M"
                                                                   false-value="0">
                                                            <label for="check3">M</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-body" style="margin-right: 0px;">
                                                <div class="field">
                                                    <div class="control has-icons-left">
                                                        <input class="input"
                                                               style="position:static; box-shadow:inset 0 -1px 0px #D6DCE4;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;margin-left: -50px;" type="text" placeholder="M" id="M" maxlength="50"
                                                        >
                                                        <span class="icon is-left"
                                                              style="height: 30px; margin-left: -100%; width: 20px; position:static;">
														<i class="fas fa-newspaper"></i>
													</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="column has-text-left" style="background-color: #fafafa;">
                                        <div class="field is-horizontal">
                                            <div class="field-body">
                                                <div class="field">
                                                    <div class="control">
                                                        <div class="field">
                                                            <input class="is-checkradio is-info" id="check4" type="checkbox"
                                                                   name="exampleCheckboxInfo"
                                                                   v-model="toggle[3].tamanho"
                                                                   true-value="G"
                                                                   false-value="0">
                                                            <label for="check4">G</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-body" style="margin-right: 0px;">
                                                <div class="field">
                                                    <div class="control has-icons-left">
                                                        <input class="input"
                                                               style="position:static; box-shadow:inset 0 -1px 0px #D6DCE4;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;margin-left: -50px;"  type="text" placeholder="G" id="G" maxlength="50">
                                                        <span class="icon is-left"
                                                              style="height: 30px; margin-left: -100%; width: 20px; position:static;">
														<i class="fas fa-newspaper"></i>
													</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="field is-horizontal">
                                            <div class="field-body">
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="is-checkradio is-info" id="check5" type="checkbox"
                                                               name="exampleCheckboxInfo"
                                                               v-model="toggle[4].tamanho"
                                                               true-value="GG"
                                                               false-value="0">
                                                        <label for="check5">GG</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-body" style="margin-right: 0px;">
                                                <div class="field">
                                                    <div class="control has-icons-left">
                                                        <input class="input"
                                                               style="position:static; box-shadow:inset 0 -1px 0px #D6DCE4;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;margin-left: -50px;" type="text" placeholder="GG" id="GG" maxlength="50">
                                                        <span class="icon is-left"
                                                              style="height: 30px; margin-left: -100%; width: 20px; position:static;">
														<i class="fas fa-newspaper"></i>
													</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="field is-horizontal">
                                            <div class="field-body">
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="is-checkradio is-info" id="check6" type="checkbox"
                                                               name="exampleCheckboxInfo"
                                                               v-model="toggle[5].tamanho"
                                                               true-value="GGG"
                                                               false-value="0">
                                                        <label for="check6">GGG</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-body" style="margin-right: 0px;">
                                                <div class="field">
                                                    <div class="control has-icons-left">
                                                        <input class="input"
                                                               style="position:static; box-shadow:inset 0 -1px 0px #D6DCE4;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;margin-left: -50px;"
                                                               type="text" placeholder="GGG" id="GGG" maxlength="50">
                                                        <span class="icon is-left"
                                                              style="height: 30px; margin-left: -100%; width: 20px; position:static;">
														<i class="fas fa-newspaper"></i>
													</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="field has-text-left" style="width: 90%;">
                                    <label class="label" style="color:#525763; font-weight:normal">Descrição</label>
                                    <div class="control">
                                        <textarea class="textarea" style="background-color:#E5E8ED;" id="descricao2" maxlength="100"></textarea>
                                    </div>
                                </div>
                                <div class="field has-text-left" style="width: 90%;">
                                    <label class="label" style="color:#525763; font-weight:normal">Garantia</label>
                                    <div class="control">
                                        <textarea class="textarea" style="background-color:#E5E8ED;" id="garantia" maxlength="100"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="buttons has-addons is-centered">
                    <div class="control">
                        <button class="button"
                                style="color:#525763;font-weight: bold;width:290px; height: 52px;margin-inline-end: 80px;" v-on:click="concluir()">Salvar</button>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal" id="myModal" >
            <div class="modal-card" style="width: 300px; ">
                <header class="rectangle-10" style="width: 300px; margin-left: 15%; background-color: #fffefa;height: 90px;">
                    <button class="button closeModal" style="margin-left: 60%; margin-botton:50%"><i class="fa fa-times fa-1x" style="color: #0a0a0a;"></i></button>
                    <p class="modal-card-title" style="color: #0a0a0a;text-align: left;margin-left: 10%;">selecione uma cor</p>
                    <hr style="background-color: #dbdbdb;display: block;width: 240px; margin-left: 2%;margin-top: 4%;margin-bottom: 4%;"/>
                </header>

                <section class="modal-card-body body-modal" style="width: 300px; margin-left: 15%;padding-top: 0px;">
                    <color-picker
                            style="width: 220px;"
                            :color="color"
                            :sucker-hide="false"
                            :sucker-canvas="suckerCanvas"
                            :sucker-area="suckerArea"
                            @changeColor="changeColor"
                            @openSucker="openSucker"
                    />

                    <input class="button" style="color: rgb(82, 87, 99);
                                                    font-weight: bold;
                                                    background-color: rgba(82, 87, 99, 0);
                                                    border-color: #d73c38;
                                                        width: 150px;
    height: 30px;
    margin-top: 4%;
    margin-left: -15%;" value="Inserir Linha" v-on:click="inserirLinhaTabela()"/>
                </section>

            </div>
        </div>
    </div>

</template>

<script>
    import colorPicker from '@caohenghu/vue-colorpicker'
    export default {
        components: {
            colorPicker
        },
        data(){
            return{
                produto:[],
                newprecos:[],
                foto:[],
                fotocertificado:[],
                review:[],
                precoUni:null,
                id:0,
                cores:[ ['branco','#FFFFFF'], ['preto','#292929'],['laranja','#F5A623'],['vermelho','#D0021B'],['azul','#4A90E2'],['verde','#417505'],['rosa','#FF00B9'],
                    ['cinza','#9B9B9B'],['amarelo','#F8E71C'],['liláis','#9013FE'],['marrom','#8B572A'],['salmão','#FF7063']],
                toggle:[
                    {
                        tamanho: '0',
                        metragem:" "
                    },

                    {
                        tamanho: '0',
                        metragem:" "
                    },

                    {
                        tamanho: '0',
                        metragem:" "
                    },

                    {
                        tamanho: '0',
                        metragem:" "
                    },

                    {
                        tamanho: '0',
                        metragem:" "
                    },

                    {
                        tamanho: '0',
                        metragem:" "
                    },
                ],
                colorBackground: '',
                suckerCanvas: null,
                suckerArea: [],
                isSucking: false,
                conta:0,
                selectedFile1: {name: null},
                selectFile2: {name: null},
                selectFile3: {name: null},
                selectFile4: {name: null},
                selectFile5: {name: null},
                selectFile6: {name: null},
                selectFile7: {name: null},
                selectFile8: {name: null},
                selectFile9: {name: null},
                selectFile10: {name: null},
                cat:'',
                result:[],
                prod:'',
                resultProd:[],
                rangoVal: [],
                precos: [],
                corSlect:[],
                color:'',
                price: 0.00,
                money: {
                    decimal: ',',
                    thousands: '',
                    prefix: 'R$ ',
                    precision: 2,
                    masked: false
                },
            }
        },
        mounted() {
           var id = localStorage.getItem('ID_ANUNCIO_PRODUTO');
            this.id = id;

            axios.get('/clubeatacado/categoria/listas').then((response)=>{


                for(var i =0; i< response.data.length; i++){
                    this.result.push( response.data[i].DS_TIPO_PRODUTO);
                }
                console.log( this.result);
            });

            axios.get('/clubeatacado/anuncio/editar/' + id).then(resp => {

                $('#nome').val(resp.data[0]['0'].anuncio['DS_ANUNCIO_PRODUTO']);
                $('#descricao').val(resp.data[0]['0'].anuncio['DS_DETALHE_PRODUTO']);
                $('#preco').val(resp.data[0]['0'].anuncio['VL_PRODUTO_UNITARIO']);
                $('#descricao2').val(resp.data[0]['0'].anuncio['DS_PRODUTO']);
                $('#minimo').val(resp.data[0]['0'].anuncio['QT_MINIMA_PEDIDO']);
                $('#stock').val(resp.data[0]['0'].anuncio['QT_DISPONIVEL']);
                $('#garantia').val(resp.data[0]['0'].anuncio['DS_GARANTIA']);
                //$('#categoria').val("resre");

                this.rangoVal = resp.data['0']['0'].precos;
                this.prod = resp.data[0]['0'].anuncio['DS_CATEGORIA_PRODUTO'];
                this.autCcomleteProd(resp.data[0]['0'].anuncio['DS_TIPO_PRODUTO']);
                this.cat = resp.data[0]['0'].anuncio['DS_TIPO_PRODUTO'];
                //fotos do anuncio
                for(var j = 1; j <= resp.data['0']['0'].foto.length; j++){

                    $('#filename'+j).removeClass("bad-input");
                    $('#close'+j).css('display', 'block');
                    $('#open'+j).css('display', 'none');
                    $('#uploadicon'+j).css('display', 'none');
                    $('#imagem'+j).css('display', 'block');
                    $('#imagem'+j).attr('src','https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'+id+'/'+resp.data['0']['0'].foto[j-1].DS_FOTO_PRODUTO);
                    this.foto.push(resp.data['0']['0'].foto[j-1].DS_FOTO_PRODUTO);
                }
                //fotos do certificado
                
                for(var f = 6; f < resp.data['1'].length+6; f++){

                    $('#filename'+f).removeClass("bad-input");
                    $('#close'+f).css('display', 'block');
                    $('#open'+f).css('display', 'none');
                    $('#uploadicon'+f).css('display', 'none');
                    $('#imagem'+f).css('display', 'block');
                    $('#imagem'+f).attr('src','https://testetendering.myappnow.com.br/clubeatacado/images/certificados/'+id+'/'+resp.data['1'][f-6].DS_FOTO_CERTIFICACAO);
                    console.log(resp.data['1'][f-6].DS_FOTO_CERTIFICACAO);
                    this.fotocertificado.push(resp.data['1'][f-6].DS_FOTO_CERTIFICACAO);
                    console.log(this.fotocertificado);
                }
                //tamanhos
                for(var i=0; i < resp.data['0']['0'].tamanho.length; i++){

                    if(resp.data['0']['0'].tamanho[i].DS_TAMANHO === 'PP'){

                        this.toggle['0'].tamanho = "PP";
                        $('#pp').val(resp.data['0']['0'].tamanho[i].DS_METRAGEM);

                    }else if(resp.data['0']['0'].tamanho[i].DS_TAMANHO === 'P'){

                        this.toggle['1'].tamanho = "P";
                        $('#P').val(resp.data['0']['0'].tamanho[i].DS_METRAGEM);

                    }else if(resp.data['0']['0'].tamanho[i].DS_TAMANHO === 'M'){

                        this.toggle['2'].tamanho = "M";
                        $('#M').val(resp.data['0']['0'].tamanho[i].DS_METRAGEM);

                    }else if(resp.data['0']['0'].tamanho[i].DS_TAMANHO === 'G'){

                        this.toggle['3'].tamanho = "G";
                        $('#G').val(resp.data['0']['0'].tamanho[i].DS_METRAGEM);

                    }else if(resp.data['0']['0'].tamanho[i].DS_TAMANHO === 'GG'){

                        this.toggle['4'].tamanho = "GG";
                        $('#GG').val(resp.data['0']['0'].tamanho[i].DS_METRAGEM);

                    }else if(resp.data['0']['0'].tamanho[i].DS_TAMANHO === 'GGG'){

                        this.toggle['5'].tamanho = "GGG";
                        $('#GGG').val(resp.data['0']['0'].tamanho[i].DS_METRAGEM);

                    }
                }
                //cores
                for(var l=0; l < resp.data['0']['0'].cor.length; l++){

                    for(var x=0; x < this.cores.length; x++) {
                        console.log(resp.data['0']['0'].cor[l].DS_COR);
                        if(this.cores[x][1] === resp.data['0']['0'].cor[l].DS_COR) {
                            this.corSlect.push(resp.data['0']['0'].cor[l].DS_COR);

                            // $(resp.data['0'].cor[l].DS_COR).css({'border-color': '#00ffff'});
                            $(resp.data['0']['0'].cor[l].DS_COR).css({'border-color': '#23a7fa'});
                            break;
                        }else{

                            if(x === this.cores.length -1 ){
                                this.cores.push([resp.data['0']['0'].cor[l].DS_COR,resp.data['0']['0'].cor[l].DS_COR]);
                            }
                        }
                    }

                }
            });


        },
        methods:{

            selectColor: function(cor) {

                if (this.corSlect.indexOf(cor) > -1) {
                    this.corSlect.splice(this.corSlect.indexOf(cor), 1);
                    console.log(cor);
                    $(cor).css({'border-color': 'transparent'});
                } else {
                    this.corSlect.push(cor);
                    console.log(cor);
                    $(cor).css({'border-color': '#23a7fa'});

                }

                console.log( this.corSlect)
            },
            search2(input) {
                axios.post('/clubeatacado/categoria/listar/produto',{
                    prod: input,
                    cat: this.cat
                }).then((response)=>{
                    console.log(response);
                    this.resultProd= response.data;

                });
                if (input.length < 1) { return [] }
                return  this.resultProd.filter( result => {
                    return  result.toLowerCase()
                        .startsWith(input.toLowerCase())
                })

            },
            showModal(){
                $(".modal").addClass("is-active");
                $(".closeModal").click(function() {
                    $(".modal").removeClass("is-active");
                });
            },
            autCcomleteProd(c){
                this.resultProd= [];
                axios.post('/clubeatacado/categoria/listar/produto',{
                    cat: c
                }).then((response)=>{
                    for(var i =0; i< response.data.length; i++){
                        this.resultProd.push( response.data[i].DS_CATEGORIA_PRODUTO);
                    }
                });
                this.cat = c;
            },
            addProd(prod){
                this.prod= prod;

            },
            inserirLinhaTabela: function () {

                var r = this.colorBackground.rgba.r.toString(16);
                var g = this.colorBackground.rgba.g.toString(16);
                var b = this.colorBackground.rgba.b.toString(16);
                var a = Math.round(this.colorBackground.rgba.a * 255).toString(16);

                if (r.length == 1)
                    r = "0" + r;
                if (g.length == 1)
                    g = "0" + g;
                if (b.length == 1)
                    b = "0" + b;
                if (a.length == 1)
                    a = "0" + a;

                var corHex =  "#" + r + g + b + a;
                var cor = [corHex,corHex];

                this.cores.push(cor);

            },
            changeColor(color) {
                const {rgba: {r, g, b, a}} = color;
                this.color = `rgba(${r, g, b, a})`;
                this.colorBackground = color;

            },
            openSucker(isOpen) {
                if (isOpen) {
                    // ... canvas be created
                    // this.suckerCanvas = canvas
                    // this.suckerArea = [x1, y1, x2, y2]
                } else {
                    // this.suckerCanvas && this.suckerCanvas.remove
                }
            },
            onFileChanged1: function (event) {
                this.selectedFile1 = event.target.files[0];
                this.url1 = URL.createObjectURL(this.selectedFile1);
                console.log(this.selectedFile1.size);
                if(this.selectedFile1.size < 2000000){
                    if (this.selectedFile1) {
                        $('#filename1').removeClass("bad-input");
                        $('#close1').css('display', 'block');
                        $('#open1').css('display', 'none');
                        $('#uploadicon1').css('display', 'none');
                        $('#imagem1').css('display', 'block');
                        $('#imagem1').attr('src', this.url1);
                    }

                    const formData = new FormData();
                    if (this.selectedFile1 !== null) {
                        formData.append('myFile', this.selectedFile1, this.selectedFile1.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.foto['0'] = res.data;

                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged2: function (event2) {
                this.selectFile2 = event2.target.files[0];
                console.log(this.selectFile2);
                this.url2 = URL.createObjectURL(this.selectFile2);
                console.log(this.url2);
                if(this.selectFile2.size < 2000000){
                    if (this.selectFile2) {
                        $('#filename2').removeClass("bad-input");
                        $('#close2').css('display', 'block');
                        $('#open2').css('display', 'none');
                        $('#uploadicon2').css('display', 'none');
                        $('#imagem2').css('display', 'block');
                        $('#imagem2').attr('src', this.url2);
                    }

                    const formData = new FormData();

                    formData.append('myFile', this.selectFile2, this.selectFile2.name);
                    if (this.selectFile2 !== null) {
                        formData.append('myFile', this.selectFile2, this.selectFile2.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.foto['1'] = res.data;
                        });
                    }
                    console.log(this.selectFile2.name);
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged3: function (event3) {
                this.selectFile3 = event3.target.files[0];
                console.log(this.selectFile3);
                this.url3 = URL.createObjectURL(this.selectFile3);
                console.log(this.url3);
                if(this.selectFile3.size < 2000000){
                    if (this.selectFile3) {
                        $('#filename3').removeClass("bad-input");
                        $('#close3').css('display', 'block');
                        $('#open3').css('display', 'none');
                        $('#uploadicon3').css('display', 'none');
                        $('#imagem3').css('display', 'block');
                        $('#imagem3').attr('src', this.url3);
                    }

                    const formData = new FormData();
                    if (this.selectFile3 !== null) {
                        formData.append('myFile', this.selectFile3, this.selectFile3.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.foto['2'] = res.data;
                        });
                    }
                    console.log(this.selectFile3.name);
                }else{
                    alert("Imagem selecionada é muito grande");
                }
            },
            onFileChanged4: function (event4) {
                this.selectFile4 = event4.target.files[0];
                console.log(this.selectFile4);
                this.url4 = URL.createObjectURL(this.selectFile4);
                console.log(this.url4);
                if(this.selectFile4.size < 2000000){
                    if (this.selectFile4) {
                        $('#filename4').removeClass("bad-input");
                        $('#close4').css('display', 'block');
                        $('#open4').css('display', 'none');
                        $('#uploadicon4').css('display', 'none');
                        $('#imagem4').css('display', 'block');
                        $('#imagem4').attr('src', this.url4);
                    }

                    const formData = new FormData();
                    if (this.selectFile4 !== null) {
                        formData.append('myFile', this.selectFile4, this.selectFile4.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.foto['3'] = res.data;
                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }
            },
            onFileChanged5: function (event5) {
                this.selectFile5 = event5.target.files[0];
                console.log(this.selectFile5);
                this.url5 = URL.createObjectURL(this.selectFile5);
                console.log(this.url5);
                if(this.selectFile5.size < 2000000){
                    if (this.selectFile5) {
                        $('#filename5').removeClass("bad-input");
                        $('#close5').css('display', 'block');
                        $('#open5').css('display', 'none');
                        $('#uploadicon5').css('display', 'none');
                        $('#imagem5').css('display', 'block');
                        $('#imagem5').attr('src', this.url5);
                    }

                    const formData = new FormData();
                    if (this.selectFile5 !== null) {
                        formData.append('myFile', this.selectFile5, this.selectFile5.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.foto['4'] = res.data;
                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged6: function (event6) {
                this.selectFile6 = event6.target.files[0];
                console.log(this.selectFile6);
                this.url6 = URL.createObjectURL(this.selectFile6);
                console.log(this.url6);
                if(this.selectFile6.size < 2000000){
                    if (this.selectFile6) {
                        $('#filename6').removeClass("bad-input");
                        $('#close6').css('display', 'block');
                        $('#open6').css('display', 'none');
                        $('#uploadicon6').css('display', 'none');
                        $('#imagem6').css('display', 'block');
                        $('#imagem6').attr('src', this.url6);
                    }

                    const formData = new FormData();
                    if (this.selectFile6 !== null) {
                        formData.append('myFile', this.selectFile6, this.selectFile6.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.fotocertificado['0'] = res.data;
                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged7: function (event7) {
                this.selectFile7 = event7.target.files[0];
                console.log(this.selectFile7);
                this.url7 = URL.createObjectURL(this.selectFile7);
                console.log(this.url7);
                if(this.selectFile7.size < 2000000){
                    if (this.selectFile7) {
                        $('#filename7').removeClass("bad-input");
                        $('#close7').css('display', 'block');
                        $('#open7').css('display', 'none');
                        $('#uploadicon7').css('display', 'none');
                        $('#imagem7').css('display', 'block');
                        $('#imagem7').attr('src', this.url7);
                    }

                    const formData = new FormData();
                    if (this.selectFile7 !== null) {
                        formData.append('myFile', this.selectFile7, this.selectFile7.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.fotocertificado['1'] = res.data;
                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }
            },
            onFileChanged8: function (event8) {
                this.selectFile8 = event8.target.files[0];
                console.log(this.selectFile8);
                this.url8 = URL.createObjectURL(this.selectFile8);
                console.log(this.url8);
                if(this.selectFile8.size < 2000000){
                    if (this.selectFile8) {
                        $('#filename8').removeClass("bad-input");
                        $('#close8').css('display', 'block');
                        $('#open8').css('display', 'none');
                        $('#uploadicon8').css('display', 'none');
                        $('#imagem8').css('display', 'block');
                        $('#imagem8').attr('src', this.url8);
                    }

                    const formData = new FormData();
                    if (this.selectFile8 !== null) {
                        formData.append('myFile', this.selectFile8, this.selectFile8.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res=>{
                            this.fotocertificado['2'] = res.data;
                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }
            },
            onFileChanged9: function (event9) {
                this.selectFile9 = event9.target.files[0];
                console.log(this.selectFile9);
                this.url9 = URL.createObjectURL(this.selectFile9);
                console.log(this.url9);
                if(this.selectFile9.size < 2000000) {
                    if (this.selectFile9) {
                        $('#filename9').removeClass("bad-input");
                        $('#close9').css('display', 'block');
                        $('#open9').css('display', 'none');
                        $('#uploadicon9').css('display', 'none');
                        $('#imagem9').css('display', 'block');
                        $('#imagem9').attr('src', this.url9);
                    }

                    const formData = new FormData();
                    if (this.selectFile9 !== null) {
                        formData.append('myFile', this.selectFile9, this.selectFile9.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res => {
                            this.fotocertificado['3'] = res.data;
                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged10: function (event10) {
                this.selectFile10 = event10.target.files[0];
                console.log(this.selectFile10);
                this.url10 = URL.createObjectURL(this.selectFile10);
                console.log(this.url10);
                if(this.selectFile10.size < 2000000) {
                    if (this.selectFile10) {
                        $('#filename10').removeClass("bad-input");
                        $('#close10').css('display', 'block');
                        $('#open10').css('display', 'none');
                        $('#uploadicon10').css('display', 'none');
                        $('#imagem10').css('display', 'block');
                        $('#imagem10').attr('src', this.url10);
                    }

                    const formData = new FormData();
                    if (this.selectFile10 !== null) {
                        formData.append('myFile', this.selectFile10, this.selectFile10.name);
                        axios.post('/clubeatacado/anuncio/upload/imagem/anuncio', formData).then(res => {
                            this.fotocertificado['4'] = res.data;
                        });
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }
            },
             remover(id) {
                var foto;
                if(id < 5){
                    foto = this.foto[id];  
                    this.foto.splice((id-1), 1); 
                }else{
                   foto = this.fotocertificado[id-6];  
                   this.fotocertificado.splice((id-6), 1);
                }
                    $('#filename'+id).removeClass("bad-input");
                    $('#close'+id).css('display', 'none');
                    $('#open'+id).css('display', 'block');
                    $('#uploadicon'+id).css('display', 'block');
                    $('#imagem'+id).css('display', 'none');
                    $('#imagem'+id).attr('src', '');
               
            },
            addRangpPreco: function(){
                this.rangoVal.push({
                    'QT_FINAL':null,
                    'QT_INICIAL':null,
                    'VL_PRODUTO':null
                })
            },
            concluir() {

                this.toggle[0].metragem= $('#pp').val(),
                    this.toggle[1].metragem= $('#P').val(),
                    this.toggle[2].metragem= $('#M').val(),
                    this.toggle[3].metragem= $('#G').val(),
                    this.toggle[4].metragem= $('#GG').val(),
                    this.toggle[5].metragem= $('#GGG').val()


                if (!$('#nome').val()) {
                    alert("campos em branco");
                    $('#nome').css('border-bottom', '1px solid red');
                } else if (!$('#descricao').val()) {
                    alert("campos em branco");
                    $('#descricao').css('border-bottom', '1px solid red');
                } else if (this.cat === '') {
                    alert("campos em branco");
                    $('#cat').css('border-bottom', '1px solid red');
                } else if (this.prod === '') {
                    alert("campos em branco");
                    $('#pord').css('border-bottom', '1px solid red');
                } else if ($('#preco').val() === '' && $('#rangoPreco'+1).val() === '') {
                    alert("campos em branco");
                    $('#preco').css('border-bottom', '1px solid red');
                }else if (!$('#stock').val() === '') {
                    alert("campos em branco");
                    $('#stock').css('border-bottom', '1px solid red');
                }else if (!$('#minimo').val()) {
                    alert("campos em branco");
                    $('#minimo').css('border-bottom', '1px solid red');
                }

                this.input = [
                    $('#nome').val(),
                    $('#descricao').val(),
                    this.cat,
                    this.prod,
                    $('#preco').val(),
                    $('#stock').val(),
                    $('#minimo').val(),
                    this.toggle,
                    $('#descricao2').val(),
                    this.corSlect,
                    this.foto,
                    this.fotocertificado

                ];
                this.precos = [];
                for(var i =0; i< this.rangoVal.length; i++){
                    function preco(temp){
                        this.inicio = temp[0];
                        this.fim = temp[1];
                        this.preco = temp[2];

                    }
                    var temp = [$('#qtInicial'+i).val(), $('#qtFinal'+i).val(),$('#rangoPreco'+i).val()];

                    preco = new preco(temp);

                    this.precos.push(preco);

                }
                this.input.push(this.precos);
                this.input.push(this.id);
                this.input.push( $('#garantia').val());


                console.log(this.fotocertificado.length);

                if (this.foto.length === 0) {
                    alert("Selecione no mínimo uma foto do anúncio");
                    return false

                }
                if (this.fotocertificado.length === 0) {
                    alert("Selecione no mínimo uma foto do certificado");
                    return false

                }
                axios.post('/clubeatacado/anuncio/editar', {
                    input: this.input

                })
                    .then(response => {
                        if(response.data === 0){
                            alert("Erro ao atualizar anúncio");
                            window.open("/clubeatacado/usuario/meusanuncios",'_Self');
                        }else{
                            alert("Anúncio atualizado com sucesso");
                            window.open("/clubeatacado/usuario/meusanuncios",'_self');
                        }

                    });
            }
        }
    }
</script>



