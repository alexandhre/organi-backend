<template>
    <!--------------------------------------FILTRO--------------->
    <section class="section">

        <div class="container has-text-centered">
            <div class="columns">

                <usuario-menu></usuario-menu>

                <div class="column has-text-left">
                    <div class="container has-text-left" style="margin-top: 1%;margin-left: -8%;">
                        <div class="columns is-multiline is-center" style="width: 1200px"  >
                            <div class="columns is-3" style="width: 25%; height: 25%; margin: 1%;"  v-for="item in this.anuncios">
                                <div class="card" >
                                    <div class="card-image">
                                        <figure class="image is-2by1" v-on:click="detalheOpen(item.ID_ANUNCIO_PRODUTO)">
                                            <img :src="'/images/anuncios/'+item.ID_ANUNCIO_PRODUTO+'/'+item.foto" onerror="this.onerror=null;this.src='/images/photo.png';" style="margin-left: 7px; margin-top: 8px" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="card-content" style="margin-left: -20px">

                                        <p class="subtitle is-carvao is-5 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                        <p class="subtitle is-7">{{item.DS_DETALHE_PRODUTO}}</p>
                                        <p class="subtitle is-carvao is-8">Disposto a pagar até</p>
                                        <p class="subtitle is-5 is-bold" style="color: #23A7FB">R$ {{item.VL_TIPO_ANUNCIO - item.VL_DESCONTO}}</p>
                                    </div>
                                    <button class="button gradiente" style="margin-top: 20px; background-color:#23A7FB; color:#ffffff; font-size: 14px; width:255px; height: 32px;"  v-on:click="chatOpen()">CHAT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Vue from 'vue'
    import menuusario from './UsuarioMenu.vue'

    Vue.component('UsuarioMenu', menuusario);
    export default {
        mounted() {
            axios.get('/anuncio/meus/produtos').then(resp =>{
                console.log(resp.data);
                this.anuncios = resp.data;

            });
        },
        data(){
            return{
                anuncios:[],
                images:[]
            }
        },
        methods:{
            detalheOpen(id){
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/anuncio/produto/detalhe",'_self');
            },
            chatOpen(id){
                this.anuncio = $('#' + id).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/usuario/chat",'_self');
            }

        }
    }
</script>
