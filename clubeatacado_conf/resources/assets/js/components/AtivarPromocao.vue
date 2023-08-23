<template>
    <div class="column">

        <div class="card" style="width: 720px; box-shadow: 0 0px 0 rgba(10, 10, 10, 0.1), 0 0 0px 0 rgba(10, 10, 10, 0.1)">
            <div class="card-content">
                <article class="media">
                    <figure class="media-left" >
                        <p class="image">
                            <img :src="'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'+ produto['0'].ID_ANUNCIO_PRODUTO+'/'+fotos.DS_FOTO_PRODUTO" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';" style="width: 320px; height:auto">
                        </p>
                    </figure>
                    <div class="media-content" style="margin-left: 30px;">
                        <p class="title is-4">{{produto['0'].DS_ANUNCIO_PRODUTO}}</p>
                        <figure>
                            <star-rating :rating="review['0'].avaliacao"
                                         :show-rating="false"
                                         :read-only="true"
                                         v-bind:increment="1"
                                         v-bind:max-rating="5"
                                         v-bind:star-size="20">
                            </star-rating>
                            <b class="subtitle is-6 has-text-left">({{review['0'].qt_avaliacao}})</b>
                        </figure>
                        <br>
                        <p class="subtitle is-6 has-text-left">{{produto['0'].DS_DETALHE_PRODUTO}}</p>
                    </div>
                </article>
            </div>
        </div>

        <div class="card" style="width: 820px; background:#fafafa; margin-top: 50px">
            <div class="card-content">
                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 597px">
                    <p class="subtitle is-6" style="color:#525763; font-weight:bold">FAZER DESCONTO NO PREÇO OU NA QUANTIDADE DO PEDIDO</p>
                </div>
                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#525763; font-weight:normal">Preço atual do produto</label>
                    <div class="control has-icons-left">
                        <label style="color: #23A7FB; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px; margin-left: 10%">R${{produto['0'].VL_PRODUTO_UNITARIO}}</label>
                        <!--<input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;" type="text" v-model="'R$'+produto['0'].VL_PRODUTO_UNITARIO">-->
                        <span class="icon is-small is-left" style="color: #23A7FB;height: 10px; width: 0px; position:static;margin-left: -30%;">
                                <i class="far fa-money-bill-alt" style="position: absolute;"></i>
                              </span>
                    </div>
                </div>
                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                    <label class="label has-text-left" style="color:#D73C38; font-weight:normal">Preço promocional</label>
                    <div class="control has-icons-left">
                    <money class="input" type="text" style="display: flex;
    margin-bottom: -10%;box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px; color: #D73C38" placeholder="" autofocus="" id="preco" v-model="precoUni" v-bind="money"></money>
                        <!-- <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px; color: #D73C38" type="text" v-model="precoUni"> -->
                       <span class="icon is-small is-left" style="color:#D73C38;height: 27px; width: 20px; position:static;">
                                <i class="far fa-money-bill-alt" style="position: absolute;"></i>
                              </span>
                    </div>
                </div>

            </div>
        </div>

        <div class="card" style="width: 820px; background:#fafafa; margin-top: 50px">
            <div class="card-content">

                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 597px" >
                    <p class="subtitle is-6" style="color:#525763; font-weight:normal">Preço de acordo com a quantidade pedida</p>
                </div>
                <form action="post" v-for="(item, index) in precos" :key="index">

                    <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 597px">
                        <div class="columns">
                            <div class="column">
                                <div class="field has-text-left">
                                    <font class="subtitle is-6" style="color:#868C99; font-weight:normal">De</font>
                                </div>
                            </div>

                            <div class="column">
                                <div class="field has-text-left" style="margin-left: -130px; width: 80px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                    <div class="control has-icons-right">
                                        <label style="box-shadow:inset 0 0px 0px #ffffff00;color: #23A7FB; border-color:#ffffff00; background-color: #FAFAFA; font-size: 16px;height: 16px;">{{item.QT_INICIAL}}</label>
                                        <!--<input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;color: #23A7FB; border-color:#ffffff00; background-color: #FAFAFA; font-size: 16px;height: 16px;"-->
                                               <!--type="text"  v-model="item.QT_INICIAL" >-->
                                    </div>
                                </div>
                            </div>

                            <div class="column">
                                <div class="field has-text-left" style="margin-left: -170px;">
                                    <font class="subtitle is-6" style="color:#868C99; font-weight:normal">Até</font>
                                </div>
                            </div>

                            <div class="column">
                                <div class="field has-text-left" style="margin-left: -290px; width: 80px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                    <div class="control has-icons-right">
                                        <label style="box-shadow:inset 0 0px 0px #ffffff00;color: #23A7FB;border-color:#ffffff00; background-color: #FAFAFA; font-size: 16px; height: 16px">{{item.QT_FINAL}}</label>
                                        <!--<input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;color: #23A7FB;border-color:#ffffff00; background-color: #FAFAFA; font-size: 16px; height: 16px" type="text"  v-model="item.QT_FINAL">-->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="field has-text-left" style="width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb" >
                            <div class="control has-icons-left">
                                  
                                <label style="box-shadow:inset 0 0px 0px #ffffff00;color: #23A7FB;border-color:#ffffff00; background-color: #FAFAFA; font-size: 16px; height: 16px; margin-left: 10%;">R${{item.VL_PRODUTO }}</label>
                                <span class="icon is-small is-left" style="color: #23A7FB;height: 10px; width: 0px; position:static;margin-left: -32%;">
                                    <i class="far fa-money-bill-alt" style="position: absolute;"></i>
                                </span>
                                <!--<input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;color:#23a7fb;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;"-->
                                       <!--type="text" placeholder="R$20,00 - R$45,00" v-model="'R$'+item.VL_INICIO_PRODUTO +'-'+ 'R$'+item.VL_FINAL_PRODUTO">-->

                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 597px" v-bind:id="item.ID_PRECO_PRODUTO" >
                        <p class="subtitle is-6" style="color:#D73C38; font-weight:normal">Preço promocional</p>
                         <input class="input"  style="" type="hidden"  v-value="newprecos[index][0] = item.ID_PRECO_PRODUTO">

                        <div class="columns">
                            <div class="column">
                                <div class="field has-text-left">
                                    <font class="subtitle is-6" style="color:#868C99; font-weight:normal">De</font>
                                </div>
                            </div>

                            <div class="column">
                                <div class="field has-text-left" style="margin-left: -130px; width: 80px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                    <div class="control has-icons-right">
                                        <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;color: #d73c38; border-color:#ffffff00; background-color: #FAFAFA; font-size: 16px;height: 16px;" type="text" name="newprecos" v-model="newprecos[index][1]">
                                    </div>
                                </div>
                            </div>

                            <div class="column">
                                <div class="field has-text-left" style="margin-left: -170px;">
                                    <font class="subtitle is-6" style="color:#868C99; font-weight:normal">Até</font>
                                </div>
                            </div>

                            <div class="column">
                                <div class="field has-text-left" style="margin-left: -290px; width: 80px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                    <div class="control has-icons-right">
                                        <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;color: #d73c38;border-color:#ffffff00; background-color: #FAFAFA; font-size: 16px; height: 16px" type="text" name="newprecos" v-model="newprecos[index][2]">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="field has-text-left" style="width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                            <div class="control has-icons-left">
                                <money class="input" type="text" style="display: flex;
    margin-bottom: -10%;box-shadow:inset 0 0px 0px #ffffff00;color:#D73C38;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;" placeholder="R$20,00" autofocus="" id="preco" name="newprecos" v-model="newprecos[index][3]" v-bind="money"></money>

                                <!-- <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;color:#D73C38;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;" type="text" placeholder="R$20,00" name="newprecos" v-model="newprecos[index][3]"> -->
                               <span class="icon is-small is-left" style="color:#D73C38;height: 27px; width: 20px; position:static;">
                                <i class="far fa-money-bill-alt" style="position: absolute;"></i>
                              </span>
                            </div>
                        </div>
                    </div>

                    <br/>
                </form>

            </div>
            <div class="field is-grouped" style="margin-left: 15%; height: 100px;">
                <p class="control">
                    <a class="button gradiente" style="color:#525763;background-color:#FFFFFF;box-shadow:1px 1px #A8ABB1, 0px 0px 0 1px #A8ABB1; width:281px; height: 48px;" v-on:click="close()">Cancelar</a>
                </p>
                <p class="control">
                    <a class="button  is-block has-button-yellow is-5  is-pulled-left is-medium has-text-weight-bold "
                       style="margin-bottom:10rem; margin-left:1em; width: 281px" v-on:click="updatePreco" > Salvar alterações</a>
                </p>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
           return{
               produto:[],
               precos:[],
               newprecos:[],
               foto:[],
               review:[],
               precoUni:null,
               id:0,
               price: 0.00,
                money: {
                    decimal: ',',
                    thousands: '',
                    prefix: '',
                    precision: 2,
                    masked: false
                },
           }
        },
        mounted() {
            console.log('Component mounted.');
            this.id = localStorage.getItem('ID_ANUNCIO_PRODUTO');
            axios({
                method: 'get', // verbo http
                url: '/clubeatacado/usuario/promo/'+this.id, // url

            }).then(response => {

                this.produto = response.data;

                this.precos = this.produto['0'].preco;

                this.fotos = this.produto['0'].FOTO_ANUNCIO['0'];
                console.log(this.fotos);
                this.review = this.produto['0'].review;
                this.review['0'].avaliacao = 0;
                console.log(this.review);
                for(let i=0; i<this.precos.length; i++){
                    this.newprecos[i] = [
                    ];
                }
                for(let i=0; i<this.fotos.length; i++){
                    this.foto[i] = [];
                }
                console.log(this.produto);
            }).catch(e => {
                console.log('deu erro');
            });



        },
        methods:{
            updatePreco: function () {
                console.log(this.newprecos);

                axios({
                    method: 'post', // verbo http
                    url: '/clubeatacado/anuncio/promocoes/add', // url
                    data: {
                        input:[
                            this.newprecos, // Parâmetro 1 enviado
                            this.precoUni,
                            this.produto['0'].ID_ANUNCIO_PRODUTO
                        ]
                    }
                })
                .then(response => {
                    console.log(response);

                    alert("Informações alteradas com sucesso");
                    window.open("/clubeatacado/usuario/meusanuncios",'_Self');

                }).catch(e => {
                    console.log('deu erro');
                });
            },

            close: function(){
                window.close();
            }
        }
    }
</script>



