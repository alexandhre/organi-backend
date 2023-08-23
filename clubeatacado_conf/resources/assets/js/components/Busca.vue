<template>
    <div id="navbarExampleTransparentExample" class="navbar-menu" v-if="'/clubeatacado/usuario/userdetail' !== urlpath
                                                                    && '/clubeatacado/usuario/chat' !== urlpath && '/clubeatacado/usuario/favoritos/listar' !== urlpath
                                                                    && '/clubeatacado/usuario/favoritos/listar' !== urlpath && '/clubeatacado/usuario/meusanuncios' !== urlpath
                                                                    && '/clubeatacado/anuncio/descontos' !== urlpath && '/clubeatacado/anuncio/anuncie' !== urlpath
                                                                    && '/clubeatacado/logar' !== urlpath  && '/clubeatacado/registro' !== urlpath  
                                                                    && '/clubeatacado/usuario/carrinho' !== urlpath  && '/clubeatacado/anuncio/pedidos'!== urlpath ">

        <div class="navbar-start" style="display: block">
            <slot name="buscar"></slot>

            <p class="control has-icons-left" style="top:25px">
                <autocomplete style="font-size:14px;width:540px; background-color: #fafafa; height:40px; !important;background-image: none"
                :search="search"
                placeholder="Quero comprar..."
                aria-label="Quero comprar..."
                @submit="handleSubmit"
                ></autocomplete>
                <span class="icon is-large has-text-danger">
                    <i class="fas fa-5x fa-search" aria-hidden="true" ></i>
                  </span>
             </p>

        </div>
    </div>

</template>
<style>

</style>
<script>
    export default {
        mounted() {

            axios.post('/clubeatacado/anuncio/buscar', {
                cat: this.cat
            }).then((response) => {
                    console.log(response.data);
                for (var i = 0; i < response.data[0].length; i++) {
                    this.result.push(response.data[0][i].DS_TIPO_PRODUTO);
                }
                for (var i = 0; i < response.data[1].length; i++) {
                    this.result.push(response.data[1][i].DS_PRODUTO);
                }

            });
        },
        data: function(){
            return {
                result:[],
                urlpath: window.location.pathname,
                cat: ''
            }
        },
        methods: {
                search(input) {
                    if (input.length < 1) { return [] }
                    return  this.result.filter( result => {
                        return  result.toLowerCase()
                            .startsWith(input.toLowerCase())
                    })

                },

            handleSubmit(result){

                localStorage.setItem('busca',result);

             window.open('/clubeatacado/anuncio/produto/page');

            }
        }
    }
</script>
