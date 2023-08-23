<template>
    <div class="">
        <!--------------------------------------PROMOÇÕES--------------->
        <div >
            <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;" v-if="anuncios.length === 0" >

                <div class="container has-content-centered" style="margin-top: -25px">
                    <p class="subtitle is-prata is-3 has-text-centered" style="margin-left: 100px;">Você não tem nenhuma<br>Promoção</p>
                    <figure class="image">
                        <img src="/clubeatacado/css/img/intro_2.png" style="margin-left: 100px;     height: auto;
    width: auto;" alt="Placeholder image">
                    </figure>
                </div>
            </div>

            <div class="columns is-multiline is-center" style="width: 110%;">
                <div class="columns is-3" style="margin-left: 0.5px; height: 87%;" v-for="(item, index) in anuncios">
                    <div class="card is-shady" >
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-2by1">
                                    <img id="imagem" :src="'https://testetendering.myappnow.com.br/clubeatacado/'+item.FOTO_ANUNCIO" onerror="this.onerror=null;this.src='https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';" style="height: 196px; width: 240px; margin-left: 8px; margin-top: 8px" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                                <div class="media-content">
                                    <p class="subtitle is-6 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                </div><br>
                                <div class="content">
                                    <font class="subtitle is-6 is-bold">R$ {{item.VL_DESCONTO}}</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <font class="subtitle is-6 is-danger" v-if="item.VL_DESCONTO"><strike>R$ {{item.VL_PRODUTO_UNITARIO}}</strike></font>
                                    <br><br><p class="subtitle is-6">{{item.QT_MINIMA_PEDIDO}} unids. - Pedido mínimo</p>
                                </div>
                            </div>
                        </div>
                        <button class="button is-outlined is-danger" style="margin-top: 20px; color:#D73C38; font-size: 14px; width:255px; height: 32px;" v-on:click="ParaPromo(item.ID_ANUNCIO_PRODUTO)">Parar promoção</button>
                    </div>
                </div>


            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props:['anuncios'],
        mounted() {
            console.log(this.anuncios)

        },
        data(){
            return{
                //anuncios:[],

            }
        },
        methods:{
            ParaPromo: function(id){
                axios.get('/clubeatacado/anuncio/descontos/parar/'+id ).then(resp =>{
                    this.anuncios = resp.data.response.anuncio;
                });

                window.location.reload();
            }
        }
    }
</script>
