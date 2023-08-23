<template>
    <div class="column is-3">
        <table class="table">
            <tr class="title is-6"><td  style="border: 0px"><span class="icon" style="color: #0092F6;position: relative;top:6px;right: 18px;box-shadow: 3px 3px 4px 0px rgba(10, 10, 10, 0.25);
    border-radius: 50px;"><i class="fas fa-plus-circle fa-2x"></i></span><a href="/anuncio/subir">Subir demanda</a></td></tr></table>
        <table class="table">
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6;position: relative;top:6px;right: 18px;"><i class="fas fa-gift"></i></span><a href="/anuncio/meus/produtos/page">Eu compro...</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="fas fa-heart"></i></span><a href="/usuario/favorito/page" style="color: #2764AC;    font-weight: bold;">Favoritos</a></td></tr>
            <tr class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="far fa-comment-alt"></i></span><a href="/usuario/chat">Chats</a></td></tr>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
