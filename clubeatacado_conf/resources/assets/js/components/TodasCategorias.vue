<template>
    <section class="section">
        <div class="container has-text-left">
            <h2 class="title">CATEGORIAS</h2>
            <h2 class="subtitle ">Aqui você encontrará as categorias que te ajudarão a encontrar os<br>
                produtos ideais para o seu comercio com as ultimas novidades!</h2>
        </div>
        <br>

        <div class="container has-text-left">
            <div class="columns is-multiline is-center" style="width: 105%">
                <div class="columns is-4" style="width: 25%; margin-left: 1%; height: 87%;" v-for="(item, index) in categorias">
                    <div class="card is-shady" style="width: 260px; cursor: pointer" v-on:click="categoriaType(item.DS_TIPO_PRODUTO)">
                        <div class="card" style="box-shadow: 0 0px 0px #ffffff00">
                            <div class="card-image">
                                <figure class="image is-1by1">
                                    <img :src="item.DS_ICONE_TIPO_PRODUTO" style="" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content" >
                                <p class="subtitle is-bold is-6">{{item.DS_TIPO_PRODUTO}}</p>
                                <p class="subtitle is-7" style="text-align: left">{{item.DS_CATEGORIA_PRODUTO}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props:['categorias'],
        mounted() {
            console.log(this.categorias);
        },
        methods: {
            categoriaType: function (categoria) {

                window.open("/clubeatacado/categoria/listar/"+categoria,'_self');
            }
        }
    }
</script>
