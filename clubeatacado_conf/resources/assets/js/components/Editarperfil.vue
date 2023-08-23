<template>
        <div>
            <div class="column" v-for="item in list" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                <div class="card" style="width: 825px; background:#fafafa;">
                    <div class="card-content">
                        <div class="circulo" style="background:#fafafa;position:relative; top: 30px; left:40px; border:none">

                            <img  v-if="item.DS_FOTO_COMPRADOR === item.DS_FOTO_COMPRADOR && !url" :src="'/clubeatacado/images\\usuarios\\'+ item.ID_COMPRADOR +'\\'+item.DS_FOTO_COMPRADOR" alt="" onerror="this.onerror=null;this.src='/clubeatacado/images/uploadImage.png';"/>
                            <img v-if="url" :src="url" alt="" />
                        </div>
                        <div class="file is-boxed" style="left: 200px; bottom: 50px;">
                            <label class="file-label" style="border-radius: 30px; ">
                                <input class="file-input" @change="onFileChanged" type="file" name="image" id="foto">
                                <span class="file-cta" style="background-color: #D73C38">
                                      <span class="file-label">
                                        SUBIR UMA FOTO
                                      </span>
                                    </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 825px; background:#fafafa; margin-top: 20px">
                    <div class="card-content">
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <div class="control">
                                <label class="label" style="color:#525763; font-weight:normal">DADOS DO USUÁRIO</label>
                                <input class="input" type="text" maxlength="50" id="nome" style="font-size: 16px; background-color:#E5E8ED;width:60%" placeholder="Nome do contato*"
                                       v-model="item.DS_NOME" >
                            </div>
                        </div>
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <div class="control">
                                <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:60%" maxlength="50" placeholder="Sobrenome*" id="sobrenome" v-model="item.DS_SOBRENOME" >
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="field has-text-left" style="padding-left: 30px;">
                                    <div class="control">
                                        <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;width:20%" maxlength="3" placeholder="DDD" id="ddd" v-model="item.NR_DDD_TELEFONE">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field has-text-left" style="position:relative; right:280px;">
                                    <div class="control">
                                        <input class="input" type="telefone" style="font-size: 16px; background-color:#E5E8ED;width:80%" maxlength="9" placeholder="Telefone*"
                                               v-model="item.NR_TELEFONE" id="telefone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <div class="control">
                                <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:60%" maxlength="50" placeholder="E-mail*"
                                       id="email" v-model="item.DS_EMAIL">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 825px; background:#fafafa; margin-top: 20px">
                    <div class="card-content">
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <label class="label" style="color:#525763; font-weight:normal">ENDEREÇO</label>
                            <div class="control">
                                <input class="input" style="font-size: 16px; background-color:#E5E8ED; width:92%" maxlength="100" type="text" placeholder="Endereço*" id="endereco" v-model="item.DS_ENDERECO">
                            </div>
                        </div>
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <div class="control">
                                <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:92%" maxlength="100" placeholder="Complemento" id="complemento" v-model="item.DS_COMPLEMENTO">
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <div class="field has-text-left" style="padding-left: 30px;">
                                    <div class="control">
                                        <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:35%" placeholder="Número*" id="numero" maxlength="50" v-model="item.NR_ENDERECO">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field has-text-left" style="width: 82%;position:relative; right:230px;">
                                    <div class="control">
                                        <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;" placeholder="CEP*" id="cep" maxlength="11" v-model="item.NR_CEP">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="columns">

                            <div class="field has-text-left"
                                 style="margin-left:40px;  width: 290px; color: #dbdbdb">

                                <div class="" style="background-color: #e5e8ed;width: 35%;margin-top: 25px; " id="uf">
                                    <v-select   placeholder="UF"
                                                :options="result"
                                                @input="autCcomleteProd"
                                                v-model="uf"
                                    ></v-select>
                                </div>
                            </div>
                            <div class="field has-text-left"
                                 style="margin-left: -20%; width: 290px; color: #dbdbdb">
                                <div class="control has-icons-left" style="background-color: #e5e8ed;margin-top: 25px">
                                    <v-select   placeholder="Cidade"
                                                id="cidade"
                                                :options="resultProd"
                                                v-model="cidade"
                                    ></v-select>
                                </div>
                            </div>
                            <!--<div class="column">-->
                                <!--<div class="field has-text-left" style="padding-left: 30px;">-->
                                    <!--<div class="control">-->
                                        <!--<input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;width:20%" placeholder="UF" id="uf" v-model="item.DS_UF">-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                            <!--<div class="column">-->
                                <!--<div class="field has-text-left" style="width: 77%;position:relative; left:-58%;">-->
                                    <!--<div class="control">-->
                                        <!--<input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;" placeholder="Cidade*" id="cidade" v-model="item.DS_CIDADE">-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                        </div>

                    </div>
                </div>

                <div class="card" style="width: 825px; background:#fafafa; margin-top: 20px">
                    <div class="card-content">
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <label class="label" style="color:#525763; font-weight:normal">Senha</label>
                            <div class="control">
                                <input class="input" style="font-size: 16px; background-color:#E5E8ED; width:60%" id="senha"  type="password" placeholder="Nova senha">
                            </div>
                        </div>
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <div class="control">
                                <input class="input" style="font-size: 16px; background-color:#E5E8ED;width:60%" type="password"  placeholder="Confirme a senha">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 825px; background:#fafafa; margin-top: 20px" id="showmore">
                    <div class="card-content">
                        <div class="field has-text-left" style="padding-left: 30px;">
                            <label class="label"><a style="font-size: 14px; color:#23A7FB" href="#" v-on:click="showmore" ><u>Informação complementar</u></a></label>
                        </div>
                    </div>
                </div>

                <div class="column" id="maisinfo" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;padding-left: 0px;">
                    <div class="card" style="width: 825px; background:#fafafa;">
                        <div class="card-content">
                            <div class="field has-text-left" style="padding-left: 30px;">
                                <label class="label" style="color:#525763; font-size: 14px; font-weight:normal">EMPRESA</label>
                                <div class="control">
                                    <input class="input" style="font-size: 16px; background-color:#E5E8ED; width:60%" type="text" maxlength="100" id="nomeFantasia" placeholder="Nome da empresa *"
                                           v-model="item.DS_NOME_FANTASIA" >
                                </div>
                            </div>
                            <div class="field has-text-left" style="padding-left: 30px;">
                                <div class="control">
                                    <input class="input" type="text" maxlength="10" id="cnpj" style="font-size: 16px; background-color:#E5E8ED;width:60%" placeholder="CNPJ"
                                           v-model="item.NR_CNPJ">
                                </div>
                            </div>

                            <div class="field has-text-left" style="padding-left: 30px;">
                                <div class="control">
                                    <div class="select">
                                        <select style="font-size: 16px;padding-right: 150px;color:#868C99; background-color:#E5E8ED;" >
                                            <option>Categoria da empresa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field has-text-left" style="padding-left: 30px; margin-top: 24px">

                                <div class="control">
                                    <div class="select">
                                        <select style="font-size: 16px;padding-right: 320px;color:#868C99; background-color:#E5E8ED;" >
                                            <option>Tipo de negócio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field has-text-left" style="padding-left: 30px; margin-top: 24px">
                                <div class="control">
                                    <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;width:20%"  placeholder="Num. funcionarios" id="nrfuncionarios" v-model="item.QT_EMPREGADOS">
                                </div>
                            </div>

                            <div class="field has-text-left" style="padding-left: 30px;margin-top: 24px">
                                <div class="control">
                                    <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;width:60%" placeholder="Razao Social" maxlength="100" id="rzSocila" v-model="item.DS_RAZAO_SOCIAL">
                                </div>
                            </div>


                            <div class="field has-text-left" style="padding-left: 30px;">
                                <label class="label" style="color:#525763; font-weight:normal; font-size:14px">ENDEREÇO EMPRESA</label>
                                <div class="control">
                                    <input class="input" style="font-size: 16px; background-color:#E5E8ED; width:60%" type="text" placeholder="Endereço*" maxlength="10" id="enderecoEmp" v-model="item.enderecoEmp">
                                </div>
                            </div>
                            <div class="field has-text-left" style="padding-left: 30px;">
                                <div class="control">
                                    <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:60%" placeholder="Complemento" maxlength="100" id="complementoEmp" v-model="item.complementoEmp">
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <div class="field has-text-left" style="padding-left: 30px;">
                                        <div class="control">
                                            <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:35%" placeholder="Número*" maxlength="10" id="numeroEmp" v-model="item.NREmp">
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field has-text-left" style="width: 82%;position:relative; right:230px;">
                                        <div class="control">
                                            <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;" placeholder="CEP*" maxlength="11" id="cepEmp" v-model="item.CEPEmp">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="field has-text-left"
                                     style="margin-left:40px;  width: 290px; color: #dbdbdb">

                                    <div class="" style="background-color: #e5e8ed;width: 35%;margin-top: 25px; " id="ufEmp">
                                        <v-select   placeholder="UF"
                                                    :options="result"
                                                    @input="autCcomleteProd"
                                                    v-model="ufEmp"
                                        ></v-select>
                                    </div>
                                </div>
                                <div class="field has-text-left"
                                     style="margin-left: -20%; width: 290px; color: #dbdbdb">
                                    <div class="control has-icons-left" style="background-color: #e5e8ed;margin-top: 25px">
                                        <v-select   placeholder="Cidade"
                                                    id="cidadeEmp"
                                                    :options="resultProd"
                                                    v-model="cidadeEmp"
                                        ></v-select>
                                    </div>
                                </div>
                                <!--<div class="column">-->
                                    <!--<div class="field has-text-left" style="padding-left: 30px;">-->
                                        <!--<div class="control">-->
                                            <!--<input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;width:20%" placeholder="UF" id="ufEmp" v-model="item.DS_UF">-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<div class="column">-->
                                    <!--<div class="field has-text-left" style="width: 95%;position:relative; right:280px;">-->
                                        <!--<div class="control">-->
                                            <!--<input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;" placeholder="Cidade*" id="cidadeEmp" v-model="item.DS_CIDADE">-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                            </div>

                            <!--<div class="field has-text-left" style="padding-left: 30px;margin-top: 24px">-->
                                <!--<div class="control">-->
                                    <!--<div class="select">-->
                                        <!--<select style="font-size: 16px;padding-right: 366px;color:#868C99; background-color:#E5E8ED;">-->
                                            <!--<option>Facebook</option>-->
                                        <!--</select>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                            <div class="field has-text-left" style="padding-left: 30px;">
                                <label class="label" style="color:#525763; font-weight:normal; font-size:14px">CIDADE ATENDIDA</label>

                            <div style="display: flex">
                                <div class="field has-text-left"
                                     style="width: 290px; color: #dbdbdb">

                                    <div class="" style="background-color: #e5e8ed;width: 35%;margin-top: 25px; " >
                                        <v-select   placeholder="UF"
                                                    :options="result"
                                                    @input="autCcomleteProd"
                                                    v-model="ufAtendia"
                                                    id="ufAtendia"
                                        ></v-select>
                                    </div>
                                </div>
                                <div class="field has-text-left"
                                     style="margin-left: -20%; width: 290px; color: #dbdbdb">
                                    <div class="control has-icons-left" style="background-color: #e5e8ed;margin-top: 25px">
                                        <v-select   placeholder="Cidade"
                                                    id="cidAtendida"
                                                    :options="resultProd"
                                                    v-model="cidAtendida"
                                        ></v-select>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="field has-text-left" style="margin-left: 30px; margin-top: 24px; width: 290px;border-style: solid; border-width: 0px 0px 0px 0px; color: #dbdbdb">
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#DBDBDB; border-width: 0px 0px 1px 0px;font-size: 14px;" id="facebook" type="url" placeholder="URL" maxlength="100" v-model="item.DS_FACEBOOK">
                                    <span class="icon is-small has-text-info is-left" style="height: 27px; width: 20px; position:static;" >
                                            <i style="position: absolute;margin-top: -20%;"  class="fab fa-facebook-square"></i>
                                        </span>
                                </div>
                            </div>

                            <div class="field has-text-left" style="margin-left: 30px; width: 290px;border-style: solid; border-width: 0px 0px 0px 0px; color: #dbdbdb">
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#DBDBDB;border-width: 0px 0px 1px 0px;font-size: 14px;" id="instagram" type="url" placeholder="URL" maxlength="100" v-model="item.DS_INSTAGRAM">
                                    <span class="icon is-small has-text-info is-left" style="height: 27px; width: 20px; position:static;" >
                                            <i style="position: absolute;margin-top: -20%;"  class="fab fa-instagram"></i>
                                        </span>
                                </div>
                            </div>

                            <div class="field has-text-left" style="margin-left: 30px; width: 290px;border-style: solid; border-width: 0px 0px 0px 0px; color: #dbdbdb">
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#DBDBDB;border-width: 0px 0px 1px 0px;font-size: 14px;" id="gmail" type="url" placeholder="URL" maxlength="100" v-model="item.DS_GMAIL">
                                    <span class="icon is-small has-text-info is-left" style="height: 27px; width: 20px; position:static;" >
                                            <i style="position: absolute;margin-top: -20%;"  class="fab fa-google-plus"></i>
                                        </span>
                                </div>
                            </div>


                            <div class="field has-text-left" style="padding-left: 30px;width: 55%;margin-top: 40px">
                                <label class="label" style="color:#525763; font-weight:normal">Informação da empresa</label>
                                <div class="control">
                                    <textarea class="textarea" maxlength="100" id="empresaInfo" v-model="item.tamanhoFab" style="background-color:#E5E8ED;"></textarea>
                                </div>
                            </div>

                            <div class="card-content" style="margin-left: -3%;">
                                <label class="label" style="color:#525763; font-weight:normal;text-align: left;margin-left: 30px;">INFORMAÇÃO DE CONTATO</label>
                                <div class="card-content" style="margin-left: -3%;">
                                    <div class="field has-text-left" style="padding-left: 30px;">
                                        <div class="control">

                                            <input class="input" type="text" id="nomeContato"  maxlength="50" style="font-size: 16px; background-color:#E5E8ED;width:59%" placeholder="Nome do contato*"
                                                   v-model="item.nomeContato" >
                                        </div>
                                    </div>
                                    <div class="field has-text-left" style="padding-left: 30px;">
                                        <div class="control">
                                            <input class="input" type="text" maxlength="50" style="font-size: 16px; background-color:#E5E8ED;width:59%" placeholder="Sobrenome*" id="sobrenomeContato" v-model="item.sobrenomeContato" >
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <div class="field has-text-left" style="padding-left: 30px;">
                                                <div class="control">
                                                    <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;width:20%" placeholder="DDD" maxlength="3" id="dddContato" v-model="item.dddContato">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <div class="field has-text-left" style="position:relative; right:280px;">
                                                <div class="control">
                                                    <input class="input" type="telefone" style="font-size: 16px; background-color:#E5E8ED;width:87%" placeholder="Telefone"
                                                           v-model="item.telContato" maxlength="9" id="telefoneContato">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field has-text-left" style="padding-left: 30px;">
                                        <div class="control">
                                            <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:59%" placeholder="E-mail*"
                                                   id="emailContato" maxlength="50" v-model="item.emailContato">
                                        </div>
                                    </div>
                                    <div class="field has-text-left" style="padding-left: 30px;">
                                        <div class="control">
                                            <input class="input" type="text" id="cargo" style="font-size: 16px; background-color:#E5E8ED;width:59%" placeholder="Cargo"
                                                   v-model="item.cargo" maxlength="50" >
                                        </div>
                                    </div>
                                    <div class="field has-text-left" style="padding-left: 30px;">
                                        <div class="control">
                                            <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:59%" placeholder="WhatsAap" maxlength="11" id="whatsaapContato" v-model="item.whatsassp" >
                                        </div>
                                    </div>
                                    <div class="field has-text-left" style="padding-left: 30px;">
                                        <div class="control">
                                            <input class="input" type="password" maxlength="50" style="font-size: 16px; background-color:#E5E8ED;width:59%" placeholder="Senha" id="senhaContato">
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                                <!--<div class="field has-text-left" style="    margin-left: 30px;display: flex; width: 100%;">-->
                                    <!--<label class="label"><a style="font-size: 16px; color:#23A7FB" v-on:click="addContato()">Adicionar outro Contato</a></label>-->
                                    <!--<label class="label" style="margin-left: auto;" v-if="rangoCont.length > 1"><a style="font-size: 16px; color:#23A7FB;" v-on:click="RemoverContato()">Remover Contato</a></label>-->
                                <!--</div>-->
                            </div>


                            <div class="field has-text-left" style="        padding-left: 30px;
        width: 90%;
        margin-top: 24px;
        margin-bottom: 10%
