<template>

    <div class="" style=" margin-bottom: 50px">
        <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;" v-if="anuncios.length === 0" >
            <div class="container has-content-centered" style="margin-top: -25px">
                <p class="subtitle is-prata is-3 has-text-centered" style="margin-left: 100px;">Você não tem nenhum<br>Produto cadastrado</p>
                <figure class="image">
                    <img src="/clubeatacado/css/img/intro_2.png" style="margin-left: 100px; height: auto;
                    width: auto;" alt="Placeholder image">
                </figure>
            </div>

        </div>
        
        <div class="columns is-multiline is-center" style="width: 110%;">
                 <div class="columns is-3" style="margin-left: 0.5px; height: 87%;" v-for="(item, index) in anuncios">
                    <div class="card is-shady" style="    margin-bottom: 10%;">
                            <div class="card" style="cursor: pointer">
                                <a :id="'close'+ item.ID_ANUNCIO_PRODUTO" v-on:click="remove(item.ID_ANUNCIO_PRODUTO)" class="button-close close" name="uploadImage"
                                style="display:block; margin-left: 45%;"><i class="fas fa-times-circle fa-2x" aria-hidden="true"></i></a>
                                <div  >
                                    <div class="card-image" v-on:click="editar(item.ID_ANUNCIO_PRODUTO)">
                                        <figure class="image is-2by1">
                                            <img id="imagem" :src="'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'+item.ID_ANUNCIO_PRODUTO+'/'+item.fotos" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';" style="height: 196px; width: 240px; margin-left: 8px; margin-top: 8px" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                                        <div class="media-content">
                                            <p class="subtitle is-6 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                        </div><br>
                                        <div class="content">
                                            <font class="subtitle is-6 is-bold">R$ {{item.VL_DESCONTO}}</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <font class="subtitle is-6 is-danger"  v-if="item.VL_DESCONTO !== item.VL_PRODUTO_UNITARIO"><strike>R${{item.VL_PRODUTO_UNITARIO}}</strike></font>
                                            <br><br><p class="subtitle is-6">{{item.QT_MINIMA_PEDIDO}} unids. - Pedido mínimo</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <button class="button is-outlined is-danger" style="margin-top: 20px; color:#ba3935; font-size: 14px; width:255px; height: 32px;" v-on:click="promocionar(item.ID_ANUNCIO_PRODUTO)">Promocionar</button>
                    </div>
                </div>
        </div>
       
    </div>
</template>

<script>
    import Vue from 'vue'
    import menusuario from './MenuOpcoes.vue'

    Vue.component('MenuOpcoes', menusuario);
    export default {
        props:['anuncios'],
        mounted() {
            
        },
        data(){
            return{
                urlpath: window.location.pathname,
                //anuncios:[],
                foto:[],
                idAnuncio:0
            }
        },
        methods:{
            promocionar: function(id){
               // console.log(this.id_anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open( '/clubeatacado/usuario/promocionar',"_self");

            },
            remove: function (id_anuncio) {
                
                axios.get('/clubeatacado/anuncio/remove/' + id_anuncio).then(res => {
                   
                    if(res.data === 1){
                        alert("Anuncio deletado com sucesso!");
                        window.open("/clubeatacado/usuario/meusanuncios","_self");
                    }else{
                        alert("Erro ao deletar anuncio!");
                        window.open("/clubeatacado/usuario/meusanuncios","_self");
                    }

                });

            },
            editar: function (id_anuncio) {
                localStorage.setItem('ID_ANUNCIO_PRODUTO',id_anuncio);
                window.open("/clubeatacado/anuncio/editar/page","_self");

            },
        }
    }
</script>
