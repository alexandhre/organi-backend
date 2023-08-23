<template>
    <div>
        <menuCategoria :cat="this.anuncio['anuncio'].DS_TIPO_PRODUTO"></menucategoria>
        <div class="section">
         
        <nav class="breadcrumb" style="margin-left: 15%;margin-top: -20px" aria-label="breadcrumbs">
            <ul>
                <li><a :href="'https://testetendering.myappnow.com.br/clubeatacado/categoria/listar/'+ anuncio['anuncio'].DS_TIPO_PRODUTO">{{this.anuncio['anuncio'].DS_TIPO_PRODUTO}}</a></li>
                <li><a v-on:click="handleSubmit(anuncio['anuncio'].DS_PRODUTO)">{{this.anuncio['anuncio'].DS_PRODUTO}}</a></li>
            </ul>
        </nav>
        <!--------------------------------------SELEÇÂO--------------->
        <div class="container has-text-centered" style="margin: 2% auto 0% auto;">
            <div class="columns" style="padding-left:10px">
                <div class="column is-2">
                    <div class="media">
                        <figure class="image">
                            <div v-for="(item, index) in images.slice(1, 4)" :key="index">
                                <img style="height: auto;width: auto;max-width: 65px;margin-left: auto; margin-right: auto;" :id="'img'+(index+1)" v-on:click="changeImg(index+1)"
                                     :src="item" onerror="this.onerror=null;this.src='https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';" alt="">
                                <br>
                            </div>
                        </figure>
                    </div>
                </div>

                <!--------------------------------------SELEÇÂO--------------->
                <div class="column">
                    <div class="media-content">
                        <div class="media-left">
                            <figure class="image" v-for="(item, index) in images.slice(0, 1)" :key="index">
                                <img class="image is-2by3" id="imgP" style="height: auto;width: auto; max-width: 380px;max-height: 100%;margin-left: auto; margin-right: auto;" :src="item" onerror="this.onerror=null;this.src='https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="column is-1">
                    <p class="buttons">
                        <a class="button gradiente" style="background: none;">
                                        <span class="icon" v-on:click="copyTestingCode(anuncio['anuncio'].ID_ANUNCIO_PRODUTO)">
                                          <i class="fas fa-share-alt" style="color: #9E0011"></i>
                                            <input type="hidden" id="testing-code" :value="anuncio['anuncio'].urlsearch">
                                        </span>
                        </a>
                        <a class="button gradiente" style="background: none;" v-on:click="addFavarito(anuncio['anuncio'].ID_ANUNCIO_PRODUTO)">
                        <span class="icon has-text-danger" v-if="anuncio['anuncio'].favorito === null">
                          <i class="far fa-heart" style="display: block; color: #9E0011"  id="heart1" ></i>
                          <i class="fas fa-heart" style="display: none; color: #9E0011 " id="heart2"></i>
                        </span >
                        <span class="icon has-text-danger" v-else>
                          <i class="far fa-heart" style="display: none; color: #9E0011" id="heart1" ></i>
                          <i class="fas fa-heart" style="display: block; color: #9E0011 " id="heart2"></i>
                        </span>
                        </a>
                        <a>
                            <span class="icon is-medium has-text-danger" data-toggle="modal" data-target="#myModal" v-on:click="addcart(anuncio['anuncio'].ID_ANUNCIO_PRODUTO)">
                             <img src="/clubeatacado/css/img/add_shopping_cart - material.png" alt="adicionar ao carrinho">
                            </span>
                        </a>
                    </p>
                </div>

                <!--------------------------------------INFORMAÇÕES DO PRODUTO--------------->
                <div class="column is-5">

                    <div class="media-content">
                        <p class="title is-4">{{anuncio['anuncio'].DS_ANUNCIO_PRODUTO}}</p>
                        <figure style="display: flex;">
                            <star-rating :rating="avaliacao"
                                         :show-rating="false"
                                         :read-only="true"
                                         v-bind:increment="1"
                                         v-bind:max-rating="5"
                                         v-bind:star-size="20">
                            </star-rating>
                            <p class="subtitle is-6 has-text-left" style="padding-top: 5px;">({{anuncio['review']['0'].qt_avaliacao }})</p>

                        </figure>
                        <br>
                        <p class="subtitle is-6 has-text-left" style="width: 100%;">{{anuncio['anuncio'].DS_DETALHE_PRODUTO}}</p>
                    </div>
                    <br><br>

                    <div class="field is-grouped" >
                        <p class="control">
                            <a class="button gradiente" style="background: none; " v-on:click="plus()">
                                  <span class="icon has-text-black">
                                  <i class="fas fa-plus-circle" ></i>
                                </span>
                            </a>
                        </p>
                        <p class="control" style="margin: 0px;">
                            <input disabled style="color:#23A7FB; font-size: 24px;font-weight: bold; border: 0px;padding: 0px; max-width: 45px; background-color: #fafafa; text-align: center" type="number" :min="anuncio['anuncio'].QT_MINIMA_PEDIDO" :max="anuncio['anuncio'].QT_DISPONIVEL" v-model="quant" />
                        </p>
                        <p class="control" >
                            <a class="button gradiente" style="background: none;" v-on:click="min()">
                                 <span class="icon" style="color: gray">
                                 <i class="fas fa-minus-circle"></i>
                                </span>
                            </a>
                        </p>
                        <p class="control" style="margin-left: -16px;">
                            <a href="/clubeatacado/usuario/carrinho" class="button" style="color: #4A4A4A; margin-left: 15px; height: 48px;width: 325px; box-shadow: -1px 3px 5px 0px #b1b0b0ab;" v-on:click="addcart(anuncio['anuncio'].ID_ANUNCIO_PRODUTO)">Fazer um pedido</a>
                        </p>
                    </div>
                    <div class="field" style="margin-top: 30px">
                        <p class="control">
                            <a class="button is-outlined is-danger" style="margin-left: 135px; height: 40px;width: 324px;" v-on:click="chatOpen(anuncio['anuncio'].ID_PRODUTOR)"><i class="far fa-comment-alt" style="margin-right: 20px;"></i>Enviar um chat</a>
                        </p>
                    </div>
                    <br>
                    <table style="margin-left: 140px;">
                        <tr><td><font class="subtitle is-7 is-danger" style="font-weight: bold;">Pedido Minimo:</font><font class="subtitle is-7">{{anuncio['anuncio'].QT_MINIMA_PEDIDO}} unidades</font></td></tr>
                        <tr><td><font class="subtitle is-7 is-danger" style="font-weight: bold;"><br>Stock total: </font><font class="subtitle is-7">{{anuncio['anuncio'].QT_DISPONIVEL}} unidades</font></td></tr>
                    </table>

                </div>
            </div>
        </div>
        <!--------------------------------------MENU OPÇÕES--------------->
        <section class="section" style="width: 100%;
    max-width: 1410px;
    margin: 0 auto;">
            <article class="media" style="margin-left: 8%; border-bottom: 1px solid rgba(219, 219, 219, 0.5);width: 65%;">
                <div class="media-content">
                    <div class="tabs is-left" >
                        <ul style="margin:0px;border-bottom-color: rgba(219, 219, 219, 0.5);border-bottom-width: 0px;">
                            <li style="border-bottom:4px solid #9e0011;font-weight: bold" id="btnGeral"><a id="textGeral" style="border-color:#ffffff00" v-on:click="showGeral()">Informação Geral</a></li>
                            <li  style="margin-left: 30px; height: 44px;" id="btnTecnicas"><a id="textTecnicas" class="subtitle is-6 is-bold" style="border-color:#ffffff00;color:#868C99;"  v-on:click="showTecnicas()">Especificações Técnicas</a></li>
                            <li style="margin-left: 30px; height: 44px;" id="btnProvedor"><a id="textProvedor" class="subtitle is-6 is-bold" style="border-color:#ffffff00;color:#868C99;"   v-on:click="showProvedor()">Informação do Provedor</a></li>
                        </ul>
                    </div>
                </div>
            </article>

            <!-------------MENU OPÇÕES 1--------------->
            <section class="section" id="geral">
                       
                <infoGeral>
                       
                       <div class="column has-text-centered" style="background-color: #ffffff; height: 72px;width: 64px; margin-right:50px; box-shadow: 0 1px 1px #EB9D9B, 0 0 0 1px #EB9D9B" slot="preco" v-for="(item, index) in anuncio['precos']" :key="index">
                               <p class="title is-8 is-bold" style="margin-bottom: 10px">R{{item.VL_DESCONTO_PRODUTO  | currency('$', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</p>
                               <p class="subtitle is-8 is-danger" v-if="item.VL_PRODUTO != item.VL_DESCONTO_PRODUTO">
                                   <strike>R$ {{item.VL_PRODUTO | currency('$', 2, { thousandsSeparator: '.', decimalSeparator: ','  })  }}</strike>
                                </p>
                               <p class="subtitle is-8" style="margin-top: 40%">{{item.QT_INICIAL}} - {{item.QT_FINAL}} unidades</p>
                       </div>
                    
                    <span slot="cor" v-for="(item, index) in anuncio['cor']" :key="index">
                       <button class="button is-rounded" v-on:click="selectColor(item.DS_COR)" :style="{background: item.DS_COR}" style="padding-left: 0em;margin-left: 5px; border:none"></button>
                   </span>

                    <span slot="tamanho" v-for="(item, index) in anuncio['tamanho']" :key="index">
                        
                         <p class="subtitle is-7" v-on:click="selectTamanho(item.DS_TAMANHO)">tamano:{{item.DS_TAMANHO}}; medida:{{item.DS_METRAGEM}}</p>
                   </span>

                    <span slot="garantia">
                        
                         <p class="subtitle is-7">{{anuncio['anuncio'].DS_GARANTIA}}</p>
                   </span>
                    
                    <span slot="comentarios"  v-for="(item, index) in this.anuncio['comentarios']" :key="index">
                           <article class="media"  style="border-top: 1px solid rgba(255, 255, 255, 0);">
                        <div class="media-left">
                            <a class="image"><img class="is-rounded" style="position:relative;top:10px;max-height:50PX; height: 50px; width:50px" :src="'https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/'+item.ID_COMPRADOR+'/'+item.DS_FOTO_COMPRADOR"></a>
                            <br>
                        </div>
                        <div class="media-right">
                            <div style="display: inline-flex">
                                
                                <p class="subtitle is-6 is-bold" style="position:relative;top:15px;">{{item.DS_NOME}}</p>
                            <figure style="margin-top: 10px;position: relative;">
                                <star-rating :rating="item.VL_AVALIACAO"
                                                     :show-rating="false"
                                                     :read-only="true"
                                                     v-bind:increment="1"
                                                     v-bind:max-rating="5"
                                                     v-bind:star-size="20">
                                 </star-rating>
                            </figure>
                            </div>
                            <!--<p class="subtitle is-7" style="position:relative;top:8px;">Há 4 semanas</p>-->
                            <p class="subtitle is-7" style="position:relative;top:15px; font">{{item.DS_AVALIACAO}}</p>
                        </div>
                    </article>
                    <hr/>
                   </span>
                </infoGeral>
                <button class="button" style="color: rgb(82, 87, 99);
                                                    font-weight: bold;
                                                    background-color: rgba(82, 87, 99, 0);
                                                    border-color: #d73c38;
                                                    margin-left:8%
                                                    width: 290px;" v-on:click="showMoreComents()"
                                                    >Ver mais comentários
                </button>
            </section>

            <!-------------MENU OPÇÕES 2--------------->
            <section class="section" style="display:none" id="tecnicas">
                <espcTecnica>
                   <span slot="cor" v-for="(item, index) in anuncio['cor']" :key="index">
                          <input class="is-checkradio is-info" style="padding-left: 0em;margin-left: 5px; display: none" type="checkbox"
                                 v-model="cor"
                                 :true-value="item.DS_COR"
                                 false-value="0"
                                :id="index"/>
                       <label class="button" style="color: #ffffff;background-color: #08e9fd7a; width: 50px; height: 50px;border-radius: 100px; border:none" :style="{background: item.DS_COR}" :for="index">
                       </label>

                   </span>

                     <span slot="tamanho" v-for="(item, index) in anuncio['tamanho']" :key="index">
                         <p class="subtitle is-7">Tamano:{{item.DS_TAMANHO}}; Medida:{{item.DS_METRAGEM}}</p>
                   </span>

                    <span slot="certificado">
                        <figure class="image" style="margin-left: 0px; display: flex;" >
                            <span v-for="(item, index) in certificado[0]" :key="index">
                                 <img style="height: auto; width: auto;padding: 1%;max-width: 100%;max-height: 150px;padding: 1%" :src="'https://testetendering.myappnow.com.br/clubeatacado/images/certificados/'+ anuncio['anuncio'].ID_ANUNCIO_PRODUTO+'/'+item.DS_FOTO_CERTIFICACAO" onerror="this.onerror=null;this.src='https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';"  alt="Placeholder image" >
                            </span>

                        </figure>
                    </span>

                    <span slot="fabrica">
                         <figure class="image" style="margin-left: 0px; display: flex;">
                               <span v-for="(item, index) in empresa[0]" :key="index">
                                   <img style="height: auto; width: auto; padding: 1%; max-width: 100%; max-height: 150px; padding: 1%" :src="'https://testetendering.myappnow.com.br/clubeatacado/images/empresas/'+ anuncio['anuncio'].ID_COMPRADOR+'/'+item.DS_FOTO_PRODUTOR" onerror="this.onerror=null;this.src='https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';"  alt="Placeholder image">
                               </span>
                         </figure>
                    </span>
            </espcTecnica>
            </section>

            <!-------------MENU OPÇÕES 3--------------->
            <section class="section"  style="display:none" id="provedor">
                <infoProvedor>
                    <slot slot="vendedorDesc"  v-for="item in vendedor">
                        <font class="subtitle is-7">
                          {{item.tamanhoFab}}
                        </font>
                    </slot>

                    <slot slot="vendedor">
                        <div class="columns"  v-for="(item, index) in vendedor" :key="index">
                            <div class="column has-text-left" style="background-color: #fafafa;">
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Nome</p>
                                <p class="subtitle is-7">{{item.nomeFantasia}}</p>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">CNPJ</p>
                                <p class="subtitle is-7">{{item.cnpj}}</p>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Telefone de contato</p>
                                <p class="subtitle is-7">({{item.dddTelefoneContato}}){{item.telefoneContato}}</p>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">E-mail de contato</p>
                                <p class="subtitle is-7">{{item.emailContato}}</p>
                            </div>

                            <div class="column has-text-left" style="margin-left: 30px; background-color: #fafafa;">
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Endereço</p>
                                <p class="subtitle is-7">{{item.endereco}}</p>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Cidade</p>
                                <p class="subtitle is-7">{{item.cidadeNome}}</p>
                                <div class="columns">
                                    <div class="column">
                                        <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">CEP</p>
                                        <p class="subtitle is-7">{{item.cep}}</p>
                                    </div>
                                    <div class="column">
                                        <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Estado</p>
                                        <p class="subtitle is-7">{{item.uf}}</p>
                                    </div>
                                </div>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Redes Sociais</p>
                                <span class="icon has-text-info" v-if="item.facebook">
                                    <a :href="item.facebook">
  							            <i class="fab fa-facebook-square"  style="color: #2764AC"></i>
								    </a>
                                </span>
                                <span class="icon" v-if="item.instagram">
                                     <a :href="item.instagram">
  								        <i class="fab fa-instagram" style="color: #8B572A"></i>
                                     </a>
								</span>
                                <span class="icon has-text-primary" v-if="item.gmail">
                                     <a :href="item.gmail">
  								        <i class="fab fa-google-plus-square"></i>
                                     </a>

							    </span>
                            </div>

                            <div class="column has-text-left" style="margin-left: 30px; background-color: #fafafa;">
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Tipo de negócio:</p>
                                <p class="subtitle is-7">{{item.negocioTipo}}</p>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Ano de fundação</p>
                                <p class="subtitle is-7"></p>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Número de empregados</p>
                                <p class="subtitle is-7">{{item.empregados}}</p>
                                <p class="subtitle is-6 is-bold" style="margin-bottom: 10px">Produtos principais</p>
                                <p class="subtitle is-7">{{principaisCat}}</p>
                            </div>

                        </div>
                    </slot>
                    <slot slot="outrosAnuncios" v-if="OutrosAnuncios.length > 1">
                         <p class="subtitle is-6 is-bold">Outros produtos da empresa</p>
                        <div class="container has-text-left" style="margin-top: 4%;margin-bottom: 5%;">
                            <div class="columns is-multiline is-center"  style="width: 1200px" >
                                <div class="columns is-4" style=" margin: 1%;" v-for="(item, index) in OutrosAnuncios" :key="index">
                                    <div class="card" style="cursor: pointer; box-shadow: rgba(10, 10, 10, 0.1) 0px 0px 3px 0px, rgba(10, 10, 10, 0.1) 0px 0px 1px 0px;" v-on:click="detailProduto(item.idAnuncio)" v-if="item.idAnuncio !== aux">
                                        <div class="card-image">
                                            <figure class="image is-2by1" style="margin-left: 0; margin-right: 0;">
                                                <img :src="item.foto" style="height: 196px;width: 240px;margin-left: 8px; margin-top: 8px;" alt="" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';">
                                            </figure>
                                        </div>
                                        <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                                            <p class="subtitle is-6 is-bold">{{item.titulo}}</p>

                                            <p class="subtitle is-6 is-bold">R{{(item.preco - item.desconto) | currency('$', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}
                                                <font style="margin-left: 45px;" class="subtitle is-6 is-danger" v-if="item.desconto !== null">
                                                    <strike>R{{item.preco  | currency('$', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</strike>
                                                </font>
                                            </p>
                                            <p class="subtitle is-6">{{item.qtMinPedido}} unids. - Pedido mínimo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </slot>
                </infoProvedor>
            </section>

        </section>

        <!-- Modal -->
        <div class="modal" id="myModal" >
            <div class="modal-card" style="width: 40%; margin-top:20%">

                <section class="modal-card-body body-modal" style="width: 100%;">
                    <header class="rectangle-10" style=" width: 100%">
                        <button class="button" id="close" data-dismiss="modal" aria-label="Close" style="margin-top: -4%;float: right; background: #d6dce400;border: transparent;"><i class="fa fa-times fa-1x" style="color: #808080;"></i></button>
                    </header>
                   <div>

                        <div style="display: flex">
                            <div style="margin: 2%">
                                <p style="height: 40px;width: 40px; border-radius: 50%; background-color: #9dcc00; border: none">
                                    <i class="fas fa-check" style="margin: 30%; color: white;"></i>
                                </p>
                            </div>
                            <div style="margin-left: 2%">
                                <div>
                                    <p class="subtitle is-6">
                                        Item adicionado ao carrinho com sucesso
                                    </p>

                                </div>
                                <div style="display:flex; margin-left: auto">
                                    <button class="button" style="margin: 5px;height: 40px;width: 200px; color:#FFFFFF; background-color: #9E0011; border-color: #9E0011" >
                                        <a href="/clubeatacado/usuario/carrinho" style="color: #ffffff; ">
                                            ver carrinho
                                        </a>
                                    </button>
                                    <button class="button" id="comprar" style="margin: 5px;height: 40px;width: 200px; color:#9E0011; background-color: #FFFF; border-color: #9E0011">
                                        <a href="/clubeatacado/home" style="color: #9E0011; ">
                                            continuar comprando
                                        </a>

                                    </button>
                                </div>
                            </div>

                        </div>
                   </div>
                    <hr style="margin: 0px;" />
                </section>

            </div>
        </div>
    </div>
    </div>
   
</template>
<style>
    a:hover {
        color: #b4b4b4;
    }
    #comprar:hover{
        color: #9E0011;
    }
</style>
<script>
    /*Other component*/
    import Vue from 'vue'
    import espcTecnica from './EspcTecnica.vue'
    import infoGeral from './InfoGeral.vue'
    import infoProvedor from './InfoProvedor.vue'
    import menuCategoria from './MenuCategoria.vue'

    Vue.component('EspcTecnica', espcTecnica);
    Vue.component('InfoGeral', infoGeral);
    Vue.component('InfoProvedor', infoProvedor);
    Vue.component('MenuCategoria', menuCategoria);
   
   
    export default {
        props:['id'],
        data(){
            return{
                anuncio:[],
                num: 40,
                quant: 1,
                cor:'',
                tamanho:'',
                input:[],
                cart:[],
                images: [],
                certificado: [],
                empresa: [],
                vendedor: [],
                OutrosAnuncios: [],
                aux:0,
                avaliacao: 0,
                principaisCat: '',
                cont:0
            }
        },
        mounted() {
            if(this.id == 0){
                this.aux = localStorage.getItem('ID_ANUNCIO_PRODUTO');
 
            }else{
                this.aux =this.id
            }

            axios.get('/clubeatacado/anuncio/detalhe/' +  this.aux ).then(resp =>{

                this.anuncio = resp.data['0'];
                sessionStorage.setItem('id_anunciante', this.anuncio['anuncio']['ID_PRODUTOR']);
                this.quant = parseInt(this.anuncio['anuncio'].QT_MINIMA_PEDIDO);
                console.log( this.anuncio);

                for (var i = 0; i < this.anuncio['foto'].length; i++) {
                    this.images.push('https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'+ this.anuncio['anuncio'].ID_ANUNCIO_PRODUTO+'/'+this.anuncio['foto'][i].DS_FOTO_PRODUTO);
                }

               var x = this.anuncio['anuncio'].ID_ANUNCIO_PRODUTO;
                this.avaliacao =  parseInt(this.anuncio['review']['0'].avaliacao);
                if(!localStorage.getItem('VISITA'+x)){

                    axios.get('/clubeatacado/anuncio/visita/' + this.anuncio['anuncio'].ID_ANUNCIO_PRODUTO ).then(resp =>{
                        localStorage.setItem('VISITA'+x, 1)
                    });
                }

            });
        },
        methods:{
            copyTestingCode()  {
                let testingCodeToCopy = document.querySelector('#testing-code');
                 console.log(testingCodeToCopy);
                testingCodeToCopy.setAttribute('type', 'text') ;   // 不是 hidden 才能複製
                testingCodeToCopy.select();
               
                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    alert('Link copiado!');
                } catch (err) {
                    alert('Oops, erro ao copiar link!');
                }

                /* unselect the range */
                testingCodeToCopy.setAttribute('type', 'hidden');
                window.getSelection().removeAllRanges()
            },
            plus(){

                if(this.quant < this.anuncio['anuncio'].QT_DISPONIVEL){
                    this.quant = this.quant+1;
                }

            },
            min(){
                if(this.quant > this.anuncio['anuncio'].QT_MINIMA_PEDIDO){
                    this.quant = this.quant-1;
                }

            },
            showGeral(){
                $("#geral").css('display','block');
                $("#textGeral").css('color','#525763');

                $("#provedor").css('display','none');
                $("#textProvedor").css('color','#868c99');

                $("#tecnicas").css('display','none');
                $("#textTecnicas").css('color','#868c99');

                $("#btnGeral").css('border-bottom','4px solid #9e0011');
                $("#btnTecnicas").css('border-bottom','0px solid #9e0011');
                $("#btnProvedor").css('border-bottom','0px solid #9e0011');

                $("#textGeral").css('border-color','ffffff00');
                $("#textTecnicas").css('color','ffffff00');
                $("#textProvedor").css('color','ffffff00');


            },
            showTecnicas(){

                axios.get('/clubeatacado/anuncio/produto/certificacao/' + this.anuncio['anuncio'].ID_ANUNCIO_PRODUTO ).then(resp =>{
                    
                    if(resp.data.length == 0){
                        var foto =[
                            'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png'
                        ];
                        this.certificado.push(foto);
                    }else{
                        this.certificado.push(resp.data);
                    }
                 
                });

                axios.get('/clubeatacado/usuario/produto/empresa/' + this.anuncio['anuncio'].ID_PRODUTOR ).then(resp =>{
                   
                   if(resp.data.length == 0){
                        var foto =[
                            'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png'
                        ];
                        this.empresa.push(foto);
                    }else{
                        this.empresa.push(resp.data);
                    }
                    console.log(this.empresa);
                });


                $("#geral").css('display','none');
                $("#textGeral").css('color','#868c99');

                $("#provedor").css('display','none');
                $("#textProvedor").css('color','#868c99');

                $("#tecnicas").css('display','block');
                $("#textTecnicas").css('color','#525763');

                $("#btnGeral").css('border-bottom','0px solid #9e0011');
                $("#btnTecnicas").css('border-bottom','4px solid #9e0011');
                $("#btnProvedor").css('border-bottom','0px solid #9e0011');

            },
            showProvedor(){

                axios.get('/clubeatacado/usuario/listar/' + this.anuncio['anuncio'].ID_COMPRADOR ).then(resp =>{
                    this.vendedor = resp.data;
                });
                
                axios.get('/clubeatacado/categoria/principal/' + this.anuncio['anuncio'].ID_COMPRADOR ).then(resp =>{
                   
                    for(var i=0; i< resp.data.length; i++){
                        this.principaisCat = resp.data[i].DS_CATEGORIA_PRODUTO + ', '+  this.principaisCat ;
                    }
                    this.principaisCat = this.principaisCat.replace(/,\s*$/, "");
                 
                  
                });
                axios.get('/clubeatacado/anuncio/meusanuncios/'+this.anuncio['anuncio'].ID_COMPRADOR).then(resp =>{
                   
                   // this.OutrosAnuncios = resp.data.response.anuncio;
                    for(var i = 0; i < resp.data.response.anuncio.length; i++){
                        if( resp.data.response.anuncio[i].idAnuncio !== this.aux)
                            this.OutrosAnuncios.push(resp.data.response.anuncio[i]);
                    }

                });

                $("#geral").css('display','none');
                $("#textGeral").css('color','#868c99');

                $("#provedor").css('display','block');
                $("#textProvedor").css('color','#525763');


                $("#tecnicas").css('display','none');
                $("#textTecnicas").css('color','#868c99');

                $("#btnGeral").css('border-bottom','0px solid #9e0011');
                $("#btnTecnicas").css('border-bottom','0px solid #9e0011');
                $("#btnProvedor").css('border-bottom','4px solid #9e0011');

            },
            addFavarito(id){
                axios.get('/clubeatacado/usuario/favoritos/add/' + id ).then(res => {

                    if(res.data === 3){
                        window.open("/clubeatacado/logar",'_self');
                    }else if(res.data !== 0){
                        $('#heart1').css('display','none');
                        $('#heart2').css('display','block');
                    }else{
                        $('#heart1').css('display','block');
                        $('#heart2').css('display','none');
                    }

                })
                    .catch(e => {
                        console.log('deu erro');
                    });
            },
            selectColor(color){
                this.cor = color;

            },
             selectTamanho(tamanho){
                this.tamanho = tamanho;

            },
            addcart(id){
               
                $("#Mymodal").click(function() {
                    $(".modal").addClass("is-active");
                });
                $("#close").click(function() {
                    $(".modal").removeClass("is-active");
                });

                function cart(temp){
                    this.color = temp[0];
                    this.size = temp[1];
                    this.anuncioId = temp[2];
                    this.fav = temp[3];
                    this.photo = temp[4];
                    this.price = temp[5];
                    this.tamanho = temp[6];
                }
                for (var i = 0; i < this.anuncio['precos'].length; i++) {

                    if((this.anuncio['precos'][i].QT_INICIAL <= this.quant) && (this.quant <= this.anuncio['precos'][i].QT_FINAL) ){
                        var temp = [this.cor
                            , this.quant
                            , id
                            , this.anuncio['anuncio'].favorito, 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'+ this.anuncio['anuncio'].ID_ANUNCIO_PRODUTO+'/'+this.anuncio['foto'][0].DS_FOTO_PRODUTO
                            ,this.anuncio['precos'][i].VL_PRODUTO
                            , this.tamanho
                            ];
                    }else{
                        var temp = [this.cor
                            , this.quant
                            , id
                            , this.anuncio['anuncio'].favorito, 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'+ this.anuncio['anuncio'].ID_ANUNCIO_PRODUTO+'/'+this.anuncio['foto'][0].DS_FOTO_PRODUTO
                            ,this.anuncio['anuncio'].VL_PRODUTO_UNITARIO
                            ,this.tamanho
                        ];
                    }
                }



                cart = new cart(temp);
                 var ar =[];


                if(JSON.parse(localStorage.getItem('anuncio')) != null){
                    for(let elements of JSON.parse(localStorage.getItem('anuncio'))){
                        ar.push(elements);
                    }
                    ar.push(cart);
                }else{
                    ar.push(cart);
                }

                localStorage.setItem('anuncio',  [JSON.stringify(ar)]);

            },
            changeImg(id){

                    var imgatual =  this.images[id];
                    console.log(imgatual);
                    this.images[id] = document.getElementById('imgP').src;
                    console.log(this.images[id]);
                    var imganterior = document.getElementById('imgP').src;
                    console.log(imganterior);
                    $('#imgP').attr('src', imgatual);
                    $('#img'+id).attr('src', imganterior);
            },
            chatOpen(id){
                localStorage.setItem('id_anunciante', id);
                window.open("/clubeatacado/usuario/chat",'_self');
            },
            handleSubmit(result){

                localStorage.setItem('busca',result);

                window.open('/clubeatacado/anuncio/produto/page','_self');

            },
            detailProduto(id_anuncio) {
                this.anuncio = $('#' + id_anuncio).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id_anuncio);
                window.open("/clubeatacado/anuncio/produtodetalhe",'_self');
            },
            showMoreComents(){
                var vm = this;
                var inicio = vm.anuncio['comentarios'].length
                vm.cont =  inicio + vm.cont;
                axios.get('/clubeatacado/anuncio/MoreComents/' + vm.cont +'/' +  vm.aux)
                .then(res => {
                    for (var i = 0; i < res.data.length; i++) {
                        vm.anuncio['comentarios'].push(res.data[i]);
                    }
                        //vm.anuncio =   vm.item;
                });
            }
        }
    }
</script>