">
                                <label class="label" style="color:#525763; font-weight:normal">Fotos da fábrica</label>
                                <div class="file is-white is-boxed" style="margin-top: 40px" >
                                    <div class="upload-image is-pulled-left  " v-if="foto1 === 'nao'">
                                        <label for="file" class="label-file-img" >
                                            <img id="uploadicon1" class="upload-icon" src="/clubeatacado/images/photo.png">
                                            <div class="image-wrapper">

                                                <img id="imagem1" src="">
                                            </div>
                                            <a id="close1" class="button-close close" name="uploadImage"
                                               style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open1" class="button-open open" name="uploadImage"
                                            ><i class="fa fa-plus-circle fa-2x"
                                                aria-hidden="true"></i></a>
                                        </label>
                                        <p id="filename1" class="file-name"></p>
                                        <input id="file" name="image1" type="file" class="input-file"
                                               @change="onFileChanged1">
                                        <div id="horizontal1" class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input id="input1" type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left  " v-else>
                                        <label for="file" class="label-file-img">
                                            <img id="uploadicon1" style="display: none" class="upload-icon" src="/clubeatacado/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem1"  style="display: block" :src="url1">
                                            </div>
                                            <a id="close1" class="button-close close" name="uploadImage"
                                               style="display:block; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                            <a id="open1"  style="display: none;position: initial;margin-left: 88%;margin-top: -15%;" class="button-open open" name="uploadImage"
                                            ><i class="fa fa-plus-circle fa-2x"
                                                aria-hidden="true"></i></a>
                                        </label>
                                        <p id="filename1" class="file-name"></p>
                                        <input id="file" name="image1" type="file" class="input-file"
                                               @change="onFileChanged1">
                                        <div id="horizontal1" class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input id="input1" type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div><!-- upload image -->

                                    <div class="upload-image is-pulled-left " v-if="foto2 === 'nao'">
                                        <label for="file2" class="label-file-img">
                                            <img id="uploadicon2" class="upload-icon" src="/clubeatacado/images/photo.png">

                                            <div class="image-wrapper">
                                                <img id="imagem2" src="">
                                            </div>
                                            <a id="close2" class="button-close close" name="uploadImage"
                                               style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open2" class="button-open open" name="uploadImage"
                                               style="display: block;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                        </label>

                                        <p class="file-name"></p>
                                        <input id="file2" name="image2" type="file" class="input-file"
                                               @change="onFileChanged2">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left " v-else>
                                        <label for="file2" class="label-file-img">
                                            <img id="uploadicon2" class="upload-icon" style="display:none;"  src="/clubeatacado/images/photo.png">

                                            <div class="image-wrapper">
                                                <img id="imagem2" style="display:block;" :src="url2">
                                            </div>
                                            <a id="close2" class="button-close close" name="uploadImage"
                                               style="display:block; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                            <a id="open2" class="button-open open" name="uploadImage"
                                               style="display: none;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                        </label>

                                        <p class="file-name"></p>
                                        <input id="file2" name="image2" type="file" class="input-file"
                                               @change="onFileChanged2">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div><!-- upload image -->

                                    <div class="upload-image is-pulled-left " v-if="foto3 === 'nao'">
                                        <label for="file3" class="label-file-img" >
                                            <img id="uploadicon3" class="upload-icon" src="/clubeatacado/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem3" src="">
                                            </div>
                                            <a id="close3" class="button-close close" name="uploadImage"
                                               style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open3" class="button-open open" name="uploadImage"
                                               style="display: block;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                        </label>
                                        <p class="file-name"></p>
                                        <input id="file3" type="file" class="input-file" name="image3"
                                               @change="onFileChanged3">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left "  v-else>
                                        <label for="file3" class="label-file-img">
                                            <img id="uploadicon3" class="upload-icon" style="display:none;" src="/clubeatacado/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem3" style="display:block;" :src="url3">
                                            </div>
                                            <a id="close3" class="button-close close" name="uploadImage"
                                               style="display:block; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                            <a id="open3" class="button-open open" name="uploadImage"
                                               style="display: none;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                        </label>
                                        <p class="file-name"></p>
                                        <input id="file3" type="file" class="input-file" name="image3"
                                               @change="onFileChanged3">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div><!-- upload image -->

                                    <div class="upload-image is-pulled-left "  v-if="foto4 === 'nao'">
                                        <label for="file4" class="label-file-img">
                                            <img id="uploadicon4" class="upload-icon" src="/clubeatacado/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem4" src="">
                                            </div>
                                            <a id="close4" class="button-close close" name="uploadImage"
                                               style="display:none; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open4" class="button-open open" name="uploadImage"
                                               style="display: block;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                        </label>
                                        <p class="file-name"></p>
                                        <input id="file4" type="file" class="input-file" name="image4"
                                               @change="onFileChanged4">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left " v-else>
                                        <label for="file4" class="label-file-img">
                                            <img id="uploadicon4" style="display:none;" class="upload-icon" src="/clubeatacado/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem4" style="display:block;" :src="url4">
                                            </div>
                                            <a id="close4" class="button-close close" name="uploadImage"
                                               style="display:block; position: initial; margin-left: 92%; margin-top: -88%;"><i class="fa fa-times-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                            <a id="open4" class="button-open open" name="uploadImage"
                                               style="display: none;position: initial;margin-left: 88%;margin-top: -15%;"><i class="fa fa-plus-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                        </label>
                                        <p class="file-name"></p>
                                        <input id="file4" type="file" class="input-file" name="image4"
                                               @change="onFileChanged4">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block" style="display: none">
                                            <input type="submit" value="Upload" class="input-submit">
                                        </div>
                                    </div><!-- upload image -->
                                    <button class="button" aria-haspopup="true" style="margin-top: auto; margin-left: auto; background: rgba(246, 254, 249, 0); border:none">
                                        <img src="/clubeatacado/css/img/down.png" style=" transform: scaleY(-1);" v-on:click="showhide">
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="field is-grouped" style="margin-top: 80px;margin-bottom: 80px">
                    <p class="control">
                        <a class="button gradiente" style="color:#525763;background-color:#FFFFFF;box-shadow:1px 1px #A8ABB1, 0px 0px 0 1px #A8ABB1; width:281px; height: 48px;" href="/clubeatacado/">Cancelar</a>
                    </p>
                    <p class="control">
                        <a class="button  is-block has-button-yellow is-5  is-pulled-left is-medium has-text-weight-bold "
                           style="margin-bottom:10rem; margin-left:1em; width: 281px" v-on:click="updateUser" > Salvar alterações</a>
                    </p>
                </div>
            </div>
        </div>
