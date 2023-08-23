<template>
    <!--------------------------------------CATEGORIAS--------------->

    <section class="section">
        <div class="container has-text-left">
            <h2 class="title">CATEGORIAS</h2>
            <h2 class="subtitle ">Aqui você encontrará as categorias que te ajudarão a encontrar os<br>
                produtos ideais para o seu comercio com as ultimas novidades!</h2>
        </div>
        <br>

        <div class="container has-text-left">

            <div class="container has-text-left" style="margin-top: 1%;padding: 0px;">
                <div class="columns is-multiline is-center"  style="width: 1200px" >
                    <div class="columns is-4" style="width: 25%; height: 25%; margin-left: 1px; margin-top: 1px;"  v-for="item in categorias">
                        <div class="card" style="box-shadow: 0 0px 0px #ffffff00" v-on:click="detalheOpen(4)">
                            <div class="card-image">
                                <figure class="image is-1by1">
                                    <img src="http://i.ytimg.com/vi/GsHO1Fu1bM0/maxresdefault.jpg" style="border-top-right-radius: 5px;border-top-left-radius: 5px;" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content" >
                                <p class="subtitle is-bold is-6">{{item.DS_CATEGORIA_PRODUTO}}</p>
                                <p class="subtitle is-7" style="text-align: left">{{item.DS_DESCRICAO_CATEGORIA_PRODUTO}}</p>
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
            console.log(this.categorias)
        }
    }
</script>



