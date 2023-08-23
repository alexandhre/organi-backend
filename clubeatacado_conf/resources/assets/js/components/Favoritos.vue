<template>

    <div >
        <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;" v-if="anuncios.length === 0" >

            <div class="container has-content-centered" style="margin-top: -25px">
                <p class="subtitle is-prata is-3 has-text-centered" style="margin-left: 100px;">Você não tem nenhum<br>Favorito</p>
                <figure class="image">
                    <img src="/clubeatacado/css/img/intro_2.png" style="margin-left: 100px;     height: auto;
    width: auto;" alt="Placeholder image">
                </figure>
            </div>

        </div>

        <div class="columns is-multiline is-center" style="width: 110%;">
            <div class="columns is-3" style="margin-left: 0.5px; height: 87%" v-for="(item, index) in anuncios">
                <div class="card is-shady" >
                    <div class="card" style="cursor: pointer" v-on:click="detailProduto(item.anuncioId)">
                        <div class="card-image">
                            <figure class="image is-2by1">
                                <img id="imagem" :src="item.foto" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';" style="height: 196px; width: 240px; margin-left: 8px; margin-top: 8px" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                            <div class="media-content">
                                <p class="subtitle is-6 is-bold">{{item.nome}}</p>
                            </div><br>
                            <div class="content">
                                <font class="subtitle is-6 is-bold">R$ {{item.valor - item.desconto}}</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <font class="subtitle is-6 is-danger"  v-if="item.desconto"><strike>R${{item.valor}}</strike></font>
                                <br><br><p class="subtitle is-6">{{item.quatidadeMinima}} unids. - Pedido mínimo</p>
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
            console.log(this.anuncios);
        },
        data(){
            return{
                urlpath: window.location.pathname,
               // foto:[],
                idAnuncio:0
            }
        },
        methods:{
            detailProduto: function (id_anuncio) {
                this.anuncio = $('#' + id_anuncio).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id_anuncio);
                window.open("/clubeatacado/anuncio/produtodetalhe",'_self');
            }
        },
    }
</script>
