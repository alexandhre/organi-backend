<template>
    <div class="column is-3" style="width: 28%">
        <table class="table">
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #9E0011; position: relative;top:6px;right: 18px;"><i class="fas fa-comments"></i></span><a v-on:click="openchat()">Chat</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #9E0011;position: relative;top:6px;right: 18px;"><i class="fas fa-heart"></i></span><a href="/clubeatacado/usuario/favoritos/listar">Favoritos</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #9E0011;position: relative;top:6px;right: 18px;"><i class="fas fa-gift"></i></span><a href="/clubeatacado/usuario/meusanuncios">Meus produtos</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #9E0011;position: relative;top:6px;right: 18px;"><i class="fas fa-tags"></i></span><a href="/clubeatacado/anuncio/descontos">Minhas promoções</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #9E0011;position: relative;top:6px;right: 18px;"><i class="fas fa-list"></i></span><a href="/clubeatacado/anuncio/pedidos">Histórico de pedidos</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #9E0011;position: relative;top:6px;right: 18px;"><i class="fas fa-info-circle"></i></span><a href="/clubeatacado/usuario/userdetail">Perfil</a></td></tr>
            <tr class="title is-4"><td  style="border: 0px"><span class="icon" style="color: #F5A623;position: relative;top:6px;right: 18px; height: 2em"><i class="fas fa-plus-circle fa-5x"></i></span><a href="/clubeatacado/anuncio/anuncie">Subir novo produto</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #9E0011;position: relative;top:6px;right: 18px;"><i class="far fa-arrow-alt-circle-left"></i></span><a href="/clubeatacado/logout">Sair</a></td></tr>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        methods:{
            openchat(){
                localStorage.setItem('id_anunciante', '');
                window.open("/clubeatacado/usuario/chat",'_self');
            }
        }
    }
</script>