</template>
<style>
    #maisinfo{
        display: none;
    }
    #vs1__listbox{
        overflow-y: scroll;
        height: 100px;
    }
    #vs2__listbox{
        overflow-y: scroll;
        height: 100px;
    }
    #vs3__listbox{
        overflow-y: scroll;
        height: 100px;
    }
    #vs4__listbox{
        overflow-y: scroll;
        height: 100px;
    }
    #vs5__listbox{
        overflow-y: scroll;
        height: 100px;
    }
    #vs6__listbox{
        overflow-y: scroll;
        height: 100px;
    }
</style>
<script>

    export default {
        props: ['list'],
        data: function () {
            return {
                urlpath: window.location.pathname,
                inicio: 12,
                itensList: [],
                selectFile: null,
                selectedFile1: {name: null},
                selectFile2: {name: null},
                selectFile3: {name: null},
                selectFile4: {name: null},
                url: null,
                url1: null,
                url2: null,
                url3: null,
                url4: null,
                senha: '',
                confsenha: '',
                urlfoto: '',
                foto: '',
                foto1:'',
                foto2:'',
                foto3:'',
                foto4:'',
                uf: '',
                ufs: [],
                cidades: [],
                cidade:'',
                result:[],
                resultProd:[],
                ufAtendia:'',
                cidAtendida:'',
                ufEmp:'',
                cidadeEmp: '',
                fotos:[]
            }
        },
        created() {
            this.itensList = this.list;
             var foto1 = this.itensList['0'].foto['0']['0'];
             var foto2 = this.itensList['0'].foto['0']['1'];
             var foto3 = this.itensList['0'].foto['0']['2'];
             var foto4 = this.itensList['0'].foto['0']['3'];
             if(!this.itensList['0'].foto['0']['0']){
                 this.foto1 = 'nao';

             }else{
                 this.foto1 = 'sim';
                 this.fotos.push(this.itensList['0'].foto['0']['0'].DS_FOTO_PRODUTOR);
                 this.url1 = "https://testetendering.myappnow.com.br/clubeatacado\\images\\empresas\\" + this.itensList['0'].ID_COMPRADOR + "\\" + this.itensList['0'].foto['0']['0'].DS_FOTO_PRODUTOR;
             }
            if(!this.itensList['0'].foto['0']['1']){
                this.foto2 = 'nao';
            }else{
                this.foto2 = 'sim';
                this.fotos.push(this.itensList['0'].foto['0']['1'].DS_FOTO_PRODUTOR);
                this.url2= "https://testetendering.myappnow.com.br/clubeatacado\\images\\empresas\\"+this.itensList['0'].ID_COMPRADOR+"\\"+this.itensList['0'].foto['0']['1'].DS_FOTO_PRODUTOR;
            }
            if(!this.itensList['0'].foto['0']['2']){
                this.foto3 = 'nao';
            }else{
                this.foto3 = 'sim';
                this.fotos.push(this.itensList['0'].foto['0']['2'].DS_FOTO_PRODUTOR);
                this.url3= "https://testetendering.myappnow.com.br/clubeatacado\\images\\empresas\\"+this.itensList['0'].ID_COMPRADOR+"\\"+this.itensList['0'].foto['0']['2'].DS_FOTO_PRODUTOR;

            }
            if(!this.itensList['0'].foto['0']['3']){
                this.foto4 = 'nao';
            }else{
                this.foto4 = 'sim';
                this.fotos.push(this.itensList['0'].foto['0']['3'].DS_FOTO_PRODUTOR);
                this.url4= "https://testetendering.myappnow.com.br/clubeatacado\\images\\empresas\\"+this.itensList['0'].ID_COMPRADOR+"\\"+this.itensList['0'].foto['0']['3'].DS_FOTO_PRODUTOR;
            }

             for(var i=0; i< this.itensList['0'].estados.length; i++){
                 this.result.push(this.itensList['0'].estados[i].uf);
             }
            this.uf = this.itensList['0'].DS_UF;
            this.cidade = this.itensList['0'].DS_CIDADE;
            this.ufEmp = this.itensList['0'].ufEmp;
            this.cidadeEmp = this.itensList['0'].cidadeEmp;
            this.ufAtendia = this.itensList['0'].ufAtendida;
            this.cidAtendida = this.itensList['0'].cidadeAtendida;
            console.log(this.itensList['0']);
        },
        methods: {
            autCcomleteProd(c){
                console.log(c);
                this.resultProd= [];
                axios.post('/clubeatacado/enderecos/cidade',{
                    uf: c
                }).then((response)=>{
                    for(var i =0; i< response.data.length; i++){
                        this.resultProd.push((response.data[i].cidade));
                    }
                });

            },
            showmore: function(){
                $('#maisinfo').css('display', 'block');
                $('#showmore').css('display', 'none');
            },
            showhide: function(){
                $('#maisinfo').css('display', 'none');
                $('#showmore').css('display', 'block');
            },

            onFileChanged1: function (event) {
                this.selectedFile1 = event.target.files[0];
                this.url1 = URL.createObjectURL(this.selectedFile1);
                console.log(this.url1);

                if (this.selectedFile1) {
                    $('#filename1').removeClass("bad-input");
                    $('#close1').css('display', 'block');
                    $('#open1').css('display', 'none');
                    $('#uploadicon1').css('display', 'none');
                    $('#imagem1').css('display', 'block');
                    $('#imagem1').attr('src', this.url1);
                }

                const formData = new FormData();
                formData.append('myFile', this.selectedFile1, this.selectedFile1.name);
                axios.post('/clubeatacado/usuario/upload/imagem/empresa', formData);
                this.fotos['0'] = this.selectedFile1.name;
                console.log(this.selectedFile1.name);


            },
            onFileChanged2: function (event2) {
                this.selectFile2 = event2.target.files[0];
                console.log(this.selectFile2);
                this.url2 = URL.createObjectURL(this.selectFile2);
                console.log(this.url2);
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
                axios.post('/clubeatacado/usuario/upload/imagem/empresa', formData);
                this.fotos['1'] = this.selectFile2.name;
                console.log(this.selectFile2);
                console.log(this.selectFile2.name);


            },
            onFileChanged3: function (event3) {
                this.selectFile3 = event3.target.files[0];
                console.log(this.selectFile3);
                this.url3 = URL.createObjectURL(this.selectFile3);
                console.log(this.url3);
                if (this.selectFile3) {
                    $('#filename3').removeClass("bad-input");
                    $('#close3').css('display', 'block');
                    $('#open3').css('display', 'none');
                    $('#uploadicon3').css('display', 'none');
                    $('#imagem3').css('display', 'block');
                    $('#imagem3').attr('src', this.url3);
                }

                const formData = new FormData();
                formData.append('myFile', this.selectFile3, this.selectFile3.name);
                axios.post('/clubeatacado/usuario/upload/imagem/empresa', formData);
                console.log(this.selectFile3);
                this.fotos['2'] = this.selectFile3.name;
                console.log(this.selectFile3.name);

            },
            onFileChanged4: function (event4) {
                this.selectFile4 = event4.target.files[0];
                console.log(this.selectFile4);
                this.url4 = URL.createObjectURL(this.selectFile4);
                console.log(this.url4);
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
                    axios.post('/clubeatacado/usuario/upload/imagem/empresa', formData);
                    this.fotos['3'] = this.selectFile4.name;
                } else {
                    axios.post('/clubeatacado/usuario/upload/imagem/empresa', null);
                }

            },
            onFileChanged: function (event) {
                this.selectFile = event.target.files[0];
                this.url = URL.createObjectURL(this.selectFile);
                console.log( this.selectFile);
                console.log(this.url);

                const formData = new FormData();
                if (this.selectFile !== null) {
                    formData.append('myFile', this.selectFile, this.selectFile.name);
                    axios.post('/clubeatacado/usuario/upload/imagem', formData).then(res =>{
                        this.foto = res.data;
                    });
                } else {
                    axios.post('/clubeatacado/usuario/upload/imagem', null);
                }
            },

            updateUser: function () {
                this.input = [
                    $('#nomeFantasia').val(),
                    $('#cnpj').val(),
                    $('#nome').val(),
                    $('#telefone').val(),
                    $('#ddd').val(),
                    $('#email').val(),
                    $('#sobrenome').val(),
                    $('#complemento').val(),
                    $('#endereco').val(),
                    $('#numero').val(),
                    $('#cep').val(),
                    this.uf,
                    this.cidade,
                    this.selectedFile1.name,
                    this.selectFile2.name,
                    this.selectFile3.name,
                    this.selectFile4.name,
                    $('#senha').val(),
                    $('#nrfuncionarios').val(),
                    $('#rzSocila').val(),
                    $('#enderecoEmp').val(),
                    $('#complementoEmp').val(),
                    $('#numeroEmp').val(),
                    $('#cepEmp').val(),
                    this.ufEmp,
                    this.cidadeEmp,
                    this.url1,
                    this.url2,
                    this.url3,
                    this.url4,
                    $('#facebook').val(),
                    $('#instagram').val(),
                    $('#gmail').val(),
                    $('#nomeContato').val(),
                    $('#sobrenomeContato').val(),
                    $('#dddContato').val(),
                    $('#telefoneContato').val(),
                    $('#emailContato').val(),
                    $('#cargo').val(),
                    $('#whatsaapContato').val(),
                    $('#senhaContato').val(),
                    $('#empresaInfo').val(),
                    this.foto,
                    this.ufAtendia,
                    this.cidAtendida,
                    this.fotos
                ];

                console.log(this.input);
                //
                $('#salvar1').removeClass('button  is-block has-button-yellow');
                $('#salvar1').addClass('button  is-block has-button-yellow is-loading');

                var formData = new FormData();
                if(this.selectFile!==null) {
                    formData.append('myFile', this.selectFile, this.selectFile.name);
                    axios.post('/clubeatacado/usuario/upload/imagem', formData);
                    console.log(formData);
                }else{
                    console.log(formData);
                    axios.post('/clubeatacado/usuario/upload/imagem', 0);
                }

                axios({
                    method: 'post', // verbo http
                    url: '/clubeatacado/usuario/update', // url
                    data: {
                        input: this.input, // Parâmetro 1 enviado
                    }
                })
                    .then(response => {
                    alert("Informações alteradas com sucesso");
                    window.open('/clubeatacado/usuario/userdetail', '_self');
                    $('#salvar1').removeClass('button  is-block has-button-yellow is-loading');
                    $('#salvar1').addClass('button  is-block has-button-yellow');
                }).catch(e => {
                    console.log('deu erro');
                });

            },

        }
    }
</script>
