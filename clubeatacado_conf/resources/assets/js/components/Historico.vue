<template>

    <div >
        <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;" v-if="anuncios.length === 0" >

            <div class="container has-content-centered" style="margin-top: -25px">
                <p class="subtitle is-prata is-3 has-text-centered" style="margin-left: 100px;">Você não <br>Realizou nenhuma compra</p>
                <figure class="image">
                    <img src="/clubeatacado/css/img/intro_2.png" style="margin-left: 100px;     height: auto;
    width: auto;" alt="Placeholder image">
                </figure>
            </div>

        </div>

        <div class="columns is-multiline is-center">
            <div class="columns is-3" style="margin-left: 1%" v-for="(item, index) in anuncios">
                <div class="card is-shady" >
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-2by1">
                                <img id="imagem" :src="item.foto" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';" style="height: 196px; width: 240px; margin-left: 8px; margin-top: 8px" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                            <div class="media-content" style="display: inline-flex; width:100%">
                                <p class="subtitle is-6 is-bold">{{item.titulo}}</p>
                                <font class="subtitle is-6 is-bold" style="margin-left: auto; margin-top: 0;">R$ {{item.valor}}</font>
                            </div>
                            <div class="content" style="margin-left: -5px;margin-top: -20px">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <!--<font class="subtitle is-6 is-danger" v-if="item.valor"></font>-->
                                <article class="media" >
                                    <div class="content" style="display: inline-flex; width:100%">
                                        <p class="subtitle is-6 is-bold" style="margin-top: 8px; margin-bottom: 3px;">Cores</p>
                                        <div style="margin-left: auto;">
                                            <label class=button id=2 style="width: 20px; height: 25px; border-radius: 100px; border-color: transparent"
                                                   :style="(item.cor !== null) ? {background: item.cor}: 'background: #fff; border:none' "
                                                  ><i
                                                    class="fas fa-check"
                                                    style="position: absolute; left: 20px; bottom: 20px;
                                                        color: #ffffff;width: 20px;height: 20px; border-radius: 100px; display:none"></i>
                                            </label>
                                        </div>
                                    </div>

                                </article>
                                <div class="content" style="display: inline-flex; width:100%;margin-bottom: 0px">
                                    <p class="subtitle is-6 is-bold">tamanho</p>
                                    <p class="subtitle is-6 is-bold" style="margin-left: auto;margin-top: 0;">{{item.tamanho}}</p>
                                </div>
                                <p class="subtitle is-6">{{item.qtProduto}} unids. - Comprada</p>
                            </div>
                        </div>
                    </div>

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
        }
    }
</script>
